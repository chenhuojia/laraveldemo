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
       $job=(new SendTest($params))->delay(60);
       $this->dispatch($job);
       //SendTest::dispatch($params)->delay(60);
       return $params;
    }
}