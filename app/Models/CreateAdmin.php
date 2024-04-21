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

     public function getLoggedUserData($id)
    {
        $builder = $this->db->table('admin');
        $builder->where('uniid', $id);
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

    public function updatePassword($id , $new_password)
    {
        $builder = $this->db->table('admin');
        $builder->where('uniid', $id);
        
        // Execute the update query
        $builder->update(['password' => $new_password]);
    
        // Check the affected rows
        if ($this->db->affectedRows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
