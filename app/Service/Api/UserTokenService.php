<?php
namespace App\Service\Api;

use App\Exceptions\Api\WeChatException;
use App\Models\UserModel;
use App\Exceptions\Api\TokenException;
class UserTokenService extends TokenService
{

    protected $code;
    protected $appID;
    protected $openid='ox0nr0I_KoDb5WFBbXw42FapGXfc';
    protected $appSecret;
    protected $loginUrl;
    protected $user_id;

    public function __construct($code){
        $this->code=$code;
        $this->appID=config('extra.wechat.app_id');
        $this->appSecret=config('extra.wechat.app_secret');
        $this->loginUrl=sprintf(config('extra.wechat.login_url'),$this->appID,$this->appSecret,$this->code);
    }

    /**
     * 获取Token
     * @throws Exception
     * @return string
     * ***/
    public function getToken(){
        $result=http_curl($this->loginUrl);
        $wxresult=json_decode($result,true);
        if (empty($wxresult)){
            throw new \Exception('获取微信session_key及openid 异常');
        }
        if (array_key_exists('errcode',$wxresult)){
            $this->processLoginError($wxresult);
        }
        $this->openid=$wxresult['openid'];
        $token=$this->grantToken($wxresult);
        return $token;
    }

    /**
     * 抛出微信异常
     * @param unknown $wxresult
     * @throws WeChatException
     * ***/
    private function processLoginError($wxresult){
        throw new WeChatException([
            'msg'=>$wxresult['errmsg'],
            'errorcode'=>$wxresult['errcode'],
        ]);
    }

    /**
     * 缓存组装
     * @param unknown $wxresult
     * @return unknown
     * ***/
    private function prepareCacheValue($wxresult){
        $cacheValue=$wxresult;
        $cacheValue['uid']=$this->user_id;
        return $cacheValue;
    }

    /**
     * 保存缓存
     * @param unknown $cacheValue
     * @throws TokenException
     * @return string
     * ***/
    private function saveToCache($cacheValue){
        $key=self::generateToken();
        $value=json_encode($cacheValue); 
        cache([$key=>$value],config('extra.secure.cache_expire_time'));
        if (cache($key)){
            return $key;
        }
        throw new TokenException([
            'msg'=>'服务器缓存错误',
            'errorcode'=>'10005',
        ]);
    }


    /**
     * 组装token
     * @param unknown $wxresult
     * @return string
     * ***/
    private function grantToken($wxresult){
        $user=UserModel::getByOpenID($this->openid);
        if ($user){
            $this->user_id=$user->id;
        }else{
            $this->createUser($wxresult);
        }
        $cacheValue=$this->prepareCacheValue($wxresult);
        $token=$this->saveToCache($cacheValue);
        return $token;
    }

    /**
     * 新增User
     * @return $user_id
     * ***/
    private function createUser(){
       $user=UserModel::create([
            'openid'=>$this->openid,
           
        ]);
        return $this->user_id=$user->id;
    }
    
}

