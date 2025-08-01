<?php
namespace Modules\Admin\Models;
use CodeIgniter\Model;

class UserdetailModel extends Model
{
    
    protected $table = 'userdetail';
    // .. other member variables
    protected $db;
    protected $protectedFields=false;
    
    protected $allowedFields=["userid","firstname","lastname","mobile","address1","address2","education","birthdate","age","workingskill","roll","city","state","zip","dt_ins","dt_upd"];
    public function test($tet="")
    {
        echo "insert data print";
    }
    
}

?>