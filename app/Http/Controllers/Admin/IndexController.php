<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Events\Test;

class IndexController extends Controller{
    
    
    public function index(){
        
        
        return view('admin.index.index');
    }

    
    
    public function indexTest(){
        
        
        return event(new Test());
    }
}