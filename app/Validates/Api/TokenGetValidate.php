<?php
namespace App\Validates\Api;

use App\Validates\BaseValidate;

class TokenGetValidate extends BaseValidate
{
    
    public $rules=[
        'code'=>'required'
    ];
    
    public $messages=[
        'code.required'=>'要拿token必须要code'
    ];
    
}

