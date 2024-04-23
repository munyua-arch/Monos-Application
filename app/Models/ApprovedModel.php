<?php

namespace App\Models;

use CodeIgniter\Model;

class ApprovedModel extends Model
{
    protected $table            = 'approved_requests';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $allowedFields    = ['id', 'name', 'leave_type', 'start_date', 'end_date', 'approval_timestamp', 'applied_on'];

   

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $approvedFiled  = 'approved_timestamp';
    


    public function getTotal()
    {
        return $this->countAll();
    }
}