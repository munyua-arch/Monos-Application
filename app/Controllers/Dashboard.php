<?php

namespace App\Controllers;
use App\Models\RequestModel;

class Dashboard extends BaseController
{
    public $requestModel;

    public function __construct()
    {
        helper(['form']);
        $this->requestModel = new RequestModel();
    }

    public function index()
    {

        if (!session()->has('logged_user')) {
            return redirect()->to(base_url().'login/');
        }

        return view('employeedash_view');
    }

    public function leaveForm()
    {

        $data = [];

        $rules = [
            'name' => 'required',
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

    public function logout()
    {
        //destroy login session
        session()->remove('logged_user');
        session()->destroy();

        return redirect()->to(base_url().'login/');
    }
}
