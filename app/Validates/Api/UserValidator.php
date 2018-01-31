<?php
namespace App\Validates\Api;

use App\Validates\BaseValidate;

class UserValidator extends BaseValidate
{
    public $rules=[
        'token'=>'required'
    ];
    
    public $message=[
        'token.required'=>'token不存在'
    ];
    
}

