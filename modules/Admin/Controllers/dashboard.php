<?php
    /*
        This is Admin Module Controller
    */

    namespace Modules\Admin\Controllers;
    
    class Dashboard extends \CodeIgniter\Controller
    {
         private $objsession="";
        function __construct()
        {
            $this->objsession = \Config\Services::session($config);
                                
        }        
        public function index()
        {
            CheckLogin();    
            $profile=CheckProfile($this->objsession->get('userid'));                       
            if($profile == 0)
            {                                
                return redirect()->to(site_url('admin/profile')); 
            }
            
            
            if ($this->objsession->get('isLoggedIn')==1)
            {    
              
                if($this->objsession->get('firmid')>0)
                {
                    echo view('Modules\Admin\Views\Layout\header');
                    echo view('Modules\Admin\Views\Layout\sidebar');
                    echo view('Modules\Admin\Views\Layout\navbar');
                    echo view('Modules\Admin\Views\dashboard');                
                    echo view('Modules\Admin\Views\Layout\footer'); 
                }
                else
                {
                    return redirect()->to(site_url('admin/firm'));                  
                }
                
            }else
            {                
                return redirect()->to(site_url('login')); 
            }
            
        }

        public function Update($id=0)
        {
            echo "Users Module Function update".$id;
        }

    }
?>