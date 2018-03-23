<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Service\Api\TokenService;

class ApiController extends Controller{
    protected $user_id=0;
    
    public function __construct(){
        $this->user_id=TokenService::getCurrentUid();
    }
}