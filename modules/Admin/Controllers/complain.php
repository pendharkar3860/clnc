<?php
namespace Modules\Admin\Controllers;
use Modules\Admin\Models\UserdetailModel;

use App\Models\FirmModel;
use App\Models\CustomerModel;
class Complain extends \CodeIgniter\Controller
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
        $data=[];
        if ($this->objsession->get('isLoggedIn')==1)
        {    
            echo view('Modules\Admin\Views\Layout\header',$data);
            echo view('Modules\Admin\Views\Layout\sidebar',$data);
            echo view('Modules\Admin\Views\Layout\navbar',$data);
            echo view('Modules\Admin\Views\addcomplain',$data);
            echo view('Modules\Admin\Views\Layout\footer',$data);               
        }
       
    }
    
    
    
}