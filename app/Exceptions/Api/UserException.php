<?php
namespace App\Exceptions\Api;
use App\Exceptions\BaseException;
class UserException extends BaseException
{
    public $code=401;
    public $message="用户不存在";
    public $errorCode=10002;
}

