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
    
    /**
     * 新增blog
     * @method POST
     * @url /api/blog
     * @param Request $request
     * @return \App\Service\Api\unknown
     * ***/
    public function store(Request $request){
         (new BlogValidate())->goCheck();
         $userId=TokenService::getCurrentUid();
         return BlogService::create($request,$userId);
    }
    
    /**
     * 更新blog
     * @method PUT|PATCH
     * @url /api/blog/{blog}
     * @param Request $request
     * @return boolean
     * ***/
    public function update(Request $request){
        (new BlogValidate())->goCheck();
        $userId=TokenService::getCurrentUid();
        return $blog=BlogService::update($request,$userId);
    }
}

