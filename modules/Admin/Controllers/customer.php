<?php
namespace Modules\Admin\Controllers;
use Modules\Admin\Models\UserdetailModel;

use App\Models\FirmModel;
use App\Models\CustomerModel;

class Customer extends \CodeIgniter\Controller
{    
    public $objsession="";
    public $objcustomermodel="";
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
        
        $this->objfirm = new FirmModel(); 
        $this->objcustomermodel = new CustomerModel(); 
        
    }
    public function index($pagenum=0)
    {      
                      
        if ($this->objsession->get('isLoggedIn')==1)
        {                       
            $userid=$this->objsession->get('userid');
            $firmid=$this->objsession->get('firmid');
            $searchname="";
            $searchmobile1="";
            $searchmobile2="";
            $searchemail="";
            $searchparams=array();
            if($this->request->getVar('mobile1')!="")
            {
               $searchparams['customermobile1']=$this->request->getVar('mobile1');
               $searchmobile1=$this->request->getVar('mobile1');
            }  
            if($this->request->getVar('mobile2')!="")
            {
               $searchparams['customermobile2']=$this->request->getVar('mobile2');
               $searchmobile2=$this->request->getVar('mobile2');
            } 
            if($this->request->getVar('email')!="")
            {
               $searchparams['customeremail']=$this->request->getVar('email');
               $searchemail=$this->request->getVar('email');
            } 
            $searchparams['userid']=$userid;
            $searchparams['firmid']=$firmid;
            $searchparams['is_deleted']="N";
            $segment=3;                        
            if($this->request->getVar('fullname')!="")
            {
                $searchname=$this->request->getVar('fullname');
                $listrows = [
                'pagedata' => $this->objcustomermodel->where($searchparams)->like('customername',$searchname,'both')->paginate(3, 'group1', $pagenum, $segment),
                'pager' => $this->objcustomermodel->pager,
                ];                
            }
            else
            {
                $listrows = [
                'pagedata' => $this->objcustomermodel->where($searchparams)->paginate(3, 'group1', $pagenum, $segment),
                'pager' => $this->objcustomermodel->pager,
                ];
                
            }
            $searchdata=['fullname'=>$searchname,'searchmobile1'=>$searchmobile1,'searchmobile2'=>$searchmobile2,'searchemail'=>$searchemail];
            $data=["customerdata"=>$listrows,"userid"=>$userid,"firmid"=>$firmid,"page"=>"Customer","searchdata"=>$searchdata];
               

            echo view('Modules\Admin\Views\Layout\header',$data);
            echo view('Modules\Admin\Views\Layout\sidebar',$data);
            echo view('Modules\Admin\Views\Layout\navbar',$data);
            echo view('Modules\Admin\Views\customerlistview',$data);
            echo view('Modules\Admin\Views\Layout\footer',$data);            
        }
        else
        {            
            return redirect()->to(site_url('login'));
        }
    }
    public function CustomerForm()
    {        
        if ($this->objsession->get('isLoggedIn')==1)
        {                       
            $userid=$this->objsession->get('userid');
            $firmid=$this->objsession->get('firmid');
            
            $data=["userid"=>$userid,"firmid"=>$firmid,"page"=>"Customer"];
                   ///$builder->like('title', 'match', 'both');      
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
    public function CreateCustomer()
    {
          
                              
            try 
            {
                 if ($this->objsession->get('isLoggedIn')==1)
                {
                $data=[];
                $userid=$this->objsession->get('userid');
                $firmid=$this->objsession->get('firmid');
                helper(['form']);
                if($this->request->getMethod()=='post')
                {
                    
                    $rules = [
                        'fullname'=> 'required',                        
                        'mobile1'=> 'required|numeric|max_length[10]|is_unique[customermaster.customermobile1]|is_unique[customermaster.customermobile2]',
                        /*'mobile2'=> 'numeric|max_length[10]|is_unique[customermaster.customermobile2]|is_unique[customermaster.customermobile1]', */  
                        //'email'=> 'is_unique[customermaster.customeremail]',
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
                            'firmid'=>$this->objsession->get('firmid'),
                            'userid'=>$this->request->getVar('userid'), 
                            
                            'customername'=>$this->request->getVar('fullname'), 
                            'customeraddress'=>$this->request->getVar('customeraddress'),                                                          
                            'customermobile1'=>$this->request->getVar('mobile1'), 
                            'customermobile2'=>$this->request->getVar('mobile2'), 
                            'customeremail'=>$this->request->getVar('email'), 
                            'customerfirm'=>$this->request->getVar('firm'),
                            'customerfirmaddress'=>$this->request->getVar('customerfirmaddress'),                                                                                                               
                            'dt_ins'=>$today                            
                        ];
                        
                        $this->objcustomermodel->save($newData);
                        $session =session();
                        $session->setFlashdata('success','Your Registration Successfully Done');
                        return redirect()->to('admin/customer');
                    }
                   $data=["page"=>"Customer","userid"=>$userid,"firmid"=>$firmid];
                }
                
                echo view('Modules\Admin\Views\Layout\header',$data);
                echo view('Modules\Admin\Views\Layout\sidebar',$data);
                echo view('Modules\Admin\Views\Layout\navbar',$data);
                echo view('Modules\Admin\Views\customerview',$data);
                echo view('Modules\Admin\Views\Layout\footer',$data);
                }
            } 
            catch (\CodeIgniter\UnknownFileException $e) 
            {
                throw new \RuntimeException($e->getMessage(), $e->getCode(), $e);
            }           
        
    }
    
    public function updatemode($custid)
    {                
        try
        {
            $userid=$this->objsession->get('userid');
            $firmid=$this->objsession->get('firmid');
            $params=array();
            if ($this->objsession->get('isLoggedIn')==1)
            { 
                $params['customerid']=$custid;
                $params['is_deleted']="N";
                $cdata = $this->objcustomermodel->where($params)->first();                       
                $data=["customerdata"=>$cdata,"page"=>"Customer","customerid"=>$custid,"userid"=>$userid,"firmid"=>$firmid];
                
                echo view('Modules\Admin\Views\Layout\header',$data);
                echo view('Modules\Admin\Views\Layout\sidebar',$data);
                echo view('Modules\Admin\Views\Layout\navbar',$data);
                echo view('Modules\Admin\Views\customerview',$data);
                echo view('Modules\Admin\Views\Layout\footer',$data);
            }
        }
        catch (\CodeIgniter\UnknownFileException $e)
        {
            throw new \RuntimeException($e->getMessage(), $e->getCode(), $e);
        }
    }
    public function UpdateCustomer()
    {
         try
        {
            
            if ($this->objsession->get('isLoggedIn')==1)
            { 
                $data=[];
                $params=[];
                $customerid=$this->request->getVar('customerid');
                helper(['form']);
                if($this->request->getMethod()=='post')
                {                    
                    $rules = [
                         'fullname'=> 'required',                        
                        'mobile1'=> 'required|numeric|max_length[10]|CustomerUniqueMobile1[mobile1,customerid]',
                        //'mobile2'=> 'required|numeric|max_length[10]|CustomerUniqueMobile2[mobile2,customerid]',                        
                    ]; 
                    $errors=[
                        
                       'mobile1'=>['CustomerUniqueMobile1'=>'Mobile number already used.']
                    ];
                    if(!$this->validate($rules,$errors)){
                        
                      
                        $params['customerid']=$customerid;
                        $params['is_deleted']="N";
                        $cdata = $this->objcustomermodel->where($params)->first(); 
                        $data=["customerdata"=>$cdata,"page"=>"Customer","customerid"=>$customerid,"validation"=>$this->validator];
                
                        echo view('Modules\Admin\Views\Layout\header',$data);
                        echo view('Modules\Admin\Views\Layout\sidebar',$data);
                        echo view('Modules\Admin\Views\Layout\navbar',$data);
                        echo view('Modules\Admin\Views\customerview',$data);
                        echo view('Modules\Admin\Views\Layout\footer',$data);
                    }
                    else
                    {                        
                        $today=date("Y-m-d H:i:s");
                        
                        $UpdateData=[                                                        
                            'customername'=>$this->request->getVar('fullname'), 
                            'customeraddress'=>$this->request->getVar('customeraddress'),                                                          
                            'customermobile1'=>$this->request->getVar('mobile1'), 
                            'customermobile2'=>$this->request->getVar('mobile2'), 
                            'customeremail'=>$this->request->getVar('email'), 
                            'customerfirm'=>$this->request->getVar('firm'),
                            'customerfirmaddress'=>$this->request->getVar('customerfirmaddress'),  
                            'dt_upd'=>$today                            
                        ];
                        
                        $this->objcustomermodel->update($customerid,$UpdateData);
                        $session =session();
                        $session->setFlashdata('success','Customer Update Successfully');
                        return redirect()->to('admin/customer');
                    }
                    
                }
            }
        }
        catch (\CodeIgniter\UnknownFileException $e)
        {
            throw new \RuntimeException($e->getMessage(), $e->getCode(), $e);
        }
    }
    
    
}