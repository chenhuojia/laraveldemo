<?php
namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;
use App\Service\Api\TokenService;


class UserController extends Controller{
    
    
    
    public function bindSchool(){
        $userID=TokenService::getCurrentUid();
    }
}