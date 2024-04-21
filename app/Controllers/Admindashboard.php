<?php

namespace App\Controllers;
use App\Models\CreateEmployee;
use App\Models\DepartmentModel;
use App\Models\LeaveModel;
use App\Models\RequestModel;
use App\Models\CreateAdmin;
use CodeIgniter\I18n\Time;


class Admindashboard extends BaseController
{
    public $createEmployee;
    public $departmentModel;
    public $leaveModel;
    public $requestModel;
    public $createAdmin;

    public function __construct()
    {
        helper(['form']);
        $this->createEmployee = new CreateEmployee();
        $this->departmentModel = new DepartmentModel();
        $this->leaveModel = new LeaveModel();
        $this->requestModel = new RequestModel();
        $this->createAdmin = new CreateAdmin();
    }

    public function index()
    {
        $data['requests'] = $this->requestModel->orderBy('id', 'DESC')->findAll();
        $data['total'] = $this->createEmployee->getTotal();
        $data['totalDept'] = $this->departmentModel->getTotal();
        $data['totalLeave'] = $this->leaveModel->getTotal();
        $data['totalRequests'] = $this->requestModel->getTotal();

        if (!session()->has('logged_user')) 
        {
            return redirect()->to(base_url().'admin-login');
        }

        return view('admindashboard_view', $data);
    }

    public function employees()
    {
       
        $data['employees'] = $this->createEmployee->paginate(10);
        $data['pager'] = $this->createEmployee->pager;


        return view('employees_view', $data);
    }

    public function departments()
    {
        $data['departments'] = $this->departmentModel->findAll();

        return view('department_view', $data);
    }

    public function leave()
    {
        $data['leaves'] = $this->leaveModel->findAll();
        return view('leave_view', $data);
    }

    public function newEmployee()
    {
       
        //define rules to validate form
       $data = [];

       $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|valid_email',
            'gender' => 'required',
            'phone' => 'required|exact_length[10]',
            'dob' => 'required',
            'password' => 'required|min_length[5]|max_length[20]',
            'confirm_password' => 'matches[password]',
            'department' => 'required'
       ];

       if ($this->request->is('post'))
       {
   
            if ($this->validate($rules)) 
            {

                /*create a unique id for employee
                * get the current time stamp
                * generate a random string and shuffle it
                * combine both timestamp and random string and has with md5
                */
                
                $uniid = md5(str_shuffle('abcdefghijklmnopqrstuvwxyz').time());
                

                $employeeData = [
                    'first_name' => $this->request->getPost('first_name', FILTER_SANITIZE_STRING),
                    'last_name' => $this->request->getPost('last_name', FILTER_SANITIZE_STRING),
                    'email' => $this->request->getPost('email', FILTER_SANITIZE_STRING),
                    'gender' => $this->request->getPost('gender', FILTER_SANITIZE_STRING),
                    'phone' => $this->request->getPost('phone', FILTER_SANITIZE_STRING),
                    'dob' => $this->request->getPost('dob', FILTER_SANITIZE_STRING),
                    'password' => password_hash( $this->request->getPost('password', FILTER_SANITIZE_STRING), PASSWORD_BCRYPT),
                    'department' => $this->request->getPost('department', FILTER_SANITIZE_STRING),
                    'uniid' => $uniid
                ];


                //save to database
                try {
                    if ($this->createEmployee->save($employeeData)) 
                    {
                    session()->setFlashdata('create_success', 'New Staff added successfully!');
                    
                    }
                    else
                    {
                        session()->setFlashdata('create_error', 'Failed to add new staff, try again!');
                        
                    }
                } catch (\Exception $e) {
                    /* if error, die method stops script execution
                    and dispalys the 1st parameter error along
                    with the specified error
                    */ 
                    die('Database Error: ' . $e->getMessage());
                }
            }
            else
            {
                    $data['validation'] = $this->validator;
            }
       }

        return view('new_employee_view', $data);
    }

    public function newDept()
    {
        //define rules to validate form
        $data = [];

        $rules = [
                'department' => 'required',
                'shortform' => 'required',
                'HOD' => 'required',
                
        ];

        if ($this->request->is('post'))
        {
                if ($this->validate($rules)) 
                {
                    $departmentData = [
                        'department' => $this->request->getPost('department', FILTER_SANITIZE_STRING),
                        'shortform' => $this->request->getPost('shortform', FILTER_SANITIZE_STRING),
                        'HOD' => $this->request->getPost('HOD', FILTER_SANITIZE_STRING),
                    ];

                    if ($this->departmentModel->save($departmentData)) 
                    {
                        session()->setFlashdata('dept_success', 'New Department added successfully!');
                    }
                    else
                    {
                        session()->setFlashdata('dept_error', 'Failed to add department, try again!');
                    }

                }
                else
                {
                        $data['validation'] = $this->validator;
                }
        }

        return view('new_department_view', $data);
    }

    public function newLeave()
    {
       
        //define rules to validate form
        // jg
        $data = [];

        $rules = [
                'leave_type' => 'required',
                'description' => 'required|max_length[255]',
      
        ];

        if ($this->request->is('post'))
        {
                if ($this->validate($rules)) 
                {
                    //get form data and save to db
                    $leaveData = [
                        'leave_type' => $this->request->getPost('leave_type', FILTER_SANITIZE_STRING),
                        'description' => $this->request->getPost('description', FILTER_SANITIZE_STRING),
                    ];

                if ($this->leaveModel->save($leaveData)) 
                {
                  session()->setFlashdata('leave_success', 'New Leave type added successfully!');
                  
                }
                else
                {
                    session()->setFlashdata('leave_error', 'Failed to add new leave type, try again!');
                    
                }
                }
                else
                {
                        $data['validation'] = $this->validator;
                }
        }

        return view('new_leave_view', $data);
    }
   
    public function pending()
    {
        $data['requests'] = $this->requestModel->orderBy('id', 'DESC')->findAll();
        return view('pending_view', $data);
    }

    public function approved()
    {
        return view('approved_view');
    }
    public function declined()
    {
        return view('declined_view');
    }

    public function leaveHistory()
    {
        return view('leave_history_view');
    }

    public function leaveDetails($id = null)
    {
        helper('form');

        $data['leave'] = $this->requestModel->find($id);
        $data['employeeinfo'] = $this->createEmployee->find($id);

        $rules = [
            'status' => 'required',
            'description' => 'required|max_length[100]'
        ];

        if ($this->request->is('post')) 
        {
            if ($this->validate($rules)) 
            {
                echo 'form approved';
            }
            else
            {
                $data['validation'] = $this->validator;
            }
        }

        return view('employeeleave_details_view', $data);
    }

    public function editEmployee($id=null)
    {
        //define rules to validate form
       $data = [];
       $data['editemployee'] = $this->createEmployee->find($id);

       $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|valid_email',
            'phone' => 'required|exact_length[10]',
            'department' => 'required'
       ];

       if ($this->request->is('post'))
       {
            if ($this->validate($rules)) 
            {


                $employeeData = [
                    'first_name' => $this->request->getPost('first_name', FILTER_SANITIZE_STRING),
                    'last_name' => $this->request->getPost('last_name', FILTER_SANITIZE_STRING),
                    'email' => $this->request->getPost('email', FILTER_SANITIZE_STRING),
                    'phone' => $this->request->getPost('phone', FILTER_SANITIZE_STRING),
                    'department' => $this->request->getPost('department', FILTER_SANITIZE_STRING),
                ];

                //save to database
                if ($this->createEmployee->update($id ,$employeeData)) 
                {
                  session()->setFlashdata('create_success', 'Employee Info Updated Successfully!');
                  
                }
                else
                {
                    session()->setFlashdata('create_error', 'Failed to updated employee info, please try again!');
                    
                }
            }
            else
            {
                    $data['validation'] = $this->validator;
            }
       }

       return view('edit_employee_view', $data);
    }

    public function deleteEmployee($id = null)
    {
        if ($this->createEmployee->where('id', $id)->delete()) {
            session()->setTempdata('delete_success', 'Employee deleted successfully!');
        }
        // return redirect()-to(base_url().'/admindashboard/employees');
        return redirect()->to(base_url().'admindashboard/employees');
    }

    public function Admin()
    {
        $data['admins'] = $this->createAdmin->paginate(10);
        $data['pager'] = $this->createAdmin->pager;

        return view('admins_view', $data);
    }

    public function newAdmin()
    {
        $data = [];

        $rules = [
            'full_name' => 'required',
            'email' => 'required|valid_email',
            'password' => 'required|min_length[5]|max_length[20]',
            'confirm_password' => 'required|matches[password]'
        ];

        if ($this->request->is('post')) 
        {
            if ($this->validate($rules)) 
            {
                $uniid = md5(str_shuffle('abcdefghijklmnopqrstuvwxyz').time());

                $adminData = [
                    'full_name' => $this->request->getPost('full_name', FILTER_SANITIZE_STRING),
                    'email' => $this->request->getPost('email', FILTER_SANITIZE_STRING),
                    'password' => password_hash($this->request->getPost('password', FILTER_SANITIZE_STRING), PASSWORD_BCRYPT),
                    'uniid' => $uniid
                ];

                if ($this->createAdmin->save($adminData)) 
                {
                    session()->setFlashdata('admin_success', 'New HOD added successfully!');
                }else {
                    session()->setFlashdata('admin_error', 'Failed to create new HOD, please try again!');
                }
                
            }
            else {
                $data['validation'] = $this->validator;
            }
        }

        return view('new_admin_view', $data);
    }

    public function logout()
    {
        //destroy login session
        session()->remove('logged_user');
        session()->destroy();

        return redirect()->to(base_url().'admin-login/');
    }

    public function editAdmin($id=null)
    {
        //define rules to validate form
       $data = [];
       $data['editadmin'] = $this->createAdmin->find($id);

       $rules = [
            'full_name' => 'required',
            'email' => 'required|valid_email',
            'phone' => 'required|exact_length[10]',
            'department' => 'required'
       ];

       if ($this->request->is('post'))
       {
            if ($this->validate($rules)) 
            {


                $adminData = [
                    'full_name' => $this->request->getPost('full_name', FILTER_SANITIZE_STRING),
                    'email' => $this->request->getPost('email', FILTER_SANITIZE_STRING),
                    'phone' => $this->request->getPost('phone', FILTER_SANITIZE_STRING),
                    'department' => $this->request->getPost('department', FILTER_SANITIZE_STRING),
                ];

                //save to database
                if ($this->createAdmin->update($id ,$adminData)) 
                {
                  session()->setFlashdata('create_success', 'Employee Info Updated Successfully!');
                  
                }
                else
                {
                    session()->setFlashdata('create_error', 'Failed to updated employee info, please try again!');
                    
                }
            }
            else
            {
                    $data['validation'] = $this->validator;
            }
       }

       return view('edit_admin_view', $data);
    }

    public function deleteAdmin($id = null)
    {
        if ($this->createAdmin->where('id', $id)->delete()) {
            session()->setTempdata('delete_success', 'HOD deleted successfully!');
        }
        // return redirect()-to(base_url().'/admindashboard/employees');
        return redirect()->to(base_url().'admindashboard/admins');
    }

    public function changePassword()
    {
            $data = [];
            $data['userdata'] = $this->createAdmin->getLoggedUserData(session()->get('logged_user'));
        
        
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

                

                // Verify old password
                if (password_verify($old_password, $data['userdata']['password'])) {
                    // Hash the new password before storing it in the database
                    $hashed_new_password = password_hash($new_password, PASSWORD_BCRYPT);

                    // Update the password in the database
                    if ($this->createAdmin->updatePassword($data['userdata']['uniid'], $hashed_new_password)) 
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
                    session()->setTempdata('password_error', 'Old password is incorrect!');
                }
            }
            else
            {
                $data['validation'] = $this->validator;
            }
        }
            return view('admin_changepassword_view', $data);
    }

}
