<?php
namespace App\Exceptions\Api;
use App\Exceptions\BaseException;
class OrderException extends BaseException
{
    public $code=404;
    public $msg="订单信息有误";
    public $errorCode=10008;
    
}

