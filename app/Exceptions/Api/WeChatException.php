<?php
namespace App\Exceptions\Api;
use App\Exceptions\BaseException;

class WeChatException extends BaseException
{
     //http 状态码
    public $code=400;
    //异常解析
    public $msg='微信内部错误';
    //自定义错误码
    public $errorCode=10000; 
}

