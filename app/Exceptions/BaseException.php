<?php
namespace App\Exceptions;

class BaseException extends \Exception
{
    public $code='404';
    public $errorcode='10000';
    public $msg='非法操作';
    
    public function __construct($data=[])
    {   
        
        if (!is_array($data)) return;
        if (array_key_exists('code', $data)){
            $this->code=$data['code'];
        }
        if (array_key_exists('msg', $data)){
            
            $this->msg=$data['msg'];
        }
        if (array_key_exists('errorcode', $data)){
            $this->errorcode=$data['errorcode'];
        }
        $this->message=$this->msg;
        parent::__construct();
    }
}

