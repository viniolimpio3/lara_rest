<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WB_SiteController extends Controller{

    private $module = 'web';
    private $template = 'web_template';

    public function __construct(){
        
    } 

    public function index(){
        $data = array(
            'title' => 'Home',
            'pathCss' => 'web.css'
        );
        return load_view("{$this->module}.home", $data, "{$this->template}");
    }
}
