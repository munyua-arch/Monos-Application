<?php

namespace App\Models;

use CodeIgniter\Model;

class CreateEmployee extends Model
{
    protected $table            = 'employees';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $allowedFields    = ['id','first_name', 'last_name', 'email','employee_id', 'gender', 'phone', 'dob', 'password', 'department', 'uniid'];

   

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';


    public function getTotal()
    {
        return $this->countAll();
    }

    // function that verifies employee email
    public function verifyEmail($email){

        $builder = $this->db->table('employees');
        $builder->select(['first_name', 'last_name', 'email', 'dob', 'password', 'uniid', 'status']);
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
       $builder = $this->db->table('employees');
       $builder->select(['first_name', 'last_name', 'email', 'phone', 'employee_id', 'dob', 'password', 'uniid', 'status']);
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
        $builder = $this->db->table('employees');
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

    public function updateEmployee($id , $data)
    {
        $builder = $this->db->table('employees');
        $builder->where('uniid', $id);
        
        // Execute the update query
        $builder->update($data);
    
        // Check the affected rows
        if ($this->db->affectedRows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function updatedAt($id)
    {
          $builder = $this->db->table('employees');
          $builder->where('uniid', $id);
          $builder->update(['updated_at' => date('Y-m-d h:i:s')]);

          if($this->db->affectedRows() == 1)
          {
              return true;
          }
          else
          {
              return false;
          }
    }

    public function verifyToken($token)
    {
        $builder = $this->db->table('employees');
        $builder->select(['first_name', 'uniid', 'updated_at']);
        $builder->where('uniid', $token);
        
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
