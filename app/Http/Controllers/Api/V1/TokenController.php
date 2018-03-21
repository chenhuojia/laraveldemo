<?php
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Service\Api\UserTokenService;
use App\Validates\Api\TokenGetValidate;
use App\Service\Api\TokenService;

class TokenController extends Controller
{
    
    
    public function getToken(){
        return 1112;
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

