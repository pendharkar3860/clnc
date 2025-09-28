<?php
namespace Modules\Admin\Controllers;
use App\Models\UserModel;
use App\Models\FirmModel;

 class Firm extends \CodeIgniter\Controller
{
    public $objfirm="";
    public $objuser="";
    public $firmdetail;
    public $objsession;
    function __construct()
    {
        $this->objsession = \Config\Services::session();
        if($this->objsession->get('isLoggedIn')==0)
        {
           header('Location:/login');
           exit;
        }
        
        $this->objfirm = new FirmModel(); 
        $this->objuser = new UserModel();         
        
        $this->firmdetail=$this->objsession->get('firmdetail');
        
    }
    
    public function index()
    {        
        $session = \Config\Services::session();
        $dt=[];
        $userdetail;               
        
        if ($session->get('isLoggedIn')==1)
        {            
            $userdetail=$this->objuser->GetUserDetail($session->get('userid'));
            
            $dt['firmid']=$session->get('firmid');
            $dt['userdata']=$userdetail;
            if($session->get('firmid')>0)
            {                
              $dt['firmdata']=$this->objfirm->GetFirmDetail($session->get('firmid'));  
            }
            $dt['firmdetail']=$this->firmdetail;
            echo view('Modules\Admin\Views\Layout\header',$dt);
            echo view('Modules\Admin\Views\Layout\sidebar',$dt);
            echo view('Modules\Admin\Views\Layout\navbar',$dt);
            echo view('Modules\Admin\Views\firm',$dt);
            echo view('Modules\Admin\Views\Layout\footer',$dt);
        }else
        {
            return redirect()->to(site_url('login'));
        }
    }
    public function CreateFirm()
    {
            $session = \Config\Services::session($config);            
            $userdetail=$this->objuser->GetUserDetail($session->get('userid'));            
            $ency=\Config\Services::encrypter();                     
            try 
            {
                $data=[];
                helper(['form']);
                $newData=   [
                            'userid'=>$session->get('userid'),
                            'firmname'=>$this->request->getVar('firmname'),                            
                            'firmmobile'=>$this->request->getVar('firmmobile'),  
                            'firmemail'=>$this->request->getVar('firmemail'), 
                            'firmactivity'=>$this->request->getVar('firmactivity'), 
                            'firmdealing'=>$this->request->getVar('firmdealing'), 
                            'firmaddress1'=>$this->request->getVar('firmaddress1'), 
                            'firmaddress2'=>$this->request->getVar('firmaddress2'),
                            'firmcity'=>$this->request->getVar('firmcity'),
                            'firmstate'=>$this->request->getVar('firmstate'), 
                            'firmzip'=>$this->request->getVar('firmzip'),
                            'dt_ins'=>$today                            
                        ];
                
                if($this->request->getMethod()=='post')
                {
                    
                    $rules = [
                        'firmname'=> 'required',                        
                        'firmemail'=> 'required|min_length[4]|max_length[100]|valid_email|is_unique[firm_master.firmemail]',
                        'firmmobile'=> 'required|numeric|max_length[10]|is_unique[firm_master.firmmobile]', 
                        'firmaddress1'=> 'required',
                        'firmaddress2'=> 'required',
                        'firmcity'=> 'required',
                        'firmstate'=> 'required',
                        'firmzip'=> 'required',
                    ];
                    $errors=[
                        'firmemail'=>['is_unique'=>'Email already exists, Please use another Email'],
                        'firmmobile'=>['is_unique'=>'Mobile already Used, Please use another Mobile']
                    ];
                    if(!$this->validate($rules,$errors))
                    {
                        //echo validation_list_errors();
                        $data['validation']=$this->validator;  
                        $session->setFlashdata($newData);
                    }
                    else
                    {
                        $today=date("Y-m-d H:i:s");                                                
                        $this->objfirm->save($newData);
                        $session =session();
                        $session->setFlashdata('success','Your Firm Registration Successfully Done');
                        return redirect()->to('admin/firm');
                    }
                    $data['userdata']=$userdetail;
                }

                echo view('Modules\Admin\Views\Layout\header',$data);
                echo view('Modules\Admin\Views\Layout\sidebar',$data);
                echo view('Modules\Admin\Views\Layout\navbar',$data);
                echo view('Modules\Admin\Views\firm',$data);
                echo view('Modules\Admin\Views\Layout\footer',$data);
            } 
            catch (\CodeIgniter\UnknownFileException $e) 
            {
                throw new \RuntimeException($e->getMessage(), $e->getCode(), $e);
            }           
        
    }
    public function UpdateFirm()
    {
            $session = \Config\Services::session($config);            
            $userdetail=$this->objuser->GetUserDetail($session->get('userid'));            
            $ency=\Config\Services::encrypter();   
            
            try 
            {   
                $data=[];
                helper(['form']);
                
                if($this->request->getMethod()=='post')
                {                    
                    $today=date("Y-m-d H:i:s");
                    
                    $newData= [                            
                    'firmname'=>$this->request->getVar('firmname'),                            
                    'firmmobile'=>$this->request->getVar('firmmobile'),  
                    'firmemail'=>$this->request->getVar('firmemail'), 
                    'firmactivity'=>$this->request->getVar('firmactivity'), 
                    'firmdealing'=>$this->request->getVar('firmdealing'), 
                    'firmaddress1'=>$this->request->getVar('firmaddress1'), 
                    'firmaddress2'=>$this->request->getVar('firmaddress2'),
                    'firmcity'=>$this->request->getVar('firmcity'),
                    'firmstate'=>$this->request->getVar('firmstate'), 
                    'firmzip'=>$this->request->getVar('firmzip'),
                    'dt_upd'=>$today                            
                    ];                                            
                    
                    $rules = [
                        'firmname'=> 'required',                        
                        'firmemail'=> 'required|min_length[4]|max_length[100]|valid_email|FirmUniqueEmail[firmemail,firmid]',
                        'firmmobile'=> 'required|numeric|max_length[10]|FirmUniqueMobile[firmmobile,firmid]', 
                        'firmaddress1'=> 'required',
                        'firmaddress2'=> 'required',
                        'firmcity'=> 'required',
                        'firmstate'=> 'required',
                        'firmzip'=> 'required',
                    ];
                   $errors=[
                        'firmemail'=>['FirmUniqueEmail'=>'Email already exists, Please use another Email'],
                        'firmmobile'=>['is_unique'=>'Mobile already Used, Please use another Mobile']
                    ];
                    if(!$this->validate($rules,$errors))
                    {                        
                        $data['validation']=$this->validator;                                                   
                    }
                    else
                    {                                                
                        $this->objfirm->update($session->get('firmid'),$newData);
                        $session =session();
                        $session->setFlashdata('success','Your Firm Update Successfully');
                        return redirect()->to('admin/firm');
                    }
                    $data['userdata']=$userdetail;     
                    $data['firmid']=$session->get('firmid');
                    $data['firmdata']=$this->objfirm->GetFirmDetail($session->get('firmid'));
                    echo view('Modules\Admin\Views\Layout\header',$data);
                    echo view('Modules\Admin\Views\Layout\sidebar',$data);
                    echo view('Modules\Admin\Views\Layout\navbar',$data);
                    echo view('Modules\Admin\Views\firm',$data);
                    echo view('Modules\Admin\Views\Layout\footer',$data);
                }
                               
            } 
            catch (\CodeIgniter\UnknownFileException $e) 
            {
                throw new \RuntimeException($e->getMessage(), $e->getCode(), $e);
            }           
        
    }
}