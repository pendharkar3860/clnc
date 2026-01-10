<?php
namespace Modules\Admin\Controllers;
use Modules\Admin\Models\UserdetailModel;
use Modules\Admin\Models\CompanyModel;
use Modules\Admin\Models\PumpdescModel;
use App\Models\FirmModel;
use App\Models\CustomerModel;
class Complain extends \CodeIgniter\Controller
{    
    public $objsession="";
    public $objcustomermodel="";
    public $objcompanymodel="";
    public $objpumpdescmodel="";
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
        $this->objcompanymodel=new CompanyModel();
        $this->objpumpdescmodel=new PumpdescModel();
        $this->db = \Config\Database::connect();
    }
    public function index()
    {    
        $data=[];
        if ($this->objsession->get('isLoggedIn')==1)
        {    
            $companylist= $this->objcompanymodel->where('is_deleted', 'N')->findAll();
            $pumpdesclist=$this->objpumpdescmodel->where('is_deleted', 'N')->findAll();
           
            $query = $this->db->query('SELECT * FROM RPMmaster WHERE status="N" AND is_deleted="N" ORDER BY rpm');
            $rpm = $query->getResult(); 
            $queryhp = $this->db->query('SELECT * FROM hpmaster WHERE status="N" AND is_deleted="N" ORDER BY hp');
            $hp = $queryhp->getResult(); 
            
            $data=["companylist"=>$companylist,"pumpdesclist"=>$pumpdesclist,"rpm"=>$rpm,"hp"=>$hp];
            
            echo view('Modules\Admin\Views\Layout\header',$data);
            echo view('Modules\Admin\Views\Layout\sidebar',$data);
            echo view('Modules\Admin\Views\Layout\navbar',$data);
            echo view('Modules\Admin\Views\addcomplain',$data);
            echo view('Modules\Admin\Views\Layout\footer',$data);               
        }
       
    }
    
    
    
}