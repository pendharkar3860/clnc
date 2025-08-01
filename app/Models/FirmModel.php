<?php
namespace App\Models;
    use CodeIgniter\Model;
    class FirmModel extends Model
    {        
        protected $table = 'firm_master';
        protected $primaryKey = 'firmid';
        protected $allowedFields=['firmid','userid','firmname','mobile','email','firmactivity','firmdealing','address1','address2','city','state','zip','dt_ins','dt_upd','is_deleted','status'	];
               
        public function GetFirmDetail($id)
        {                                   
            $this->select('t.*');
            $this->from('firm_master as t');
            $this->where("t.firmid",$id);
            return $this->get()->getResult();
        }
                        
    }

?>