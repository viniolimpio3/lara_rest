<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AD_UserController extends Controller{

    private $module = 'admin';
    public function __construct(){
        
    }

    public function index(Request $req){
        $data = array(
            'title' => 'login',
            'pathCss' => "admin.css"
        );
        return load_view("{$this->module}.login", $data, 'admin_template');
    }

    public function signup(){

    }

}
