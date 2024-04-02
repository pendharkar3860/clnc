<?php
    /*
        This is AUTH Module Controller
    */

    namespace Modules\Auth\Controllers;
    use App\Models\UserModel;
    use App\Models\ResetpassModel;
    class Resetpass extends \CodeIgniter\Controller
    {
        function __construct()
        {

           
        }
        public function index()
        {
                          
            echo view('Modules\Auth\Views\Layout\header');
            echo view('Modules\Auth\Views\forgotpassword');
            echo view('Modules\Auth\Views\Layout\footer');
          
        }
    
        public function sendforgetpasslink()
        {
                                  
            try 
            {
                $data=[];
                helper(['form']);
                if($this->request->getMethod()=='post')
                {     
                    $model = new UserModel(); 
                    $sendemail = $this->request->getVar('email');
                    $data = $model->where('email', $sendemail)->where('is_deleted','N')->first();
                    
                    if($data)
                    {                        
                        /*$db= \Config\Database::connect();
                        $builder = $db->table('resetlink');
                        $builder->delete(['resetuserid' => $data['userid']]);
                        $insdata = [
                        'resetuserid'          => $data['userid'],
                        'created_at'       => date('y-m-d H:i:s'),                        
                        ];
                        $builder->insert($insdata);*/
                        $encrypter = \Config\Services::encrypter();
                        //$idtext = $encrypter->encrypt(base64_encode($data['userid']));
                        $idtext = $data['userid'];
                       
                    }

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
                    
                    $message=$this->resetemailtemplate($idtext);

                    $email->initialize($config);                   
                    $email->setFrom('pendharkar3860@gmail.com', 'shivam infosys');
                    $email->setTo($sendemail);                                        
                    $email->setSubject('Reset Password Link');
                    $email->setMessage($message);
                                                          
                    
                                        
                    if($email->send())
                    {
                        echo "Email send successfully !!!!!";
                    }
                } 
                
            }
            catch (\CodeIgniter\UnknownFileException $e) 
                {
                    throw new \RuntimeException($e->getMessage(), $e->getCode(), $e);
                }
          
        }
        public function passwordreset($id)
        {
            //$encrypter = \Config\Services::encrypter();
            $id;
            
            echo view('Modules\Auth\Views\Layout\header');
            echo view('Modules\Auth\Views\resetpass');
            echo view('Modules\Auth\Views\Layout\footer');
           
           exit;


        }
        public function resetemailtemplate($id="")
        {
            $encrypter = \Config\Services::encrypter();
            //$encryid = md5($id);
            $link=base_url()."passwordreset/".$id;
         
            $template="";
            $template='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

            <html xmlns="http://www.w3.org/1999/xhtml">
            
            <head>
            
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            
                <title>Forgot Password</title>
            
                <style>
            
                    body {
            
                        background-color: #FF8080; padding: 0; margin: 0;
            
                    }
            
                </style>
            
            </head>
            
            <body style="background-color: #FF8080; padding: 0; margin: 0;">
            
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
            
                                        We have sent you this email in response to your request to reset your password on '.base_url().'. After you reset your password, any credit card information stored in My Account will be deleted as a security measure.
            
                                        <br/><br/>
            
                                        To reset your password for <a href="'.$link.'">ShivamInfo Reset password</a>, please follow the link below:
            
                                        <a href="'.$link.'">Reset Password</a>
            
                                         <br/><br/>
            
                                        We recommend that you keep your password secure and not share it with anyone.If you feel your password has been compromised, you can change it by going to your '.base_url().' My Account Page and clicking on the "Change Email Address or Password" link.
            
                                        <br/><br/>
            
                                        If you need help, or you have any other questions, feel free to email ${customer-service-email}, or call ${site-name} customer service toll-free at ${site-toll-free-number}.
            
                                        <br/><br/>
            
                                        ${site-name} Customer Service
            
                                    </span>
            
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
