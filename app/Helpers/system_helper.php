<?php
    
    function CheckLogin()
    {
        $session = \Config\Services::session(); 
        
        if ($session->get('isLoggedIn')==0)
        {               
            return redirect()->to('/admin/Login');
        }
    }
    function FirmAdded()
    {
        $session = \Config\Services::session(); 
        $result=0;
        
        if ($session->get('firmid')>0)
        {               
            $result=1;
        }
        return $result;
    }
    function CheckProfile($userid)
    {
        $data="";
        $flag=0;
        $model = model('Modules\Admin\Models\UserdetailModel');                           
        $data=$model->where('userid',$userid)->first();        
        if(isset($data) && !empty($data))
        {
            if($data["userdetailid"]>0){                
                
                $flag=1;
            }            
        }
        return $flag;
    }
    function FirmDetail()
    {
        $session = \Config\Services::session(); 
        $firmdata="";
        $firmdata=$session->get('firmdetail');
        return $firmdata;
    }
    
    
?>