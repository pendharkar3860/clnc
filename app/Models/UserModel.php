<?php
namespace App\Models;
    use CodeIgniter\Model;

    class UserModel extends Model
    {        
        protected $table = 'user';
        protected $primaryKey = 'userid';
        protected $allowedFields=['username','email','password','created_at'];


        protected function beforeInsert(array $data)
        {
            $data=$this->password_hash($data);
            return $data;
        }
        protected function afterInsert(array $data)
        {
            $data=$this->password_hash($data);
            return $data;
        }
        
        protected function passwordHash(array $data)
        {
            if(!isset($data['data']['password']))
            $data['data']['password']=password_hash($data['data']['password'].PASSWORD_DEFAULT);
        }
    }

?>