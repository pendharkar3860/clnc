<?php
    /*
        This is Admin Module Controller
    */

    namespace Modules\Admin\Controllers;
    class Section extends \CodeIgniter\Controller
    {
        public function index()
        {
           try
           {
               
            return redirect()->to(site_url('login'));
            //echo site_url();
            //return view('Modules\Admin\Views\IndexSection');  

           }
           catch(\CodeIgniter\UnknownFileException $e)
           {
                echo $e->getMessage();

           }
        }
        public function Update($id=0)
        {
            echo "Users Module Function update".$id;
        }

    }
?>