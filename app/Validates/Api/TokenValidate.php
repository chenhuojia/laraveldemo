<?php
namespace App\Validates\Api;

use App\Validates\BaseValidate;

class TokenValidate extends BaseValidate
{
    public $rules=[
        'token'=>'required'
    ];
    
    public $messages=[
        'token.required'=>'token不能为空'
    ];
}

