<?php
namespace App\Exceptions\Api;
use App\Exceptions\BaseException;
class ParmaeterException extends BaseException
{
    public $code=405;
    public $msg='参数错误';
    public $errorCode=10000;
    
}

