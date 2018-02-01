<?php
namespace App\Listeners;
use App\Events\AdminAuth;
use Route;
use App\Models\Traits\RbacCheck;
class AdminAuthListener
{
    use RbacCheck;
    public function __construct()
    {
        //
    }
    
    /**
     * 处理事件.
     *
     * @param  OrderShipped  $event
     * @return void
     */
    public function handle(AdminAuth $event)
    {   
        return $this->checkToken();
    }
    
    
    private  function checkToken(){
        if($this->checkLoginAdmin()){
            $route=Route::currentRouteName(); 
            if(!in_array($route,$this->getRules())){
                 return ['error'=>'你没有权限','code'=>403,'url'=>'admin.index'];
            }else{
                return ['error'=>'','code'=>200,'url'=>''];
            }  
        }
         return ['error'=>'请先登录','code'=>401,'url'=>'admin.login'];
    }
    

}

