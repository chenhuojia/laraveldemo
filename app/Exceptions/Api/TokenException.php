<?php
namespace App\Exceptions\Api;
use App\Exceptions\BaseException;
class TokenException extends BaseException
{
    public $code=401;
    public $msg='token有误或已过期';
    public $errorCode=10000;
    
    
}

