<?php 

function cryptPass($pass){
    return crypt($pass, env('SALT_USER_PASS', 'SECRET_DEFAULT_aldkfjasldfkadflkjafkj'));
}