<?php
    namespace Modules\Auth\Models;
    use CodeIgniter\Model;

    class UserModel extends Model
    {
        
        protected $table = 'tbl_users';
        // .. other member variables
        protected $db;

        
        public function test($tet="")
        {
            echo "insert data print";
        }
    }

?>