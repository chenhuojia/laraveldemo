<?php
namespace App\Validates;
use Validator;
use Illuminate\Http\Request;
use App\Exceptions\Api\ParmaeterException;
class BaseValidate
{
    
    public $rules=[];
    public $messages=[];
    
    public function goCheck(){
        $params=request()->all();
        $header=request()->header();
        if (isset($header['token'])){
            $params['token']=$header['token'];
        }
        $validator= Validator::make($params,$this->rules,$this->messages);
        if ($validator->fails()){
            $error=$this->getErrors($validator);
            throw new ParmaeterException(['msg'=>$error]);
        }
        return true;
    }
    
    private function getErrors($validator){
        $message=$validator->errors()->all();
        return is_array($message)?implode(';',$message) : $message;
    }
    
    
}

