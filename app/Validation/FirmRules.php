<?php
    namespace App\validation;
    use App\Models\FirmModel;
    class FirmRules
    {
        public function firmemail(string $str,string $field,array $data)
        {
            $model=new FirmModel();
            $dt = ['email' => $data['email'],'is_deleted' =>'N', 'status' => '1'];
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