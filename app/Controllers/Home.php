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

    public function forgotPassword()
    {
        $data = [];
    
        $rules = [
            'email' => 'required|valid_email'
        ];

        if ($this->request->is('post')) 
        {
            if ($this->validate($rules)) 
            {
                //take email from form and verify its existence
                $email = $this->request->getVar('email', FILTER_SANITIZE_STRING);
                $userdata = $this->createEmployee->verifyEmail($email);

                if (!empty($userdata)) 
                {
                    if ($this->createEmployee->updatedAt($userdata['uniid'])) 
                    {
                        
                        $to = $email;
                        $subject = "Reset Password Link";
                        $token = $userdata['uniid'];
                        $message = "Hi ".$userdata['first_name']."<br><br>"
                            ."Your reset password request has been received. Please click the link below "
                            ."to reset your password.<br><br>"
                            ."<a href='".base_url()."/login/reset-password/".$token."'>Reset Password</a>";

                        $email = \Config\Services::email();
                        $email->setTo($to);
                        $email->setFrom('info@pichsafe.com', 'Raha Internet');
                        $email->setSubject($subject);
                        $email->setMessage($message);


                        //check if email is sent
                        if ($email->send()) 
                        {
                            session()->setTempdata('forgot_success', 'A Password reset link has been sent to your email');
                           
                            return redirect()->to(current_url());
                        }
                        else
                        {
                            session()->setTempdata('forgot_error', 'Failed to send email. Please try again.');
                           
                            return redirect()->to(current_url());
                        }
                        
                    }
                    else
                    {
                        session()->setTempdata('forgot_error', 'Failed to update', 3);
                        return redirect()->to(current_url());
                    }
                }
                else
                {
                    session()->setTempdata('forgot_error', 'Email does not exist', 3);
                    return redirect()->to(current_url());
                }
            }
            else
            {
                $data['validation'] = $this->validator;
            }
        }



        return view('forgot_password_view', $data);
    }

    public function resetPassword($token=null)
    {
        $data = [];
       
        $rules = [
            'password' => 'required|min_length[5]|max_length[20]',
            'confirm_password' => 'required|matches[password]'
        ];

        if ($this->request->is('post')) 
        {
            if (!empty($token)) {
                //verfiy the token 
                $userdata = $this->createEmployee->verifyToken($token);

                if (!empty($userdata)) 
                {
                    if ($userdata['updated_at']) 
                    {
                        //collect form data and change the user password
                        if ($this->request->is('post')) 
                        {
                            if ($this->validate($rules)) 
                            {
                                $password = password_hash($this->request->getVar('password'), PASSWORD_BCRYPT);

                                if ($this->createEmployee->updatePassword($userdata['uniid'],$password))
                                {
                                    session()->setTempdata('reset_success', 'Password reset successfully');
                                    // return redirect()->to(base_url().'login/');
                                }
                                else
                                {
                                    session()->setTempdata('reset_error', 'Failed to reset Password, please try again!');
                                    return redirect()->to(current_url());
                                }
                            }   
                            else
                            {
                                $data['validation'] = $this->validator;
                            } 
                        }
                        
    
                    }
                    else
                    {
                        $data['error'] = "Reset password link has expired.";
                    }
                }
                else
                {
                    $data['error'] = "Unable to find your account.";
                }
                
            }
            else
            {
                $data['error'] = "Sorry, Invalid Access.";
            }
        }


        return view('reset_view', $data);
    }


    public function adminforgotPassword()
    {
        $data = [];
    
        $rules = [
            'email' => 'required|valid_email'
        ];

        if ($this->request->is('post')) 
        {
            if ($this->validate($rules)) 
            {
                //take email from form and verify its existence
                $email = $this->request->getVar('email', FILTER_SANITIZE_STRING);
                $userdata = $this->createAdmin->verifyEmail($email);

               

                if (!empty($userdata)) 
                {
                    if ($this->createAdmin->updatedAt($userdata['uniid'])) 
                    {
                        
                        $to = $email;
                        $subject = "Reset Password Link";
                        $token = $userdata['uniid'];
                        $message = "Hi ".$userdata['full_name']."<br><br>"
                            ."Your reset password request has been received. Please click the link below "
                            ."to reset your password.<br><br>"
                            ."<a href='".base_url()."/admin-login/reset-password/".$token."'>Reset Password</a>";

                        $email = \Config\Services::email();
                        $email->setTo($to);
                        $email->setFrom('info@pichsafe.com', 'Raha Internet');
                        $email->setSubject($subject);
                        $email->setMessage($message);


                        //check if email is sent
                        if ($email->send()) 
                        {
                            session()->setTempdata('adminforgot_success', 'A Password reset link has been sent to your email');
                           
                            return redirect()->to(current_url());
                        }
                        else
                        {
                            session()->setTempdata('adminforgot_error', 'Failed to send email. Please try again.');
                           
                            return redirect()->to(current_url());
                        }
                        
                    }
                    else
                    {
                        session()->setTempdata('adminforgot_error', 'Failed to update', 3);
                        return redirect()->to(current_url());
                    }
                }
                else
                {
                    session()->setTempdata('adminforgot_error', 'Email does not exist', 3);
                    return redirect()->to(current_url());
                }
            }
            else
            {
                $data['validation'] = $this->validator;
            }
        }



        return view('adminforgot_password_view', $data);
    }

    public function adminresetPassword($token=null)
    {
        $data = [];
       
        $rules = [
            'password' => 'required|min_length[5]|max_length[20]',
            'confirm_password' => 'required|matches[password]'
        ];

        if ($this->request->is('post')) 
        {
            if (!empty($token)) {
                //verfiy the token 
                $userdata = $this->createAdmin->verifyToken($token);

                if (!empty($userdata)) 
                {
                    if ($userdata['updated_at']) 
                    {
                        //collect form data and change the user password
                        if ($this->request->is('post')) 
                        {
                            if ($this->validate($rules)) 
                            {
                                $password = password_hash($this->request->getVar('password'), PASSWORD_BCRYPT);

                                if ($this->createAdmin->updatePassword($userdata['uniid'],$password))
                                {
                                    session()->setTempdata('adminreset_success', 'Password reset successfully');
                                    // return redirect()->to(base_url().'login/');
                                }
                                else
                                {
                                    session()->setTempdata('adminreset_error', 'Failed to reset Password, please try again!');
                                    return redirect()->to(current_url());
                                }
                            }   
                            else
                            {
                                $data['validation'] = $this->validator;
                            } 
                        }
                        
    
                    }
                    else
                    {
                        $data['error'] = "Reset password link has expired.";
                    }
                }
                else
                {
                    $data['error'] = "Unable to find your account.";
                }
                
            }
            else
            {
                $data['error'] = "Sorry, Invalid Access.";
            }
        }


        return view('admin_reset_view', $data);
    }
}
