<?php

use Illuminate\Support\Facades\URL;
use Tymon\JWTAuth\Facades\JWTAuth;

function cryptPass($pass){
    return crypt($pass, env('SALT_USER_PASS', 'SECRET_DEFAULT_aldkfjasldfkadflkjafkj'));
}

function getAuthorizedUser(){
    if(!JWTAuth::user()) return false;

    return JWTAuth::user();
}

function getSiteConfigs(){//depois, fazer busca no banco!!
    return (Object) [
        'title' => 'LaraRest',
    ];
}

function base_url($path = false){
    $url = URL::to('/');
    if(!$path) return $url;
    return $url . "/$path";
}

function resource($path=false){
    return base_url($path ? "resources/$path" : '');
}
function load_view($module, $data=[], $template=false, $customCss=false){
    if($template) $data['template'] = $template;
    
    if($customCss) $data['pathCss'] = $customCss;

    $data['module'] = $module;
    return view('basic', $data);
}