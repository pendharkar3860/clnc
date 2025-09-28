<?php
    namespace Modules\Auth\Models;
    use CodeIgniter\Model;

    class UserModel extends Model
    {        
        protected $table = 'user';       
        protected $db;
        protected $allowedFields=["userid",  "usertypeid",  "parentid",  "firmid", "username", "password",  "email",  "language_id",  "created_by",  "created_at",  "updated_by",  "updated_at",  "deleted_at",  "last_access",  "is_active",  "is_locked",  "is_deleted",  "is_test",  "login_ip"];
        
       
    }

?>