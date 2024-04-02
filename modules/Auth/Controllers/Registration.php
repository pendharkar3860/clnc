<?php
    /*
        This is Admin Module Controller
    */
    namespace Modules\Auth\Controllers;
    use App\Models\UserModel;
    use CodeIgniter\Config\Factories;   
   

    class Registration extends \CodeIgniter\Controller
    {
        public function index()
        {
            //$userModel = new UsersModel();
            echo view('Modules\Auth\Views\Layout\header');
            echo view('Modules\Auth\Views\Registration');
            echo view('Modules\Auth\Views\Layout\footer');
        }
        
        public function createLogin()
        {          
            //$userModel = Factories::model('Modules\Auth\Models\UserModel',['preferApp' => false]);
            $userModel = new UserModel();
            $ency=\Config\Services::encrypter();                     
            try 
            {
                $data=[];
                helper(['form']);
                if($this->request->getMethod()=='post')
                {
                    
                    $rules = [
                        'username'=> 'required|min_length[3]|max_length[50]',
                        'email'=> 'required|min_length[4]|max_length[100]|valid_email|is_unique[user.email]',
                        'password'=> 'required|min_length[4]|max_length[50]',
                        'confirmpassword'=> 'matches[password]'
                    ];
                    
                    if(!$this->validate($rules))
                    {
                        //echo validation_list_errors();
                        $data['validation']=$this->validator;                        
                    }
                    else
                    {
                        $password="";
                        //echo $password=$ency->encrypt($this->request->getVar('password'));
                        $password=password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);
                        
                        $newData=   [
                            'username'=>$this->request->getVar('username'),
                            'email'=>$this->request->getVar('email'),                            
                            'password'=>$password,                                                        
                        ];
                        //print_r($newData);
                     
                        $model=new UserModel();
                        $model->save($newData);
                        $session =session();
                        $session->setFlashdata('success','Your Registration Successfully Done');
                        return redirect()->to('login');

                    }
                    
                }

                echo view('Modules\Auth\Views\Layout\header',$data);
                echo view('Modules\Auth\Views\Registration',$data);
                echo view('Modules\Auth\Views\Layout\footer');
            } 
            catch (\CodeIgniter\UnknownFileException $e) 
            {
                throw new \RuntimeException($e->getMessage(), $e->getCode(), $e);
            }
           
        }
          
    }
?>