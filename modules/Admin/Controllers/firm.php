<?php
namespace Modules\Admin\Controllers;
use App\Models\UserModel;
use App\Models\FirmModel;

 class Firm extends \CodeIgniter\Controller
{
    public $objfirm="";
    public $objuser="";
     function __construct()
    {
        CheckLogin();
        $this->objfirm = new FirmModel(); 
        $this->objuser = new UserModel();
        
    }
    
    public function index()
    {        
        $session = \Config\Services::session($config);
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
                if($this->request->getMethod()=='post')
                {
                    
                    $rules = [
                        'firmname'=> 'required',                        
                        'email'=> 'required|min_length[4]|max_length[100]|valid_email|is_unique[firm_master.email]',
                        'mobile'=> 'required|numeric|max_length[10]|is_unique[firm_master.mobile]', 
                        'firmaddress1'=> 'required',
                        'firmaddress2'=> 'required',
                        'firmcity'=> 'required',
                        'firmstate'=> 'required',
                        'firmzip'=> 'required',
                    ];
                     
                    if(!$this->validate($rules))
                    {
                        //echo validation_list_errors();
                        $data['validation']=$this->validator;                        
                    }
                    else
                    {
                        $today=date("Y-m-d H:i:s");
                        $newData=   [
                            'userid'=>$session->get('userid'),
                            'firmname'=>$this->request->getVar('firmname'),                            
                            'mobile'=>$this->request->getVar('mobile'),  
                            'email'=>$this->request->getVar('email'), 
                            'firmactivity'=>$this->request->getVar('firmactivity'), 
                            'firmdealing'=>$this->request->getVar('firmdealing'), 
                            'address1'=>$this->request->getVar('firmaddress1'), 
                            'address2'=>$this->request->getVar('firmaddress2'),
                            'city'=>$this->request->getVar('firmcity'),
                            'state'=>$this->request->getVar('firmstate'), 
                            'zip'=>$this->request->getVar('firmzip'),
                            'dt_ins'=>$today                            
                        ];
                        
                        $this->objfirm->save($newData);
                        $session =session();
                        $session->setFlashdata('success','Your Registration Successfully Done');
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
                    $rules = [
                        'firmname'=> 'required',                        
                        'email'=> 'required|min_length[4]|max_length[100]|valid_email|firmemail[firmid,email]',
                        'mobile'=> 'required|numeric|max_length[10]|', 
                        'firmaddress1'=> 'required',
                        'firmaddress2'=> 'required',
                        'firmcity'=> 'required',
                        'firmstate'=> 'required',
                        'firmzip'=> 'required',
                    ];
                     $errors=[
                        
                        'email'=>['validateUser'=>' Email dose not match']
                    ];
                    if(!$this->validate($rules))
                    {                        
                        $data['validation']=$this->validator;                                                   
                    }
                    else
                    {                        
                        $today=date("Y-m-d H:i:s");
                        $newData= [                            
                            'firmname'=>$this->request->getVar('firmname'),                            
                            'mobile'=>$this->request->getVar('mobile'),  
                            'email'=>$this->request->getVar('email'), 
                            'firmactivity'=>$this->request->getVar('firmactivity'), 
                            'firmdealing'=>$this->request->getVar('firmdealing'), 
                            'address1'=>$this->request->getVar('firmaddress1'), 
                            'address2'=>$this->request->getVar('firmaddress2'),
                            'city'=>$this->request->getVar('firmcity'),
                            'state'=>$this->request->getVar('firmstate'), 
                            'zip'=>$this->request->getVar('firmzip'),
                            'dt_upd'=>$today                            
                        ];
                        
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