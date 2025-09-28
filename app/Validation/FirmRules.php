<?php
    namespace App\validation;
    use App\Models\FirmModel;
    class FirmRules
    {
        public function FirmUniqueMobile(string $str,string $field,array $data)
        {
            $model=new FirmModel();                       
            $dt = ['firmmobile' => $data['firmmobile'],'is_deleted' =>'N'];
            $rows=$model->where($dt)->where('firmid!=',$data['firmid'])->first();
            
            if($rows)
            {
                return false;
            }
            else
            {
                return true;
            }
        }
        public function FirmUniqueEmail(string $str,string $field,array $data)
        {
            $model=new FirmModel();                       
            $dt = ['firmemail' => $data['firmemail'],'is_deleted' =>'N'];
            $rows=$model->where($dt)->where('firmid!=',$data['firmid'])->first();
            
            if($rows)
            {
                return false;
            }
            else
            {
                return true;
            }
        }
    
    }
    
        
?>