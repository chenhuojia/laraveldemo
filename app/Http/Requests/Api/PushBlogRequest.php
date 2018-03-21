<?php
namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class PushBlogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
           'title'=>'required',
           'longitude'=>'required',
           'latitude'=>'required',
           'desc'=>'required',
           'images'=>'required',
        ];
    }
    
    public function messages(){
        return [
            'title.required' => '标题必须',
            'longitude.required'  => '经度必须',
            'latitude.required'=>'纬度必须',
            'desc.required'=>'简介必须',
            'images.required'=>'图片必须上传'
        ];
    }
}

