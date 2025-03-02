<?php
    /*
        This is AUTH Module Controller
    */

    namespace Modules\Auth\Controllers;
    use App\Models\UserModel;
    //use App\Models\ResetpassModel;
    use App\Models\ResetlinkModel;
    
    class Resetpass extends \CodeIgniter\Controller
    {
        function __construct()
        {

           
        }
        public function index($err)
        {
            $data=["err"=>$err];              
            echo view('Modules\Auth\Views\Layout\header');
            echo view('Modules\Auth\Views\forgotpassword',$data);
            echo view('Modules\Auth\Views\Layout\footer');
          
        }
    
        public function sendforgetpasslink()
        {
                                  
            try 
            {
                $data=[];
                helper(['form']);
                $encrypter = service('encrypter');                                
                if($this->request->getMethod()=='post')
                {     
                    
                $rules =[
                        "email" => [
                        "label" => "Email", 
                        "rules" => "required|min_length[3]|max_length[100]|valid_email"
                        ]
                    ];
                    
                    if(!$this->validate($rules))
                    {                             
                        $data['validation']=$this->validator; 
                    }                                     
                    else
                    {
                        $token=mt_rand(100000,999999);                       
                        
                        $model = new UserModel();                         
                        $restmodel=new ResetlinkModel();
                                
                        $sendemail = $this->request->getVar('email');
                        $data = $model->where('email', $sendemail)->where('is_deleted','N')->first();                                                
                        $detail=$model->GetUserDetail($data['userid']);                                               
                        if($data)
                        {                                                    
                            $newData=   [
                            'resetuserid'=>$data["userid"],
                            'key'=>$token,                            
                            'dt_ins'=> date('y-m-d H:i:s')  
                            ];
                                                        
                            $restmodel->save($newData);
                            
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

                        $message=$this->resetemailtemplate($detail,$token);
                        
                        $email->initialize($config);                   
                        $email->setFrom('pendharkar3860@gmail.com', 'shivam infosys');
                        $email->setTo($sendemail);                                        
                        $email->setSubject('Reset Password Link');
                        $email->setMessage($message);
                        $data["emailresult"]="0";
                        if($email->send())
                        {
                         $data["emailresult"]="1";                        
                        }
                        
                    }
                   
                    echo view('Modules\Auth\Views\Layout\header',$data);
                    echo view('Modules\Auth\Views\forgotpassword',$data);
                    echo view('Modules\Auth\Views\Layout\footer');
                } 
                
            }
            catch (\CodeIgniter\UnknownFileException $e) 
                {
                    throw new \RuntimeException($e->getMessage(), $e->getCode(), $e);
                }
          
        }
        public function passwordreset($id,$tkn)
        {
            //echo $id;exit;           
            $encrypter = \Config\Services::encrypter();
            $tokennumber= $encrypter->decrypt(hex2bin($tkn));
            $changepassid=$encrypter->decrypt(hex2bin($id));            
            $resetm=new ResetlinkModel();     
            $dtarr=["userid"=>$changepassid];
            $dt = $resetm->where('resetuserid', $changepassid)->where('key',$tokennumber)->first();                                                
            if($dt)
            {   
                
                $createddate=$dt['dt_ins'];                
                $today=date('y-m-d H:i:s');                
                $duration=round((strtotime($today) - strtotime($createddate)) /60);                
                if($duration<=60)
                {                                       
                    echo view('Modules\Auth\Views\Layout\header');
                    echo view('Modules\Auth\Views\resetpass',$dtarr);
                    echo view('Modules\Auth\Views\Layout\footer');                       
                }                
                else
                {
                   return redirect()->to('/forgotpassword/1');
                }
            }
                      
        }
        
        public function resetemailtemplate($data,$tkn="")
        {   
            
            $encrypter = \Config\Services::encrypter();            
            $encryid = bin2hex($encrypter->encrypt($data[0]->userid));                        
            $encrytoken=bin2hex($encrypter->encrypt($tkn));
            
            $link=base_url()."passwordreset/".$encryid."/".$encrytoken;            
            $fullname=  $data[0]->firstname." ".$data[0]->lastname;
            $template="";
            $template='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

            <html xmlns="http://www.w3.org/1999/xhtml">
            
            <head>
            
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            
                <title>Forgot Password</title>                         
            
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
            
                                        <span style="color:"> Hello '.$fullname.'</span>            
                                        <br/><br/>
                                        You recently requested to reset your password for your account. Use the button below to reset it. 
                                        <strong>This password reset is only valid for the next 24 hours.</strong>
                                        To reset your password for ShivamInfo Reset password, please follow the link below:
                                        <br/><br/>                                                            
                                    </span>
            
                                </td>
            
                            </tr>
                            <tr>
                                <td align="center" style="margin:20px 0 20px 0;">
                                    <a style="display:block;width:200px;font-family:Nunito Sans,Helvetica, Arial, sans-serif;color: #FFF;border-radius: 3px;border-radius: 3px;background-color: #22BC66;border-top: 10px solid #22BC66;border-right: 18px solid #22BC66;border-bottom: 10px solid #22BC66;border-left: 18px solid #22BC66;" href="'.$link.'" class="f-fallback button button--green" target="_blank">Reset your password</a>
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
