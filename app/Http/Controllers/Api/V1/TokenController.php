<?php
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Service\Api\UserTokenService;
use App\Validates\Api\TokenGetValidate;
use App\Service\Api\TokenService;
use App\Models\UserModel;
use Symfony\Component\CssSelector\Parser\Token;
use Dingo\Blueprint\Annotation\Method\Post;


class TokenController extends Controller
{
    
    /**
     * 获取用户token
     * @param code string
     * @url /api/user-token
     * @method post
     * @return string[]
     * ***/
    public function getToken(){ 
        (new TokenGetValidate())->goCheck();
        $code=request('code');
        $token=(new UserTokenService($code))->getToken();
        return ['token'=>$token];        
    }
    
    /**
     * 获取用户token
     * @param Token string
     * @url /api/user
     * @method get
     * @return []
     * **/
    public function getUser(){
        $openid=TokenService::getCurrentTokenVar('openid');
        $user=UserModel::getByOpenID($openid);
        return $user;
    }
    
}

