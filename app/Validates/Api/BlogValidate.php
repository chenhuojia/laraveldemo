<?php
namespace App\Validates\Api;

use App\Validates\BaseValidate;

class BlogValidate extends BaseValidate
{
    
    public $rules=[
        'section_id'=>'required',
        'title'=>'required',
        'content'=>'required',
        'start_time'=>'required',
        'address'=>'required',
        'longtitude'=>'sometimes|required',
        'latitude'=>'sometimes|required',
        'images'=>'sometimes|required|array'
    ];
    
    public $messages=[
        'section_id.required'=>'部门必选',
        'title.required'=>'标题必填',
        'content.required'=>'内容必填',
        'start_time.required'=>'开始时间必填',
        'address.required'=>'地址必填',
    ];
    
    
    
}

