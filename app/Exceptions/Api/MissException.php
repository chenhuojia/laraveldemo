<?php
namespace App\Exceptions\Api;
use App\Exceptions\BaseException;
class MissException extends BaseException
{
    public $code=404;
    public $msg='未找到资源';
    public $errorCode=10001;
}

