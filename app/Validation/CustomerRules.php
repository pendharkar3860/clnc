<?php
    namespace App\validation;
    use App\Models\CustomerModel;
    class CustomerRules
    {
        public function CustomerUniqueMobile1(string $str,string $field,array $data)
        {
            $model=new CustomerModel();
           
            
            $dt = ['customermobile1' => $data['mobile1'],'is_deleted' =>'N'];
            $rows=$model->where($dt)->where('customerid!=',$data['customerid'])->first();
            
            if($rows)
            {
                return false;
            }
            else
            {
                return true;
            }
        }
        public function CustomerUniqueMobile2(string $str,string $field,array $data )
        {
            $model=new CustomerModel();
            
            $dt = ['customermobile2' => $data['mobile2'],'is_deleted' =>'N'];
            $rows=$model->where($dt)->where('customerid!=',$data['customerid'])->first();
            
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