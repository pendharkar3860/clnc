<?php
    namespace App\Models;
    use CodeIgniter\Model;

    class TestModel extends Model
    {
        // ...
        protected $tables= 'users';
        public function test($tet="")
        {
            echo "insert data print";
        }
    }
?>