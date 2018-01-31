<?php
namespace App\Listeners;
use App\Events\UserAuth;
use App\Validates\Api\TokenValidate;
use App\Service\Api\TokenService;
use App\Exceptions\Api\TokenException;
class UserAuthListener
{
    public function __construct()
    {
        //
    }
    
    /**
     * 处理事件.
     *
     * @param  OrderShipped  $event
     * @return void
     */
    public function handle(UserAuth $event)
    {   
        self::checkToken();
        return ;
    }
    
    
    private static function checkToken(){
        (new TokenValidate())->goCheck();
        $token=request()->header('token');
        $status=TokenService::verifyToken($token);
        if (!$status){
            throw new TokenException();
        }
    }
    
    private function rsaDesign($data){
        $return=false;
        if (is_array($data)){
            if (isset($data['sign'])){
                require_once (app_path().'/libs/rsa/Token.class.php');
                $config=array(
                    'rsa_private_key_file'=>app_path().'/libs/rsa/rsa_private_key.pem',
                    'rsa_public_key_file'=>app_path().'/libs/rsa/rsa_public_key.pem',
                );
                $sign=$data['sign'];
                unset($data['sign']);
                $token=new \Token($config);
                $unsign=$token->get_public_key_sign($sign);
                $data=$token->arg_sort($data);
                $string=$token->getUrlQuery($data);
                if (strlen($string)>100){
                    $string=mb_substr($string,0,80);
                }
                if ($unsign==$string) $return = true;
            }
        }
        return $return;
    }
    
    private function rsaSign($url,$data){
        $string=null;
        $result=false;
        if (is_array($data)){
            require_once (app_path().'/libs/rsa/Token.class.php');
            $config=array(
                'rsa_private_key_file'=>app_path().'/libs/rsa/rsa_private_key.pem',
                'rsa_public_key_file'=>app_path().'/libs/rsa/rsa_public_key.pem',
            );
            $token=new \Token($config);
            $data=array_filter($data);
            $data=$token->arg_sort($data);
            $string=$token->getUrlQuery($data);
            if (strlen($string)>100){
                $string=mb_substr($string,0,80);
            }
            $string=$token->set_private_key_sign($string);
            if (empty($string)){
                return false;
            }
        }
        $data['sign']=$string;
        if ($string){
            $data['sign']=$string;
            $result=json_encode($data,JSON_UNESCAPED_UNICODE);
        }
        return $data;
    }
}

