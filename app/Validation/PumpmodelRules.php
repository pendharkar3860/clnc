<?php
    namespace App\validation;
    use Modules\Admin\Models\MachineModel;
    class PumpmodelRules
    {
        public function UniqueModelname($str,$field,$data)
        {
            $model=new MachineModel();
            print_r($data);exit;           
            $dt = ['modelname' => $data['modelname'],'is_deleted' =>'N'];
            $rows=$model->where($dt)->where('pumpmodelid!=',$data['pumpmodelid'])->first();
            
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