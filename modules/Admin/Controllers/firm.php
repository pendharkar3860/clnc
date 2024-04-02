<?php
namespace Modules\Admin\Controllers;
class Firm extends \CodeIgniter\Controller
{
    function __construct()
    {
        
    }
    public function index()
    {
        
        $session = \Config\Services::session($config);
        
        if ($session->get('isLoggedIn')==1)
        {
            $data="";
            echo view('Modules\Admin\Views\Layout\header');
            echo view('Modules\Admin\Views\Layout\sidebar');
            echo view('Modules\Admin\Views\Layout\navbar');
            echo view('Modules\Admin\Views\firm');
            echo view('Modules\Admin\Views\Layout\footer');
        }else
        {
            return redirect()->to(site_url('login'));
        }
    }
}