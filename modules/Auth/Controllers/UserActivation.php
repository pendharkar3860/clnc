<?php
    /*
        This is AUTH Module Controller
    */

    namespace Modules\Auth\Controllers;
    use App\Models\UserModel;
    //use App\Models\ResetpassModel;
    use App\Models\ResetlinkModel;
    
    class UserActivation extends \CodeIgniter\Controller
    {
        public $objusermodel="";
    
        function __construct()
        {
            $this->objusermodel = new UserModel();   
            $this->objsession = \Config\Services::session();
        }
        public function index($id)
        {
            $encrypter = \Config\Services::encrypter();            
            $userid=$encrypter->decrypt(hex2bin($id));            
            if($userid>0){
                $updatedata["is_active"]="Y";
                $this->objusermodel->update($userid,$updatedata);   
                if($this->objusermodel->affectedRows())
                {
                   $this->objsession->setFlashdata("success","Hello Activation has been done,Now you enable to login");
                   return redirect()->to('login');
                }
            }
            echo view('Modules\Auth\Views\Layout\header');
            echo view('Modules\Auth\Views\forgotpassword',$data);
            echo view('Modules\Auth\Views\Layout\footer');
          
        }
    }
        