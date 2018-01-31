<?php
namespace App\Exceptions;
use App\Exceptions\BaseException;
class SuccessMessage extends BaseException
{
    public $code=201;
    public $msg='success';
    public $errorCode=0;
}

