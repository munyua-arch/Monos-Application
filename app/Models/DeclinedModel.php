<?php

namespace App\Models;

use CodeIgniter\Model;

class DeclinedModel extends Model
{
    protected $table            = 'declined_requests';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $allowedFields    = ['id', 'name','employee_id', 'leave_type', 'start_date', 'end_date', 'declined_timestamp'];

   

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $approvedFiled  = 'approved_timestamp';
    


    public function getTotal()
    {
        return $this->countAll();
    }
}