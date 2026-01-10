<?php
namespace Modules\Admin\Models;
use CodeIgniter\Model;

class CompanyModel extends Model
{
    
    protected $table = 'companymaster';
    // .. other member variables
    protected $db;
    protected $protectedFields=false;
    
    protected $allowedFields=["companyid","companyname","status","is_deleted"];
    public function test($tet="")
    {
        echo "insert data print";
    }
    
}

?>