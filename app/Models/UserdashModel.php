<?php

namespace App\Models;
use CodeIgniter\Model;



class UserdashModel extends Model{


  public function getLoggedUserData($id)
  {
    $builder = $this->db->table('employees');
    $builder->where('uniid', $id);
    $result = $builder->get();

    if (count($result->getResultArray()) == 1)
    {
            return $result->getRowArray();
    }
    else
    {
        return null;
    }   

  }    
}
















?>