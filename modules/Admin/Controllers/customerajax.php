<?php
    /*
        This is Admin Module Controller
    */

    namespace Modules\Admin\Controllers;
    class Customerajax extends \CodeIgniter\Controller
    {
        public function index()
        {
           try
           {
            
            
           $data = array(
                "name" => "John Doe",
                "age" => 30,
                "city" => "New York",
                 "hobbies" => array("reading", "hiking", "cooking")
            );           
            $response=json_encode($data);        
            echo $response;
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