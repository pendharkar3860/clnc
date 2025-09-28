<?php
    /*
        This is Admin Module Controller
    */
    namespace Modules\Auth\Controllers;
    use App\Models\UserModel;
    use CodeIgniter\Config\Factories;   
   

    class Registration extends \CodeIgniter\Controller
    {
        public $objusermodel="";
        public $objsession="";
        function __construct()
        {
            $this->objsession = \Config\Services::session();
            
            $this->objusermodel = new UserModel(); 
        }
        public function index()
        {
            //$userModel = new UsersModel();
            echo view('Modules\Auth\Views\Layout\header');
            echo view('Modules\Auth\Views\Registration');
            echo view('Modules\Auth\Views\Layout\footer');
        }
        
        public function createLogin()
        {                     
            $ency=\Config\Services::encrypter();                     
            try 
            {
                $data=[];
                $updatedata=[];
                $isemail=0;
                helper(['form']);
                $session =session();
                if($this->request->getMethod()=='post')
                {
                    $today=date("Y-m-d H:i:s");
                    $password="";
                    //echo $password=$ency->encrypt($this->request->getVar('password'));
                    $password=password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);
                    
                    $newData=   [
                            'username'=>$this->request->getVar('username'),
                            'usertypeid'=>1,                            
                            'email'=>$this->request->getVar('email'),                            
                            'password'=>$password,
                            'created_at'=>$today
                        ];
                    
                    $rules = [
                        'username'=> 'required|min_length[3]|max_length[50]',
                        'email'=> 'required|min_length[4]|max_length[100]|valid_email|is_unique[user.email]',
                        'password'=> 'required|min_length[4]|max_length[50]',
                        'confirmpassword'=> 'matches[password]'
                    ];
                    
                    if(!$this->validate($rules))
                    {
                        //echo validation_list_errors();
                        $this->objsession->setFlashdata($newData);
                        $data['validation']=$this->validator;                        
                    }
                    else
                    {                                                                       
                        //print_r($newData);exit;                        
                        //$db = \Config\Database::connect();                        
                        $this->objusermodel->save($newData);
                        $lastInsertId = $this->objusermodel->getInsertID();                        
                        //echo $db->getLastQuery();exit; 
                       
                        if($lastInsertId>0)
                        {
                            $isemail= $this->SendActivationEmail($lastInsertId);                        
                            
                            if($isemail)
                            {                        
                                $this->objsession->setFlashdata('success','Your Registration Successfully Done,When your activation is done,you will able to Login, Please check Email');
                                return redirect()->to('login');
                            }
                            else
                            {
                                $this->objsession->setFlashdata('alert','Your Registration Successfully Done,But Email not sent please check email address and Re-Registration Process.');
                                $updatedata["is_deleted"]="Y";
                                $this->objusermodel->update($lastInsertId,$updatedata);
                                return redirect()->to('registration');
                            }
                        }
                        else
                        {
                            $this->objsession->setFlashdata('alert','Your Registration Failed Please try again and fill your data properly');
                            return redirect()->to('registration');
                        }
                        
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
        
        public function SendActivationEmail($id=0)
        {
            $params['userid']=$id;
            $params['is_deleted']="N";
            $dt=$this->objusermodel->where($params)->first();
            $result=0;
            if(isset($dt) && !empty($dt))
            {  
                
                $sendemail = $dt["email"];
                $email = \Config\Services::email();
                $config = array();

                $config['mailPath'] = '/usr/sbin/sendmail';
                $config['charset']  = 'utf-8';
                //$config['wordWrap'] = true;
                $config['protocol'] = 'smtp';
                $config['SMTPHost'] = 'smtp.gmail.com';
                $config['SMTPUser'] = 'pendharkar3860@gmail.com';
                $config['SMTPPass'] = 'mzwn rqti tcpt ypmj';
                $config['SMTPPort'] = 465;
                $config['SMTPCrypto'] = 'SSL';
                $config['mailType'] = 'html';

                $message=$this->activationemailtemplate($dt);

                $email->initialize($config);                   
                $email->setFrom('pendharkar3860@gmail.com', 'Shivam Software Solution');
                $email->setTo($sendemail);                                        
                $email->setSubject('User Activation');
                $email->setMessage($message);
                
                    if($email->send())
                    {
                     $result=1;
                    }
                 return $result;
            }
        }
        public function activationemailtemplate($data)
        {   
            
            $encrypter = \Config\Services::encrypter();            
            $encryid = bin2hex($encrypter->encrypt($data["userid"]));                        
            //$encrytoken=bin2hex($encrypter->encrypt($tkn));
            
            $link=base_url()."activeuser/".$encryid;                       
            $template="";
            $template='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

            <html xmlns="http://www.w3.org/1999/xhtml">
            
            <head>
            
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            
                <title>User Activation Email</title>                         
            
            </head>
            
            <body style="padding: 0; margin: 0;">
            
            <table border="0" cellpadding="0" cellspacing="10" height="100%" bgcolor="#FFFFFF" width="100%" style="max-width: 650px;" id="bodyTable">
            
                <tr>
            
                    <td align="center" valign="top">
            
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" id="emailContainer" style="font-family:Arial; color: #333333;">
            
                            <!-- Logo -->
            
                            <tr>
                                
                                <td align="left" valign="top" colspan="2" style="border-bottom: 1px solid #CCCCCC; padding-bottom: 10px;">
                                
                                    <!--<img alt="${site-name}" border="0" src="${site-url-secure}/assets/images/common/demo/logo.png" title="${site-name}" class="sitelogo" width="60%" style="max-width:250px;" />-->
            
                                </td>
            
                            </tr>
            
                            <!-- Title -->
            
                            <tr>
            
                                <td align="left" valign="top" colspan="2" style="border-bottom: 1px solid #CCCCCC; padding: 20px 0 10px 0;">
            
                                    <span style="font-size: 18px; font-weight: normal;">FORGOT PASSWORD</span>
            
                                </td>
            
                            </tr>
            
                            <!-- Messages -->
            
                            <tr>
            
                                <td align="left" valign="top" colspan="2" style="padding-top: 10px;">
                                    
                                    <span style="font-size: 12px; line-height: 1.5; color: #333333;">
            
                                        <span style="color:"> HI THANKS TO SIGNING UP!</span>            
                                        <br/><br/>
                                        You recently requested sign up now please use the button below to Active your account.                                         
                                    </span>
            
                                </td>
            
                            </tr>
                            <tr>
                                <td align="center" style="margin:20px 0 20px 0;">
                                    <a style="display:block;width:200px;font-family:Nunito Sans,Helvetica, Arial, sans-serif;color: #FFF;border-radius: 3px;border-radius: 3px;background-color: #22BC66;border-top: 10px solid #22BC66;border-right: 18px solid #22BC66;border-bottom: 10px solid #22BC66;border-left: 18px solid #22BC66;" href="'.$link.'" class="f-fallback button button--green" target="_blank">Account Activation</a>
                                </td>
                            </tr>
                        </table>
            
                    </td>
            
                </tr>
            
            </table>
            
            </body>
            
            </html>';
            return $template;
        }
    }
?>