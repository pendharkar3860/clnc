<?php
namespace Modules\Admin\Controllers;
use Modules\Admin\Models\UserdetailModel;
class Profile extends \CodeIgniter\Controller

{
    function __construct()
    {
        
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
    public function updateprofile($userid)
    {
        $model=new UserdetailModel();
        try
        {
            $newData=   [
                'firstname'=>$this->request->getVar('firstname'),
                'lastname'=>$this->request->getVar('lastname'),                
                'mobile'=>$this->request->getVar('mobile'),
                'address1'=>$this->request->getVar('address')
                
            ];
            print_r($newData);
            //print_r($newData);
            $model->where('userdetailid', $this->request->getVar('userdetailid'))->set($newData)->update();
           
            return redirect()->to('/dashboard');
       
        }
        catch (\CodeIgniter\UnknownFileException $e)
        {
            throw new \RuntimeException($e->getMessage(), $e->getCode(), $e);
        }
    }
    
}