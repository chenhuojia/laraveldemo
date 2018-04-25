<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Jobs\SendTest;


class IndexController extends Controller{
    
    
    public function index(){
        
        
        return view('admin.index.index');
    }

    
    
    public function indexTest(){
        
       $params=request()->all();
       SendTest::dispatch($params)->delay(now()->addMinutes(1));
       return $params;
    }
}