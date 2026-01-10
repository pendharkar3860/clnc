<?php
namespace Modules\Admin\Models;
use CodeIgniter\Model;

class PumpdescModel extends Model
{
    
    protected $table = 'modeldescmaster';
    // .. other member variables
    protected $db;
    protected $protectedFields=false;
    
    protected $allowedFields=["modeldescid","modeldesc","status","is_deleted"];
    public function test($tet="")
    {
        echo "insert data print";
    }
    
}

?>