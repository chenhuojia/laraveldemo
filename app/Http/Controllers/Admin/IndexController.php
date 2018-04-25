<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Jobs\SendTest;


class IndexController extends Controller{
    
    
    public function index(){
        
        
        return view('admin.index.index');
    }

    
    
    public function indexTest(){
        
        
        return SendTest::dispatch(request()->all())->delay(now()->addMinutes(1));
    }
}