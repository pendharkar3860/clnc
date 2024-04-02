<?php
namespace Modules\Admin\Models;
use CodeIgniter\Model;

class UserdetailModel extends Model
{
    
    protected $table = 'userdetail';
    // .. other member variables
    protected $db;
    protected $protectedFields=false;
    
    protected $allowedFields=["firstname","lastname","mobile","address1"];
    public function test($tet="")
    {
        echo "insert data print";
    }
}

?>