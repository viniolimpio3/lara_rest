<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AD_UserController extends Controller{
    public function index(Request $req){
        return load_view('admin.login', [], 'admin_template');
    }

    public function signup(){

    }

}
