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
            $this->objsession = \Config\Services::session();
            if($this->objsession->get('isLoggedIn')==0)
            {
               header('Location:/login');
               exit;
            }
            if($this->objsession->get('firmid')==0)
            {            
                header('Location:/admin/firm');
                exit;
            }                                      
        }        
        public function index()
        {
            $data["page"]="Dashboard";
           
            
            
            if ($this->objsession->get('isLoggedIn')==1)
            {    
              
                if($this->objsession->get('firmid')>0)
                {
                    
                    echo view('Modules\Admin\Views\Layout\header',$data);
                    echo view('Modules\Admin\Views\Layout\sidebar',$data);
                    echo view('Modules\Admin\Views\Layout\navbar',$data);
                    echo view('Modules\Admin\Views\dashboard',$data);                
                    echo view('Modules\Admin\Views\Layout\footer',$data); 
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