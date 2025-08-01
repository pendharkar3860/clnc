<?php
namespace Modules\Admin\Controllers;
use Modules\Admin\Models\UserdetailModel;
class Registeruser extends \CodeIgniter\Controller
{
    function __construct()
    {
        CheckLogin();
    }
    public function index()
    {        
        $session = \Config\Services::session($config);
        
        if ($session->get('isLoggedIn')==1)
        {           
            $userid=$session->userid;
            $data=["userid"=>$userid];
            $session = session();
            $model = new UserdetailModel();            
            $userdata = $model->where('userid', $userid)->first();
                       
            $data=["userid"=>$userid,"userdata"=>$userdata];
            
            echo view('Modules\Admin\Views\Layout\header',$data);
            echo view('Modules\Admin\Views\Layout\sidebar',$data);
            echo view('Modules\Admin\Views\Layout\navbar',$data);
            echo view('Modules\Admin\Views\profile',$data);
            echo view('Modules\Admin\Views\Layout\footer',$data);
            
        }else
        {
            return redirect()->to(site_url('login'));
        }
    }
    
    
}