<?php

namespace App\Models;

use CodeIgniter\Model;

class FormModel extends Model
{
    public function verifyEmail($email)
    {
        $builder = $this->db->table('admin');
        $builder->select(['username', 'email', 'phone', 'uniid', 'status', 'password']);
        $builder->where('email', $email);
        $res = $builder->get();

        if (count($res->getResultArray()) == 1) 
        {
            return $res->getRowArray();
        }
        else
        {
            return false;
        }
    }

 
}