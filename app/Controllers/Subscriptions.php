<?php

namespace App\Controllers;

class Subscriptions extends BaseController
{
    public $client, $base_url;

    public function __construct()
    {
        helper(['form', 'url']);

        $this->client = \Config\Services::curlrequest();
        $this->base_url = base_url(); // Use actual base URL
    }

    public function getAccessToken()
    {
        // Get access token for Safaricom API
        $response = $this->client->request(
            'GET',
            'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials',
            array(
                'auth' => ['ALh0NHEJxn3mTmqL1H6LCewhhLe9ASLBKRlRq4w4wEvicpQQ', 'RaVhw9hpPI4TKQWPSFHwkzpzLI2p9qkjhiG4PoZWqrgjDNeljw69jh93XLQTdFAq'], // Replace with your credentials
                'http_errors' => false
            )
        );

        return json_decode($response->getBody())->access_token;
    }

    public function subscribe()
    {
        $data = [];
        
        // Validation rules for phone number input
        $rules = [
            'phone_number' => [
                'rules' => 'required|min_length[12]|max_length[12]|numeric',
                'errors' => [
                    'required' => 'Phone number is required',
                    'min_length' => 'Phone number should be 12 characters',
                    'max_length' => 'Phone number should be 12 characters',
                    'numeric' => 'Only numbers are allowed'
                ]
            ],
            'tier' => 'required|in_list[Starter,Pro,Enterprise]',
            'branches' => 'required|numeric|min[0]'
        ];

        if ($this->request->getMethod() == 'post') {
            if ($this->validate($rules)) {
                $phone = $this->request->getPost('phone_number');
                $tier = $this->request->getPost('tier');
                $branches = (int)$this->request->getPost('branches');

                // Calculate subscription cost
                $amount = $this->calculateSubscriptionCost($tier, $branches);

                // Proceed with payment initiation
                $this->initiatePayment($phone, $amount, "{$tier} Subscription with {$branches} Branches");
            } else {
                $data['validation'] = $this->validator;
            }
        }

        return view('subscriptions_view', $data);
    }

    private function calculateSubscriptionCost($tier, $branches)
    {
        $baseCost = [
            'Starter' => 1,
            'Pro' => 3,
            'Enterprise' => 5
        ];

        $branchCost = 1; // £1 per additional branch
        $totalCost = $baseCost[$tier] + ($branches * $branchCost);

        return $totalCost;
    }

    public function initiatePayment($phoneNumber, $amount, $description)
    {
        $endpoint = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';

        $BusinessShortCode = 174379; // Replace with your shortcode
        $passkey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919'; // Replace with your passkey
        $Timestamp = date("YmdHis");
        $Password = base64_encode($BusinessShortCode . $passkey . $Timestamp);
        $TransactionType = 'CustomerPayBillOnline';
        $CallBackURL = $this->base_url . '/subscriptions/stkCallback';
        $AccountReference = 'BusinessDirectory'; // Unique account reference
        $TransactionDesc = $description;

        $mpesaData = [
            'BusinessShortCode' => $BusinessShortCode,
            'Password' => $Password,
            'Timestamp' => $Timestamp,
            'TransactionType' => $TransactionType,
            'Amount' => $amount,
            'PartyA' => $phoneNumber,
            'PartyB' => $BusinessShortCode,
            'PhoneNumber' => $phoneNumber,
            'CallBackURL' => $CallBackURL,
            'AccountReference' => $AccountReference,
            'TransactionDesc' => $TransactionDesc
        ];

        $response = $this->client->request(
            'POST',
            $endpoint,
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->getAccessToken(),
                    'Content-Type' => 'application/json',
                ],
                'json' => $mpesaData,
                'http_errors' => false,
            ]
        );

        $responseData = json_decode($response->getBody(), true);

        if ($responseData && isset($responseData['ResponseCode']) && $responseData['ResponseCode'] == 0) {
            // STK Push sent successfully
            return true;
        } else {
            log_message('error', 'STK Push failed: ' . json_encode($responseData));
            return false;
        }
    }

     // Handle STK Callback (Payment Confirmation)
     public function stkCallback()
     {
         // Capture the JSON response from Safaricom API
         $stkResponse = $this->request->getJSON(true);  // Returns associative array
 
         // Path to the log file
         $logFile = WRITEPATH . 'logs/Mpesastkresponse.json';
 
         // Check if the log file exists and append new data to it
         if (file_exists($logFile)) {
             // Get existing content and decode it into an array
             $fileContents = file_get_contents($logFile);
             $existingContent = json_decode($fileContents, true);
             
             // Check if it's a valid array
             if (is_array($existingContent)) {
                 array_push($existingContent, $stkResponse);  // No need to decode stkResponse again
             } else {
                 $existingContent = [$stkResponse];
             }
         } else {
             // Create a new array if the file does not exist
             $existingContent = [$stkResponse];
         }
 
         // Save the updated array back to the file
         $jsonData = json_encode($existingContent, JSON_PRETTY_PRINT);
         file_put_contents($logFile, $jsonData);
 
         // Step 4: Extract the relevant transaction details
         $MerchantRequestID = $stkResponse['Body']['stkCallback']['MerchantRequestID'] ?? null;
         $CheckoutRequestID = $stkResponse['Body']['stkCallback']['CheckoutRequestID'] ?? null;
         $ResultCode = $stkResponse['Body']['stkCallback']['ResultCode'] ?? null;
         $ResultDesc = $stkResponse['Body']['stkCallback']['ResultDesc'] ?? null;
 
         // Safaricom Callback Metadata
         if ($ResultCode == 0) {
             // If transaction is successful
             $Amount = $stkResponse['Body']['stkCallback']['CallbackMetadata']['Item'][0]['Value'] ?? null;
             $TransactionId = $stkResponse['Body']['stkCallback']['CallbackMetadata']['Item'][1]['Value'] ?? null;
             $UserPhoneNumber = $stkResponse['Body']['stkCallback']['CallbackMetadata']['Item'][4]['Value'] ?? null;
 
             // (Optional) Save the transaction details to the database
 
             // Step 7: Return a success message (optional)
             return $this->response->setJSON([
                 'status' => 'success',
                 'message' => 'Transaction successful'
             ]);
         } else {
             // If the transaction failed, return a failure message
             return $this->response->setJSON([
                 'status' => 'failed',
                 'message' => $ResultDesc
             ]);
         }
     }
}

