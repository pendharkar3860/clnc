<?php
    namespace App\validation;
    use App\Models\UserModel;
    class UserRules
    {
        public function validateUser(string $str,string $field,array $data)
        {
            $model=new UserModel();
            $dt = ['email' => $data['email'], 'is_deleted' =>'N', 'is_active' => 'Y','is_locked'=>'N'];
            
            $user=$model->where($dt)->first();
            //$user=$model->where('email',$data['email'])->first();
            
            if(!$user)
            {
                return false;
            }
            else
            {
              
                return password_verify($data['password'],$user['password']);
                
            }
        }

    }
?>