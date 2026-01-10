<?php
namespace Modules\Admin\Models;
use CodeIgniter\Model;

class MachineModel extends Model
{
    
    protected $table = 'pumpmodelmaster';
    // .. other member variables
    protected $db;
    protected $protectedFields=false;
    protected $primaryKey = 'pumpmodelid';
    protected $allowedFields=["pumpmodelid","userid","firmid","modelname","modelextradesc","modeldescid","companyid","hpid","rpmid","phase","headrange","totalhead","amp","status","dt_ins","dt_upd","is_deleted"];
    public function test($tet="")
    {
        echo "insert data print";
    }
    
}

?>