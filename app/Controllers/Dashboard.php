<?php

namespace App\Controllers;
use App\Models\RequestModel;
use App\Models\CreateEmployee;
use App\Models\UserdashModel;

class Dashboard extends BaseController
{
    public $createEmployee;
    public $userModel;
    public $requestModel;

    public function __construct()
    {
        helper(['form']);
        $this->createEmployee = new CreateEmployee();
        $this->userModel = new UserdashModel();
        $this->requestModel = new RequestModel();
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

        $data = [];

        $rules = [
            'name' => 'required',
            'email' => 'required|valid_email',
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
                    'start_date' => $this->request->getPost('start_date', FILTER_SANITIZE_STRING),
                    'end_date' => $this->request->getPost('end_date', FILTER_SANITIZE_STRING),
                    'leave_type' => $this->request->getPost('leave_type', FILTER_SANITIZE_STRING),
                    'reason' => $this->request->getPost('reason', FILTER_SANITIZE_STRING),
                ];

                
                if ($this->requestModel->save($requestData)) {
                    session()->setTempdata('request_succes', 'Your Leave request has been submitted successfully!');
                }
                else
                {
                    session()->setTempdata('request_error', 'Failed to request leave, please try again!');
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
        return view('history_view');
    }

    public function changePassword()
    {
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

    public function logout()
    {
        //destroy login session
        session()->remove('logged_user');
        session()->destroy();

        return redirect()->to(base_url().'login/');
    }
}
