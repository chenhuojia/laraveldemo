<?php
namespace App\Listeners;
use App\Events\AdminAuth;
use Route;
use App\Models\Traits\RbacCheck;
use App\Service\Admin\ActionLogsService;
class AdminAuthListener
{
    use RbacCheck;
    protected $actionLogsService;
    public function __construct(ActionLogsService $actionLogsService)
    {
        $this->actionLogsService=$actionLogsService;
    }
    
    /**
     * 处理事件.
     *
     * @param  OrderShipped  $event
     * @return void
     */
    public function handle(AdminAuth $event)
    {   
        $this->actionLog($event->post);
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
    
    
    private function actionLog($request){
        /**记录用户操作日志**/
        if(in_array($request->method(),['POST','PUT','PATCH','DELETE']))
        {
            $this->actionLogsService->mudelActionLogCreate($request);
        }
    }

}

