<?php
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Validates\Api\BlogValidate;
use App\Service\Api\BlogService;
use Dingo\Api\Contract\Http\Request;
use App\Service\Api\TokenService;


class BlogController extends Controller
{
    
    
    public function index(){
       
    }
    
    
    public function createBlog(Request $request){
         (new BlogValidate())->goCheck();
         $blog=new BlogService();
         $userId=TokenService::getCurrentUid();
         return $blog->create($request,$userId);
    }
    
    public function updateBlog(Request $request){
        (new BlogValidate())->goCheck();
        $blog=new BlogService();
        $userId=TokenService::getCurrentUid();
        return $blog->update($request,$userId);
    }
}

