<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
        if (request()->method()=='PUT'){
            return [
                'username'=>'required',
               // 'password'=>'required',
                'role_id'=>'required|array',
                'status' => 'required:integer',
            ];
        }else{
            return [
                'username'=>'required',
                'password'=>'required',
                'role_id'=>'required|array',
                'status' => 'required:integer',
            ];
        }
        
    }
    
    public function messages(){
        return [
            'username.required' => '用户名必须',
            'password.required'  => '密码必须',
            'role_id.required'   => '请选择角色'
        ];
    }
}

