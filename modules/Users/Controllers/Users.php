<?php
    /*
        This is Users Module Controller
    */

    namespace Modules\Users\Controllers;
    class Users extends \CodeIgniter\Controller
    {
        public function index()
        {
           return view('Modules\Users\Views\Users\IndexUser');
        }
        public function Update()
        {
            echo "Users Module Function update";
        }

    }
?>