<?php
namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;
use App\Jobs\SendTest;
class IndexController extends Controller{
    
    public function index(){
        #return 111;
	$job=(new SendTest())->delay(120);
	$this->dispatch($job);
	return 789;
    }
}
