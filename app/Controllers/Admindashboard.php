<?php

namespace App\Controllers;
use App\Models\CreateEmployee;
use App\Models\DepartmentModel;
use App\Models\LeaveModel;
use App\Models\RequestModel;
use App\Models\CreateAdmin;
use App\Models\UserdashModel;
use App\Models\ApprovedModel;
use App\Models\DeclinedModel;
use CodeIgniter\I18n\Time;


class Admindashboard extends BaseController
{
    public $createEmployee;
    public $departmentModel;
    public $leaveModel;
    public $requestModel;
    public $createAdmin;
    public $approvedModel;
    public $declinedModel;

    public function __construct()
    {
        helper(['form']);
        $this->createEmployee = new CreateEmployee();
        $this->departmentModel = new DepartmentModel();
        $this->leaveModel = new LeaveModel();
        $this->requestModel = new RequestModel();
        $this->createAdmin = new CreateAdmin();
        $this->approvedModel = new ApprovedModel();
        $this->declinedModel = new DeclinedModel();
        $this->userModel = new UserdashModel();
        $this->email = \Config\Services::email();
    }

    public function index()
    {

        if (!session()->has('admin_logged')) {
            return redirect()->to(base_url().'admin-login/');
        }

        $data['requests'] = $this->requestModel->orderBy('id', 'DESC')->findAll();
        $data['total'] = $this->createEmployee->getTotal();
        $data['totalDept'] = $this->departmentModel->getTotal();
        $data['totalLeave'] = $this->leaveModel->getTotal();
        $data['totalRequests'] = $this->requestModel->getTotal();
        $data['totalDeclined'] = $this->declinedModel->getTotal();
        $data['totalApproved'] = $this->approvedModel->getTotal();

       
        $uniid = session()->get('admin_logged');

        

        // Get unread leaves
        $data['unreadLeaves'] = $this->requestModel->getUnreadLeaves();
        $data['admindata'] = $this->userModel->getAdminUserData($uniid);


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

    public function editDept($id = null)
    {
        //define rules to validate form
        $data = [];
        $data['deptdata'] =  $this->departmentModel->find($id);

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

                    if ($this->departmentModel->update($id , $departmentData)) 
                    {
                        session()->setFlashdata('deptupdate_success', 'Department updated successfully!');
                    }
                    else
                    {
                        session()->setFlashdata('deptupdate_error', 'Failed to update department, please try again!');
                    }

                }
                else
                {
                        $data['validation'] = $this->validator;
                }
        }

        return view('edit_department_view', $data);
    }

    public function deleteDept($id = null)
    {
        if ($this->departmentModel->where('id', $id)->delete()) {
            session()->setTempdata('delete_dept', "Department deleted successfully");
            return redirect()->to(base_url().'admindashboard/departments');
        }
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
            'employee_id' => 'required',
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
                    'employee_id' => $this->request->getPost('employee_id', FILTER_SANITIZE_STRING),
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
   
    public function editLeave($id=null)
    {
       
        //define rules to validate form
        $data = [];
        $data['leaveinfo'] = $this->leaveModel->find($id);

        $rules = [
                'leave_type' => 'required',
                'description' => 'max_length[255]',
      
        ];

        if ($this->request->is('post'))
        {
                if ($this->validate($rules)) 
                {
                    //get form data and save to db
                    $updateData = [
                        'leave_type' => $this->request->getPost('leave_type', FILTER_SANITIZE_STRING),
                        'description' => $this->request->getPost('description', FILTER_SANITIZE_STRING),
                    ];

                if ($this->leaveModel->update($id, $updateData)) 
                {
                  session()->setFlashdata('leaveupdate_success', 'Leave type updated successfully');
                  
                }
                else
                {
                    session()->setFlashdata('leaveupdate_error', 'Failed to update leave type, try again!');
                    
                }
                }
                else
                {
                        $data['validation'] = $this->validator;
                }
        }

        return view('edit_leave_view', $data);
    }

    public function deleteLeave($id=null)
    {
        //delete leave type based on id and unset id
        if ($this->leaveModel->where('id', $id)->delete()) {
            session()->setTempdata('leave_delete', "Leave type deleted successfully.");
        }

        return redirect()->to(base_url().'admindashboard/leave-types');

    }
   

    public function pending()
    {
        $data['requests'] = $this->requestModel->orderBy('id', 'DESC')->findAll();
        return view('pending_view', $data);
    }

    public function approved()
    {
        $data['approved'] = $this->approvedModel->paginate(10);
        $data['pager'] = $this->approvedModel->pager;

        return view('approved_view', $data);
    }
    public function declined()
    {
        $data['declined'] = $this->declinedModel->paginate(10);
        $data['pager'] = $this->declinedModel->pager;

        
        return view('declined_view', $data);
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
            'admin_remark' => 'required|max_length[100]'
        ];

        if ($this->request->is('post')) 
        {
            if ($this->validate($rules)) 
            {
                $modalData = [
                    'status' => $this->request->getPost('status', FILTER_SANITIZE_STRING),
                    'admin_remark' => $this->request->getPost('admin_remark', FILTER_SANITIZE_STRING),
                ];

                $this->requestModel->update(
                    $id, ['status' => $modalData['status'],
                        'admin_remark' => $modalData['admin_remark']
                    ]
            );
               

                if ($modalData['status'] === 'Approved' || $modalData['status'] === 'Declined') 
                {
                    //update the leave to read
                    $this->requestModel->update($id, ['isRead' => 1]);

                    if ($modalData['status'] === 'Approved') 
                    {
                        // move to approved table
                        $this->requestModel->moveApproved($id);

                        //send an email 
                        $to =  $data['leave']['email'];
                        $subject = "Leave Status Notification";
                        $message = 'Dear ' . $data['leave']['name'] . ",<br><br>"
                        . "I am writing to inform you about the status of your recent leave request.<br><br>"
                        . " After careful consideration,  I'm pleased to inform you that your leave request has been approved";
                        
                        $this->email->setTo($to);
                        $this->email->setFrom('dmurimi919@gmail.com', 'Dennis');
                        $this->email->setSubject($subject);
                        $this->email->setMessage($message);

                        if ($this->email->send()) 
                        {
                            session()->setTempdata('approve_success', 'An approved email  has been sent to the leave applicant');
                        }
                        else {
                            session()->setTempdata('approve_error', 'Failed to send an email to the leave applicant');
                        }
                    }
                    elseif ($modalData['status'] === 'Declined') 
                    {
                        // move to declined table
                        $this->requestModel->moveDeclined($id);

                        //send an email 
                        $to =  $data['leave']['email'];
                        $subject = "Leave Status Notification";
                        $message = 'Dear ' . $data['leave']['name'] . ",<br><br>"
                        . "I am writing to inform you about the status of your recent leave request.<br><br>"
                        . " After careful consideration, I regret to inform you that your leave request has been rejected";
                        
                        $this->email->setTo($to);
                        $this->email->setFrom('dmurimi919@gmail.com', 'Dennis');
                        $this->email->setSubject($subject);
                        $this->email->setMessage($message);

                        if ($this->email->send()) 
                        {
                            session()->setTempdata('decline_success', 'An declined email request has been sent to the leave applicant');
                        }
                        else {
                            session()->setTempdata('decline_error', 'Failed to send an email to the leave applicant');
                        }
                    }
                }
                

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
            'phone' => 'required',
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
                    'phone' => $this->request->getPost('phone', FILTER_SANITIZE_STRING),
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
        session()->remove('admin_logged');
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
            $data['userdata'] = $this->createAdmin->getLoggedUserData(session()->get('admin_logged'));
        
        
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

    public function updateAdmin()
    {
        $data = [];

        $uniid = session()->get('admin_logged');
        $data['admininfo'] = $this->createAdmin->getLoggedUserData($uniid);

        $rules = [
            'full_name' => 'required',
            'email' => 'required|valid_email',
            'phone' => 'required'
        ];

        if ($this->request->is('post')) 
        {
           
            if ($this->validate($rules)) {
                $changedata = [
                    'full_name' => $this->request->getPost('full_name', FILTER_SANITIZE_STRING),
                    'email' => $this->request->getPost('email', FILTER_SANITIZE_STRING),
                    'phone' => $this->request->getPost('phone', FILTER_SANITIZE_STRING)
                ];

                $changedData = $this->createAdmin->updateAdmin($uniid, $changedata);

                if ($changedData) 
                {
                    session()->setTempdata('admin_change_success', 'Your profile has been updated successfully!');
                }
                else {
                    session()->setTempdata('admin_change_error', 'Failed to update your profile, please try again!');
                }
            }
            else {
                $data['validation'] = $this->validator;
            }
        }


        return view('admin_update_view', $data);
    }

}
