<?php
    namespace App\Models;
    use CodeIgniter\Model;

    class CustomerModel extends Model
    {        
        protected $table = 'customermaster';
        protected $primaryKey = 'customerid';
        protected $allowedFields=['customerid','parentid','firmid','userid','customername','customeraddress','customermobile1','customermobile2','customeremail','customerfirm','customerfirmaddress','dt_ins','dt_upd','is_deleted'];        
        
    }

?>