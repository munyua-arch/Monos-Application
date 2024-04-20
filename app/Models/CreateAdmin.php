<?php

namespace App\Models;

use CodeIgniter\Model;

class CreateAdmin extends Model
{
    protected $table            = 'admin';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $allowedFields    = ['id','name', 'email', 'password', 'uniid'];

   

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
   


    public function getTotal()
    {
        return $this->countAll();
    }

    // function that verifies employee email
    public function verifyEmail($email){

        $builder = $this->db->table('admin');
        $builder->select(['full_name', 'email', 'password', 'uniid', 'status']);
        $builder->where('email', $email);
       
         $result = $builder->get();
 
 
        if (count($result->getResultArray()) == 1)
 
        {
            return $result->getRowArray();
        }
        else
        {
            return false;
        }
 
 
     }
}
