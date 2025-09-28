<?php
    namespace App\Models;
    use CodeIgniter\Model;

    class UserModel extends Model
    {        
        protected $table = 'user';
        protected $primaryKey = 'userid';
        protected $allowedFields=['userid', 'usertypeid', 'parentid','firmid', 'username', 'password', 'email', 'language_id', 'created_by', 'created_at', 'updated_by', 'updated_at', 'deleted_at', 'last_access', 'is_active', 'is_locked', 'is_deleted', 'is_test', 'login_ip', 'Column 20', 'requires_new_password'];


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
        public function GetUserDetail($id)
        {                                   
            $this->select('u.*,ud.firstname,ud.lastname,ud.mobile');
            $this->from('user as u');
            $this->join('userdetail as ud','ud.userid=u.userid','left');
            $this->where("u.userid",$id);
            return $this->get()->getResult();
        }
        
        public function UpdatePassword($id=0,$data="")
        {      
           
            if($id>0)
            {
                $this->db->where('userid', $id);
                $this->db->update('user', $data);
            }
            exit;
        }
        
    }

?>