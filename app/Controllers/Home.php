<?php

namespace App\Controllers;
use App\Models\CreateEmployee;
use App\Models\CreateAdmin;

class Home extends BaseController
{

    public $createEmployee;
    public $createAdmin;

    public function __construct()
    {
        helper(['form']);
        $this->createEmployee = new CreateEmployee();
        $this->createAdmin = new CreateAdmin();
    }

    public function index()
    {
       
        return view('ingia_view');
    }

    public function adminLogin()
    {

        $data = [];

        $rules = [
            'email' => 'required|valid_email',
            'password' => 'required|min_length[5]|max_length[20]'
        ];

        if ($this->request->is('post')) {
            
            if ($this->validate($rules)) {
                
                    $email = $this->request->getPost('email', FILTER_SANITIZE_STRING);
                    $password = $this->request->getPost('password', FILTER_SANITIZE_STRING);
                

                $userdata = $this->createAdmin->verifyEmail($email);

              
                if ($userdata) 
                {
                    // verify password
                    if (password_verify($password, $userdata['password'])) 
                    {
                        // check of employee status is active
                        if ($userdata['status'] == 'active') 
                        {
                            //create a login session
                            session()->set('logged_user', $userdata['uniid']);
                            return redirect()->to(base_url().'admindashboard/');
                        }
                        else
                        {
                            session()->setTempdata('admin_error', "Please Activate your account!");
                        }
                    }
                    else{
                        session()->setTempdata('admin_error', "Wrong password entered for the email.");
                    }
                }else {
                    session()->setTempdata('admin_error', "Employee does not exist!");
                    
                }
            }
            else
            {
                $data['validation'] = $this->validator;
            }

        }


        return view('admin_login_view', $data);
    }


    public function login()
    {
        $data = [];

        $rules = [
            'email' => 'required|valid_email',
            'password' => 'required|min_length[5]|max_length[10]'
        ];

        if ($this->request->is('post'))
        {
            if ($this->validate($rules)) 
            {
                $email = $this->request->getPost('email');
                $password = $this->request->getPost('password');

                $userdata = $this->createEmployee->verifyEmail($email);

              
                if ($userdata) 
                {
                    // verify password
                    if (password_verify($password, $userdata['password'])) 
                    {
                        // check of employee status is active
                        if ($userdata['status'] == 'active') 
                        {
                            //create a login session
                            session()->set('logged_user', $userdata['uniid']);
                            return redirect()->to(base_url().'dashboard/');
                        }
                        else
                        {
                            session()->setTempdata('login_error', "Please Activate your account!");
                        }
                    }
                    else{
                        session()->setTempdata('login_error', "Wrong password entered for the email.");
                    }
                }else {
                    session()->setTempdata('login_error', "Employee does not exist!");
                    
                }
            }
            else{
                $data['validation'] = $this->validator;
            }
        }
        return view('login_view', $data);
    }
}
