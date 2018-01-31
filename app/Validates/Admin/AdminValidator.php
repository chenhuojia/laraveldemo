<?php
namespace App\Validates\Admin;

use App\Validates\BaseValidate;

class AdminValidator extends BaseValidate
{
    
    protected $rules=[
            'username'=>'required',
            'password'=>'required'
        ];
    
    protected $messages=[
        'username.required' => 'A用户名必须',
        'password.required' => 'A密码必须',
    ];
    
}

