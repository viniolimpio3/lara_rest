<?php

use Tymon\JWTAuth\Facades\JWTAuth;

function cryptPass($pass){
    return crypt($pass, env('SALT_USER_PASS', 'SECRET_DEFAULT_aldkfjasldfkadflkjafkj'));
}

function getAuthorizedUser(){
    if(!JWTAuth::user()) return false;

    return JWTAuth::user();
}