<?php

namespace App\Models;

use CodeIgniter\Model;

class RequestModel extends Model
{
    protected $table            = 'requests';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $allowedFields    = ['id', 'name', 'email', 'employee_id', 'phone', 'gender','start_date', 'end_date', 'leave_type', 'reason', 'isRead', 'admin_remark', 'remark_date', 'applied_on', 'status'];

   

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';


    public function getTotal()
    {
        return $this->countAll();
    }

    public function getUnreadLeaves()
    {
        return $this->select('id, name, email, employee_id start_date, end_date, leave_type, reason, admin_remark, remark_date, applied_on, status')
            ->where('isRead', 0)
            ->findAll();
    }

    // Method to move approved requests to the 'approved' table
    public function moveApproved($id)
    {
        $leaveData = $this->find($id);
        unset($leaveData['id']); // Remove the primary key to avoid duplication
        // Assuming you have an 'approved' table and model named 'ApprovedModel'

        $approvedModel = new ApprovedModel();
        $approvedModel->insert($leaveData);


        $this->deleteLeave($id);
    }

    // Method to move declined requests to the 'declined' table
    public function moveDeclined($id)
    {
        $leaveData = $this->find($id);
        unset($leaveData['id']); // Remove the primary key to avoid duplication
        // Assuming you have a 'declined' table and model named 'DeclinedModel'

        $declinedModel = new DeclinedModel();
        $declinedModel->insert($leaveData);

        $this->deleteLeave($id);
    }

    public function deleteLeave($id)
    {
        return $this->delete($id);
    }

}