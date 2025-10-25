<?php
    /*
        This is Admin Module Controller
    */

    namespace Modules\Admin\Controllers;
    use Modules\Admin\Models\UserdetailModel;
    use App\Models\FirmModel;
    use App\Models\CustomerModel;
    
    class Customerajax extends \CodeIgniter\Controller
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
        public function index()
        {
           try
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
                    if($this->request->getVar('srhmobile1')!="")
                    {
                       $searchparams['customermobile1']=$this->request->getVar('srhmobile1');
                       $searchmobile1=$this->request->getVar('srhmobile1');
                    }  
                    if($this->request->getVar('srhmobile2')!="")
                    {
                       $searchparams['customermobile2']=$this->request->getVar('srhmobile2');
                       $searchmobile2=$this->request->getVar('srhmobile2');
                    } 
                    if($this->request->getVar('srhemail')!="")
                    {
                       $searchparams['customeremail']=$this->request->getVar('srhemail');
                       $searchemail=$this->request->getVar('srhemail');
                    } 
                    $searchparams['userid']=$userid;
                    $searchparams['firmid']=$firmid;
                    $searchparams['is_deleted']="N";
                    $segment=3;                        
                    if($this->request->getVar('srhfullname')!="")
                    {
                        $searchname=$this->request->getVar('srhfullname');
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
                    
                    $response='<div class="row">     
                                    <div class="col-12">
                                        <div class=" mb-4">                                                                                          
                                            <div class="card">
                                                <h5 class="card-header">Search List</h5>
                                                <div class="card-body">
                                                  <form name="customerlistform" id="customerlistform" action="" method="POST" class="row g-3">                                                                                                    
                                                        <div class="col-md-4">
                                                          <label class="form-label" for="fullname">Full Name</label>
                                                          <input class="form-control" name="srhfullname" id="srhfullname" type="text" value="'.$this->request->getVar('srhfullname').'" >
                                                        </div>

                                                        <div class="col-md-2">
                                                          <label class="form-label" for="mobile1">Mobile-1</label>
                                                          <input class="form-control" pattern="[7896][0-9]{9}" name="srhmobile1" id="srhmobile1" type="text" value="'.$this->request->getVar('srhmobile1').'" >
                                                        </div>
                                                          <div class="col-md-2">
                                                          <label class="form-label" for="mobile2">Mobile-2</label>
                                                          <input class="form-control" pattern="[7896][0-9]{9}" name="srhmobile2" id="srhmobile2" type="text" value="'.$this->request->getVar('srhmobile2').'" >
                                                        </div>
                                                        <div class="col-md-4">
                                                          <label class="form-label" for="email">Email</label>
                                                          <input class="form-control" name="srhemail" id="srhemail" type="text" value="'.$this->request->getVar('srhemail').'" >
                                                        </div>
                                                          <div class="col-12" style="text-align: right;">                                                              
                                                              <button class="btn btn-secondary rounded-0" type="button" onclick="SearchCustomer()">Search</button>
                                                              <button type="button" class="btn btn-primary rounded-0" onclick="ResetSearch()">ResetSearch</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="table-responsive-lg table-responsive-xl table-responsive-sm ">
                                            <table id="customerdatagrid" class="table table-bordered table-hover " style="margin-top:15px;">
                                            
                                                <thead>
                                                <tr>
                                                    <th scope="col">Action</th>
                                                  <th scope="col">Nos</th>
                                                  <th scope="col">Customer Name</th>
                                                  <th scope="col">Mobile-1</th>
                                                  <th scope="col">Mobile-2</th>
                                                  <th scope="col">Email</th>
                                                  <th scope="col">Customer Address</th>
                                                  <th scope="col">Customer Firm</th>
                                                  
                                                </tr>
                                                </thead>
                                                ';
                                                if(isset($listrows) && !empty($listrows))
                                                {
                                                    $k=0;
                                                    foreach($listrows['pagedata'] as $key => $value) {
                                                        
                                                        
                                                        $k=$key+1;
                                                        $response.='
                                                        <tr class="datagridrow" id="dtg'.$value['customerid'].'">
                                                             <td style="text-align:center"><a  class="nav-link" href="'. base_url('admin/customer/details/').$value['customerid'].'" >                                        
                                                                  </a><input type="checkbox" id="'.$value['customerid'].'" name="customerchk[]" value="'.$value['customerid'].'">
                                                            </td>
                                                            <td scope="row">'.$k.'</td>

                                                            <td>'.$value['customername'].'</td>
                                                            <td>'.$value['customermobile1'].'</td>
                                                            <td>'.$value['customermobile2'].'</td>
                                                            <td>'.$value['customeremail'].'</td>
                                                            <td>'.$value['customeraddress'].'</td>
                                                            <td>'.$value['customerfirmaddress'].'</td>                                                                                                   

                                                        </tr>';                                                                                                            
                                                    }
                                                }  
                                             $response.='
                                            </table>
                                            '.$listrows["pager"]->links("group1",'coreui_paggination').'
                                            </div>
                                           


                                        </div>
                                    <div class="tab-content rounded-bottom">
                                        <div class="col-12" style="text-align: center;">                                                              
                                            <button class="btn btn-secondary rounded-0" type="button" onclick="GetCustomerDetail()">Select customer</button>                                            
                                      </div>
                                    </div>
                                </div>
                                      
                            </div>
                            
';
                    echo $response;
                }                       
           }
           catch(\CodeIgniter\UnknownFileException $e)
           {
                echo $e->getMessage();

           }
        }
        
        
        
        public function GetSingleCusomerdata($custid=0)
        {
            $userid=$this->objsession->get('userid');
            $firmid=$this->objsession->get('firmid');
            $params=array();
            if ($this->objsession->get('isLoggedIn')==1)
            { 
                $params['customerid']=$custid;
                $params['is_deleted']="N";
                $cdata = $this->objcustomermodel->where($params)->first();                       
                //$data=["customerdata"=>$cdata,"page"=>"Customer","customerid"=>$custid,"userid"=>$userid,"firmid"=>$firmid];
               echo json_encode($cdata);exit;
            }
        }
    }
?>