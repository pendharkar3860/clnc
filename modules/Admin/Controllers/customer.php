<?php
namespace Modules\Admin\Controllers;
use Modules\Admin\Models\UserdetailModel;
use App\Models\UserModel;
use App\Models\FirmModel;
class Customer extends \CodeIgniter\Controller
{    
    public $objsession="";
    function __construct()
    {
        $this->objsession = \Config\Services::session($config);
        $this->objfirm = new FirmModel(); 
        $this->objuserdetail = new UserdetailModel();
        $this->objuser = new UserModel();
    }
    public function index()
    {        
        if ($this->objsession->get('isLoggedIn')==1)
        {                       
            $userid=$this->objsession->get('userid');
            $data=["userid"=>$userid];                                                                   
            $data=["userid"=>$userid,"page"=>"Customer"];
                        
            echo view('Modules\Admin\Views\Layout\header',$data);
            echo view('Modules\Admin\Views\Layout\sidebar',$data);
            echo view('Modules\Admin\Views\Layout\navbar',$data);
            echo view('Modules\Admin\Views\customerview',$data);
            echo view('Modules\Admin\Views\Layout\footer',$data);            
        }
        else
        {            
            return redirect()->to(site_url('login'));
        }
    }
    public function CreateProfile()
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
                        'firstname'=> 'required',                        
                        'lastname'=> 'required',                        
                        'mobile'=> 'required|numeric|max_length[10]|is_unique[firm_master.mobile]', 
                        'address1'=> 'required',
                        'address2'=> 'required',
                        'city'=> 'required',
                        'state'=> 'required'                        
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
                            'firstname'=>$this->request->getVar('firstname'), 
                            'lastname'=>$this->request->getVar('lastname'), 
                            'mobile'=>$this->request->getVar('mobile'),                                                          
                            'education'=>$this->request->getVar('education'), 
                            'birthdate'=>$this->request->getVar('birthdate'), 
                            'age'=>$this->request->getVar('age'), 
                            'workingskill'=>$this->request->getVar('workingskill'), 
                            'roll'=>$this->request->getVar('roll'),                             
                            'address1'=>$this->request->getVar('address1'), 
                            'address2'=>$this->request->getVar('address1'),
                            'city'=>$this->request->getVar('city'),
                            'state'=>$this->request->getVar('state'), 
                            'zip'=>$this->request->getVar('zip'),
                            'dt_ins'=>$today                            
                        ];
                        
                        $this->objuserdetail->save($newData);
                        $session =session();
                        $session->setFlashdata('success','Your Registration Successfully Done');
                        return redirect()->to('admin/profile');
                    }
                    $data['userdata']=$userdetail;
                }

                echo view('Modules\Admin\Views\Layout\header',$data);
                echo view('Modules\Admin\Views\Layout\sidebar',$data);
                echo view('Modules\Admin\Views\Layout\navbar',$data);
                echo view('Modules\Admin\Views\profile',$data);
                echo view('Modules\Admin\Views\Layout\footer',$data);
            } 
            catch (\CodeIgniter\UnknownFileException $e) 
            {
                throw new \RuntimeException($e->getMessage(), $e->getCode(), $e);
            }           
        
    }
    public function Updateprofile()
    {
        $model=new UserdetailModel();
        try
        {
            $today=date("Y-m-d H:i:s");
            $newData=   [
                            'userid'=>$this->objsession->get('userid'),
                            'firstname'=>$this->request->getVar('firstname'), 
                            'lastname'=>$this->request->getVar('lastname'), 
                            'mobile'=>$this->request->getVar('mobile'),                                                          
                            'education'=>$this->request->getVar('education'), 
                            'birthdate'=>$this->request->getVar('birthdate'), 
                            'age'=>$this->request->getVar('age'), 
                            'workingskill'=>$this->request->getVar('workingskill'), 
                            'roll'=>$this->request->getVar('roll'),                             
                            'address1'=>$this->request->getVar('address1'), 
                            'address2'=>$this->request->getVar('address1'),
                            'city'=>$this->request->getVar('city'),
                            'state'=>$this->request->getVar('state'), 
                            'zip'=>$this->request->getVar('zip'),
                            'dt_upd'=>$today                            
                        ];
           
            $model->where('userdetailid', $this->request->getVar('userdetailid'))->set($newData)->update();
            $session =session();
            $session->setFlashdata('success','Profile Updated Successfully');
            return redirect()->to('admin/profile');
       
        }
        catch (\CodeIgniter\UnknownFileException $e)
        {
            throw new \RuntimeException($e->getMessage(), $e->getCode(), $e);
        }
    }
    
}