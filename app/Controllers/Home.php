<?php

namespace App\Controllers;
use App\Models\TestModel;
class Home extends BaseController
{
    public function index()
    {
        $testmodel = new TestModel();
        
        return view('welcome_message');
    }
}
