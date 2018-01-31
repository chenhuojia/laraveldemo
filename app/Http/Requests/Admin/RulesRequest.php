<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RulesRequest extends FormRequest
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
           'name'=>'required',
           'parent_id'=>'required:integer',
           'status' => 'required:integer',
           'is_hidden' => 'required:integer',
        ];
    }
    
    public function messages(){
        return [
            'name.required' => '权限名称必须',
            'parent_id.required'  => '上级权限必须',
            'status.required'  => '状态必须',
            'is_hidden.required'   => '是否隐藏必须'
        ];
    }
}

