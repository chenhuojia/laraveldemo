<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Service\Api\UserTokenService;
use App\Validates\Api\TokenGetValidate;
use App\Service\Api\TokenService;

class TokenController extends Controller
{
    
    
    public function getToken(){
        (new TokenGetValidate())->goCheck();
        $code=request('code');
        $token=(new UserTokenService($code))->getToken();
        return $token;
    }
    
    public function getUser(){
        //47673373dde21bb9441283a9c2b4e97d
          
        return TokenService::getCurrentTokenVar('openid');
    }
}

