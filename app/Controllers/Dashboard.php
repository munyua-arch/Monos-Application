<?php

namespace App\Controllers;
use App\Models\RequestModel;
use App\Models\CreateEmployee;
use App\Models\UserdashModel;
use App\Models\ApprovedModel;
use App\Models\DeclinedModel;


class Dashboard extends BaseController
{
    public $createEmployee;
    public $userModel;
    public $requestModel;
    public $approvedModel;
    public $declinedModel;
    public $email;


    public function __construct()
    {
        helper(['form']);
        $this->createEmployee = new CreateEmployee();
        $this->userModel = new UserdashModel();
        $this->requestModel = new RequestModel();
        $this->approvedModel = new ApprovedModel();
        $this->declinedModel = new DeclinedModel();
        $this->email = \Config\Services::email();
    }

    public function index()
    {

        if (!session()->has('logged_user')) {
            return redirect()->to(base_url().'login/');
        }


        $uniid = session()->get('logged_user');

        
        $data = [];
        $data['totalLeaves'] = "21 Days";
        $data['userdata'] = $this->userModel->getLoggedUserData($uniid);

        if (!$data['userdata'] == null) {
            return view('employeedash_view', $data);
        }else {
            return "User data not found";
        }

        
    }

    public function leaveForm()
    {

        if (!session()->has('logged_user')) {
            return redirect()->to(base_url().'login/');
        }

        $data = [];

        $rules = [
            'name' => 'required',
            'email' => 'required|valid_email',
            'employee_id' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'leave_type' => 'required',
            'reason' => 'required',
        ];

        if ($this->request->is('post')) 
        {
            if ($this->validate($rules)) 
            {
                $requestData = [
                    'name' => $this->request->getPost('name', FILTER_SANITIZE_STRING),
                    'email' => $this->request->getPost('email', FILTER_SANITIZE_STRING),
                    'employee_id' => $this->request->getPost('employee_id', FILTER_SANITIZE_STRING),
                    'phone' => $this->request->getPost('phone', FILTER_SANITIZE_STRING),
                    'gender' => $this->request->getPost('gender', FILTER_SANITIZE_STRING),
                    'start_date' => $this->request->getPost('start_date', FILTER_SANITIZE_STRING),
                    'end_date' => $this->request->getPost('end_date', FILTER_SANITIZE_STRING),
                    'leave_type' => $this->request->getPost('leave_type', FILTER_SANITIZE_STRING),
                    'reason' => $this->request->getPost('reason', FILTER_SANITIZE_STRING),
                ];

                
                if ($this->requestModel->save($requestData)) {
                    

                    // send an email to the admin to notify of the leave submission
                    $to = 'dmurimi919@gmail.com';
                    $subject = 'New Leave Request';
                    $message = 'A new leave request has been submitted, please review it.';

                    $this->email->setTo($to);
                    $this->email->setFrom('test@gmail.com', 'Aizendev');
                    $this->email->setSubject($subject);
                    $this->email->setMessage($message);

                    if ($this->email->send()) {
                        session()->setTempdata('email_success', 'Your form has been submitted successfully, an email has been sent to the HOD');
                    }
                    else{
                        session()->setTempdata('email_error', 'Failed to send an email, please try again');
                    }

                }
                else
                {
                    session()->setFlashdata('request_error', 'Failed to request leave, please try again!');
                }


            }
            else{
                $data['validation'] = $this->validator; 
            }
        }

        return view('leave_form_view', $data);
    }

    public function leaveHistory()
    {
        if (!session()->has('logged_user')) {
            return redirect()->to(base_url().'login/');
        }

        $uniid = session()->get('logged_user');

        $data['userdata'] = $this->userModel->getLoggedUserData($uniid);

     
        



        return view('history_view', $data);
    }

    public function changePassword()
    {
        if (!session()->has('logged_user')) {
            return redirect()->to(base_url().'login/');
        }

            $data = [];
            $data['userdata'] = $this->createEmployee->getLoggedUserData(session()->get('logged_user'));
        
        
        $rules = [
            'old_password' => 'required',
            'new_password' => 'required|min_length[5]|max_length[20]',
            'confirm_password' => 'required|matches[new_password]'
        ];

        if ($this->request->is('post')) 
        {
            if ($this->validate($rules)) 
            {
                // Get user input
                $old_password = $this->request->getPost('old_password');
                $new_password = $this->request->getPost('new_password');

                echo $old_password;
                echo $new_password;

                // Verify old password
                if (password_verify($old_password, $data['userdata']['password'])) {
                    // Hash the new password before storing it in the database
                    $hashed_new_password = password_hash($new_password, PASSWORD_BCRYPT);

                    // Update the password in the database
                    if ($this->createEmployee->updatePassword($data['userdata']['uniid'], $hashed_new_password)) 
                    {
                        session()->setTempdata('password_success', 'Password changed successfully');
                        return redirect()->to(current_url());
                    }
                    else
                    {
                        session()->setTempdata('password_error', 'Failed to change password, please try again!');
                    }
                }
                else
                {
                    session()->setTempdata('error', 'Current password is incorrect!', 3);
                }
            }
            else
            {
                $data['validation'] = $this->validator;
            }
        }
            return view('employee_changepassword_view', $data);
    }

    public function editInfo()
    {
        if (!session()->has('logged_user')) {
            return redirect()->to(base_url().'login/');
        }

        $data = [];

        $uniid = session()->get('logged_user');

       

        $data['userinfo'] = $this->createEmployee->getLoggedUserData($uniid);
        
        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|valid_email',
            'phone' => 'required'
        ];

        if ($this->request->is('post')) 
        {
            
           if ($this->validate($rules)) 
           {
                $changedata = [
                    'first_name' => $this->request->getPost('first_name', FILTER_SANITIZE_STRING),
                    'last_name' => $this->request->getPost('last_name', FILTER_SANITIZE_STRING),
                    'email' => $this->request->getPost('email', FILTER_SANITIZE_STRING),
                    'phone' => $this->request->getPost('phone', FILTER_SANITIZE_STRING)
                ];

                if ($this->createEmployee->updateEmployee($uniid, $changedata)) 
                {
                    session()->setTempdata('change_success', 'Your profile has been updated successfully!');
                }
                else {
                    session()->setTempdata('change_error', 'Your profile has been updated successfully!');
                }
           }
           else
           {
            $data['validation'] = $this->validator;
           }
        }
        return view('self_employee_update_view', $data);
    }

    public function logout()
    {
        if (!session()->has('logged_user')) {
            return redirect()->to(base_url().'login/');
        }

        //destroy login session
        session()->remove('logged_user');
        session()->destroy();

        return redirect()->to(base_url().'login/');
    }
}
