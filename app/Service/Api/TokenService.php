<?php
namespace App\Service\Api;

use App\Exceptions\Api\TokenException;
use App\Exceptions\Api\ForbiddenException;

class TokenService
{
    /**
     * 生成token
     * @return string
     * ***/
    public static function generateToken(){
        $randChars=getRandChar();
        $timestamp=$_SERVER['REQUEST_TIME_FLOAT'];
        $salt=config('extra.secure.token_salt');
        return md5($randChars.$timestamp.$salt);
    }
    
    /**
     * 获取当前token缓存值
     * @param unknown $key
     * @throws TokenException
     * @throws Exception
     * @return mixed
     * ***/
    public static function getCurrentTokenVar($key){
        $token=request()->header('token');
        $vars=cache($token);
        if (empty($vars)){
            throw new TokenException();
        }
        if (!is_array($vars)) $vars=json_decode($vars,true);
        if (!array_key_exists($key,$vars)){
            throw new TokenException(['msg'=>'该Token已失效']);
        }
        return $vars[$key];
    }
    
    /**
     * 获取当前用户ID
     * @return mixed
     * ***/
    public static function getCurrentUid(){
        return self::getCurrentTokenVar('uid');
    }
    
    
    public static function isValidOperate($checkedUID){
        if (!$checkedUID){
            throw new \Exception('检查UID时必须传入一个检查UID');
        }
        if ($checkedUID==self::getCurrentUid()){
            return true;
        }
        return false;
    }
    
    public static function verifyToken($token){
        $exist=cache($token);
        if ($exist){
            return true;
        }
        return false;
    }
}

