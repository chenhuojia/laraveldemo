<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminLoginRequest extends FormRequest
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
           'username'=>'required',
           'password'=>'required',
        ];
    }
    
    public function messages(){
        return [
            'username.required' => '用户名必须',
            'password.required'  => '密码必须',
        ];
    }
}

