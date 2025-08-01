<?php
    
    function CheckLogin()
    {
        $session = \Config\Services::session($config);                
        if ($session->get('isLoggedIn')==0)
        {               
            return redirect()->to('/admin/login');
        }
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
?>