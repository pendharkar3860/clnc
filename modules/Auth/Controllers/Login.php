<?php
    /*
        This is AUTH Module Controller
    */

    namespace Modules\Auth\Controllers;
    use App\Models\UserModel;
    class Login extends \CodeIgniter\Controller
    {
        function __construct()
        {
           
        }
        public function index()
        {    
            $session = \Config\Services::session($config);  
            $session->remove('username');
            $session->remove('userid');
            $session->remove('email');
            $session->remove('isLoggedIn');
            
            echo view('Modules\Auth\Views\Layout\header');
            echo view('Modules\Auth\Views\Login');
            echo view('Modules\Auth\Views\Layout\footer');
           //$this->load->view('Modules\Auth\Views\Layout\header');
          //echo  $this->load->view('Modules\Auth\Views\Login');
        }

        public function doLogin()
        {
           
            try 
            {
           
                $data=[];
                helper(['form']);
                if($this->request->getMethod()=='post')
                {          
                          
                    $rules = [                        
                        'email'=> 'required|min_length[6]|max_length[50]|valid_email',
                        'password'=> 'trim|required|min_length[8]|max_length[255]|validateUser[password,email]',                        
                    ];
                    $errors=[
                        'password'=>['validateUser'=>'Password dose not match'],
                        'email'=>['validateUser'=>' Email dose not match']
                    ];
                    
                    if(! $this->validate($rules,$errors))
                    {
                       
                        $data['validation']=$this->validator;                        
                    }
                    else
                    {                             
                        
                        $session = session();
                        $model = new UserModel();
                        $email = $this->request->getVar('email');
                        $password = $this->request->getVar('password');

                        $data = $model->where('email', $email)->where('is_deleted','N')->first();

                        if($data){
                            
                                $ses_data = [
                                    'userid'       => $data['userid'],
                                    'username'     => $data['username'],
                                    'email'    => $data['email'],
                                    'isLoggedIn'     => TRUE
                                ];
                                $session->set($ses_data);
                                return redirect()->to('/admin/dashboard');
                        }else{
                            
                            $session->setFlashdata('msg', 'Email not Found');
                            return redirect()->to('/login');
                        }
                        
                                                
                    }
                    
                }

                echo view('Modules\Auth\Views\Layout\header',$data);
                echo view('Modules\Auth\Views\login',$data);
                echo view('Modules\Auth\Views\Layout\footer');
            } 
            catch (\CodeIgniter\UnknownFileException $e) 
            {
                throw new \RuntimeException($e->getMessage(), $e->getCode(), $e);
            }
               
        }
        public function setPassword()
        {            
         try 
            {
                $data=[];
                helper(['form']);
                $encrypter = service('encrypter');                                
                if($this->request->getMethod()=='post')
                {     
                    
                $rules = [                        
                        'password'=> 'required|min_length[8]|max_length[50]',
                        'confirmpassword'=> 'matches[password]'
                    ];                    
                    if(!$this->validate($rules))
                    {                             
                        $data['validation']=$this->validator; 
                        
                    }                                     
                    else
                    {
                        $psw="";                        
                        $psw=password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);
                        
                        $userid=$this->request->getVar('userid');
                        $newData=[                                                     
                          'password'=>$psw,
                          'updated_at'=>date('y-m-d H:i:s')   
                        ];
                       
                        $usermodel = new UserModel();
                        $usermodel->update($userid, $newData);              
                    } 
                }
                    echo view('Modules\Auth\Views\Layout\header',$data);
                    echo view('Modules\Auth\Views\resetpass',$data);
                    echo view('Modules\Auth\Views\Layout\footer');         
            }
            catch (\CodeIgniter\UnknownFileException $e) 
            {
                throw new \RuntimeException($e->getMessage(), $e->getCode(), $e);
            }
        }
        private function setUserMethod($user)
        {
            $session = \Config\Services::session($config);
            
            $userdata=array(
                'userid'=>$user['userid'],
                'username'=>$user['username'],
                'email'=>$user['email'],
                'isLoggedIn'=>true,
            );
           
            $session->set($userdata);
           
            
            return true;
        }
        /*
        public function forgotpassword()
        {
                                  
            echo view('Modules\Auth\Views\Layout\header');
            echo view('Modules\Auth\Views\forgotpassword');
            echo view('Modules\Auth\Views\Layout\footer');
          
        }*/
        
        public function DoLogout()
        {
            //$session->set('isLoggedIn',false);
            $session = session();
            $session->destroy();
            return redirect()->to('/login');
        }
        /*
        public function sendforgetpasslink()
        {
                                  
            try 
            {
                $data=[];
                helper(['form']);
                if($this->request->getMethod()=='post')
                {     
                    $sendemail = $this->request->getVar('email');
                    $email = \Config\Services::email();
                    $config = array();
                   
                    $config['mailPath'] = '/usr/sbin/sendmail';
                    $config['charset']  = 'iso-8859-1';
                    $config['wordWrap'] = true;
                    $config['protocol'] = 'smtp';
                    $config['SMTPHost'] = 'smtp.gmail.com';
                    $config['SMTPUser'] = 'pendharkar3860@gmail.com';
                    $config['SMTPPass'] = 'mzwn rqti tcpt ypmj';
                    $config['SMTPPort'] = 465;
                    $config['SMTPCrypto'] = 'SSL';                    
                    $email->initialize($config);                   
                    $email->setFrom('pendharkar3860@gmail.com', 'shivam infosys');
                    $email->setTo($sendemail);
                                        
                    $email->setSubject('Email Test');
                    $email->setMessage('Hello,This is testing email for reset password,please dont reply! thanks');
                    
                    if($email->send())
                    {

                        echo "Email send successfully";
                    }
                } 
                
            }
            catch (\CodeIgniter\UnknownFileException $e) 
                {
                    throw new \RuntimeException($e->getMessage(), $e->getCode(), $e);
                }
          
        }*/

    }
?>