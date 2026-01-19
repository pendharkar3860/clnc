<?php
namespace Modules\Admin\Controllers;

use Modules\Admin\Models\MachineModel;
use Modules\Admin\Models\CompanyModel;
use Modules\Admin\Models\PumpdescModel;
use App\Models\FirmModel;
use App\Models\CustomerModel;
class Pumpmodel extends \CodeIgniter\Controller
{    
    public $objsession="";
    public $objcustomermodel="";
    public $objpumpmodel="";
    public $objpumpdescmodel="";
    public $objcompanymodel="";
    public $db="";
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
        $this->objpumpmodel=new MachineModel();
        $this->objpumpdescmodel=new PumpdescModel();
        $this->objcompanymodel=new CompanyModel();
        
        $this->db = \Config\Database::connect();
    }
    public function index($pagenum=0)
    {    
        $data=[];
        if ($this->objsession->get('isLoggedIn')==1)
        {    
            $searchparams=array();
            $userid=$this->objsession->get('userid');
            $firmid=$this->objsession->get('firmid');
            
            $companylist= $this->objcompanymodel->where('is_deleted', 'N')->findAll();
            $pumpdesclist=$this->objpumpdescmodel->where('is_deleted', 'N')->findAll();
           
            $query = $this->db->query('SELECT * FROM RPMmaster WHERE status="N" AND is_deleted="N" ORDER BY rpm');
            $rpm = $query->getResult(); 
            $queryhp = $this->db->query('SELECT * FROM hpmaster WHERE status="N" AND is_deleted="N" ORDER BY hp');
            $hp = $queryhp->getResult(); 
            $segment=3;  
            
            $searchparams['pumpmodelmaster.userid']=$userid;
            $searchparams['pumpmodelmaster.firmid']=$firmid;
            $searchparams['pumpmodelmaster.is_deleted']="N";
            ($this->request->getVar('searchhp')!="")?$searchparams['pumpmodelmaster.hpid']=$this->request->getVar('searchhp'):"";
            ($this->request->getVar('searchphase')!="")?$searchparams['pumpmodelmaster.phase']=$this->request->getVar('searchphase'):"";
            $searchdata=["modelname"=>$this->request->getVar('searchmodelname'),
                        "hpid"=>$this->request->getVar('searchhp'),
                        "phase"=>$this->request->getVar('searchphase')
                    ];
            
            
            if($this->request->getVar('searchmodelname')!="")
            {
                $searchname=$this->request->getVar('searchmodelname');
                $listrows = [
                'pagedata' => $this->objpumpmodel->select("pumpmodelmaster.*,hpmaster.hp,rpmmaster.rpm,modeldescmaster.modeldesc,companymaster.companyname")
                        ->join('hpmaster', 'pumpmodelmaster.hpid = hpmaster.hpid', 'left')
                        ->join('rpmmaster', 'pumpmodelmaster.rpmid = rpmmaster.rpmid', 'left')
                        ->join('modeldescmaster', 'pumpmodelmaster.modeldescid = modeldescmaster.modeldescid', 'left')
                        ->join('companymaster', 'pumpmodelmaster.companyid = companymaster.companyid', 'left')
                        ->where($searchparams)->like('modelname',$searchname,'both')
                        ->paginate(10, 'group1', $pagenum, $segment),
                'pager' => $this->objpumpmodel->pager,
                ];                
            }
            else
            {
                $listrows = [
                'pagedata' => $this->objpumpmodel->select("pumpmodelmaster.*,hpmaster.hp,rpmmaster.rpm,modeldescmaster.modeldesc,companymaster.companyname")
                        ->join('hpmaster', 'pumpmodelmaster.hpid = hpmaster.hpid', 'left')
                        ->join('rpmmaster', 'pumpmodelmaster.rpmid = rpmmaster.rpmid', 'left')
                        ->join('modeldescmaster', 'pumpmodelmaster.modeldescid = modeldescmaster.modeldescid', 'left')
                        ->join('companymaster', 'pumpmodelmaster.companyid = companymaster.companyid', 'left')
                        ->where($searchparams)
                        ->paginate(10, 'group1', $pagenum, $segment),
                'pager' => $this->objpumpmodel->pager,
                ]; 
                
            }
            //print_r($listrows);exit;
            $data=["companylist"=>$companylist,"pumpdesclist"=>$pumpdesclist,"rpm"=>$rpm,"hp"=>$hp,"searchdata"=>$searchdata,"modeldata"=>$listrows];
            
            echo view('Modules\Admin\Views\Layout\header',$data);
            echo view('Modules\Admin\Views\Layout\sidebar',$data);
            echo view('Modules\Admin\Views\Layout\navbar',$data);
            echo view('Modules\Admin\Views\indexpumpmodel',$data);
            echo view('Modules\Admin\Views\Layout\footer',$data);               
        }
       
    }
    public function PumpmodelForm()
    {
         if ($this->objsession->get('isLoggedIn')==1)
        {    
            $data=[];
            $userid=$this->objsession->get('userid');
            $firmid=$this->objsession->get('firmid');
            $pumpmodelid=0;
            
            
            $companylist= $this->objcompanymodel->where('is_deleted', 'N')->findAll();
            $pumpdesclist=$this->objpumpdescmodel->where('is_deleted', 'N')->findAll();
           
            $query = $this->db->query('SELECT * FROM RPMmaster WHERE status="N" AND is_deleted="N" ORDER BY rpm');
            $rpm = $query->getResult(); 
            $queryhp = $this->db->query('SELECT * FROM hpmaster WHERE status="N" AND is_deleted="N" ORDER BY hp');
            $hp = $queryhp->getResult(); 
            
            
            $data=["companylist"=>$companylist,"pumpdesclist"=>$pumpdesclist,"rpm"=>$rpm,"hp"=>$hp,"userid"=>$userid,"firmid"=>$firmid,"pumpmodelid"=>$pumpmodelid];
            
            echo view('Modules\Admin\Views\Layout\header',$data);
            echo view('Modules\Admin\Views\Layout\sidebar',$data);
            echo view('Modules\Admin\Views\Layout\navbar',$data);
            echo view('Modules\Admin\Views\addpumpmodel',$data);
            echo view('Modules\Admin\Views\Layout\footer',$data);
        }
    }
    public function CreatePumpmodel()
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
                    'modelname'=> 'required|UniqueModelname[]', 
                    'company'=> 'required', 
                    'hp'=> 'required', 
                    'phase'=> 'required', 
                    'rpm'=> 'required', 
                    'pumpdesc'=>'required'
                    //'mobile1'=> 'required|numeric|max_length[10]|is_unique[customermaster.customermobile1]|is_unique[customermaster.customermobile2]',
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
                        'modelname'=>$this->request->getVar('modelname'),                         
                        'companyid'=>$this->request->getVar('company'), 
                        'hpid'=>$this->request->getVar('hp'), 
                        'phase'=>$this->request->getVar('phase'),
                        'rpmid'=>$this->request->getVar('rpm'),
                                                                             
                        'modeldescid'=>$this->request->getVar('pumpdesc'), 
                        'headrange'=>$this->request->getVar('headrange'),  
                        'totalhead'=>$this->request->getVar('totalhead'),
                        'amp'=>$this->request->getVar('amp'),  
                        'modelextradesc'=>$this->request->getVar('modelextradesc'),   
                        'dt_ins'=>$today                            
                    ];

                    $this->objpumpmodel->save($newData);
                    $session =session();
                    $session->setFlashdata('success','Your Mode Create successfully');
                    return redirect()->to('admin/pumpmodel');
                }
               $data=["page"=>"Customer","userid"=>$userid,"firmid"=>$firmid];
            }
            
            echo view('Modules\Admin\Views\Layout\header',$data);
            echo view('Modules\Admin\Views\Layout\sidebar',$data);
            echo view('Modules\Admin\Views\Layout\navbar',$data);
            echo view('Modules\Admin\Views\addpumpmodel',$data);
            echo view('Modules\Admin\Views\Layout\footer',$data);
            }
        } 
        catch (\CodeIgniter\UnknownFileException $e) 
        {
            throw new \RuntimeException($e->getMessage(), $e->getCode(), $e);
        }           
        
    }     
    public function Updatemode($pumpmodelid)
    {                
        try
        {
           
            $userid=$this->objsession->get('userid');
            $firmid=$this->objsession->get('firmid');
            $params=array();
            
            $companylist= $this->objcompanymodel->where('is_deleted', 'N')->findAll();
            $pumpdesclist=$this->objpumpdescmodel->where('is_deleted', 'N')->findAll();
           
            $query = $this->db->query('SELECT * FROM RPMmaster WHERE status="N" AND is_deleted="N" ORDER BY rpm');
            $rpm = $query->getResult(); 
            $queryhp = $this->db->query('SELECT * FROM hpmaster WHERE status="N" AND is_deleted="N" ORDER BY hp');
            $hp = $queryhp->getResult();
            
            if ($this->objsession->get('isLoggedIn')==1)
            { 
                $params['pumpmodelid']=$pumpmodelid;
                $params['is_deleted']="N";
                $cdata = $this->objpumpmodel->where($params)->first();                       
                $data=["modeldata"=>$cdata,"page"=>"Customer","pumpmodelid"=>$pumpmodelid,"userid"=>$userid,"firmid"=>$firmid,"companylist"=>$companylist,"pumpdesclist"=>$pumpdesclist,"rpm"=>$rpm,"hp"=>$hp];
                
                //print_r($cdata["modelname"]);exit;
                
                echo view('Modules\Admin\Views\Layout\header',$data);
                echo view('Modules\Admin\Views\Layout\sidebar',$data);
                echo view('Modules\Admin\Views\Layout\navbar',$data);
                echo view('Modules\Admin\Views\addpumpmodel',$data);
                echo view('Modules\Admin\Views\Layout\footer',$data);
            }
        }
        catch (\CodeIgniter\UnknownFileException $e)
        {
            throw new \RuntimeException($e->getMessage(), $e->getCode(), $e);
        }
    }
    
    public function UpdatePumpModel()
    {
         try
        {            
            if ($this->objsession->get('isLoggedIn')==1)
            { 
                $data=[];
                $params=[];
                $pumpmodelid=$this->request->getVar('pumpmodelid');
                helper(['form']);
                if($this->request->getMethod()=='post')
                {                    
                    $rules = [
                        'modelname'=> 'required', 
                        'company'=> 'required', 
                        'hp'=> 'required', 
                        'phase'=> 'required', 
                        'rpm'=> 'required', 
                        'pumpdesc'=>'required'
                        //'mobile2'=> 'required|numeric|max_length[10]|CustomerUniqueMobile2[mobile2,customerid]',                        
                    ]; 
                    
                    $errors=[];
                    if(!$this->validate($rules,$errors)){
                                              
                        $params['pumpmodelid']=$pumpmodelid;
                        $params['is_deleted']="N";
                        $cdata = $this->objpumpmodel->where($params)->first(); 
                        
                        $companylist= $this->objcompanymodel->where('is_deleted', 'N')->findAll();
                        $pumpdesclist=$this->objpumpdescmodel->where('is_deleted', 'N')->findAll();

                        $query = $this->db->query('SELECT * FROM RPMmaster WHERE status="N" AND is_deleted="N" ORDER BY rpm');
                        $rpm = $query->getResult(); 
                        $queryhp = $this->db->query('SELECT * FROM hpmaster WHERE status="N" AND is_deleted="N" ORDER BY hp');
                        $hp = $queryhp->getResult();
                        
                        $data=["modeldata"=>$cdata,"page"=>"Customer","pumpmodelid"=>$pumpmodelid,"validation"=>$this->validator,"companylist"=>$companylist,"pumpdesclist"=>$pumpdesclist,"rpm"=>$rpm,"hp"=>$hp];
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
                        'firmid'=>$this->objsession->get('firmid'),
                        'userid'=>$this->request->getVar('userid'), 
                        'modelname'=>$this->request->getVar('modelname'),                         
                        'companyid'=>$this->request->getVar('company'), 
                        'hpid'=>$this->request->getVar('hp'), 
                        'phase'=>$this->request->getVar('phase'),
                        'rpmid'=>$this->request->getVar('rpm'),
                                                                             
                        'modeldescid'=>$this->request->getVar('pumpdesc'), 
                        'headrange'=>$this->request->getVar('headrange'),  
                        'totalhead'=>$this->request->getVar('totalhead'),
                        'amp'=>$this->request->getVar('amp'),  
                        'modelextradesc'=>$this->request->getVar('modelextradesc'),    
                        'dt_upd'=>$today                            
                        ];
                        
                        
                        
                        $this->objpumpmodel->update($pumpmodelid,$UpdateData);
                        $session =session();
                        $session->setFlashdata('success','Model Update Successfully');
                        return redirect()->to('admin/pumpmodel');
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