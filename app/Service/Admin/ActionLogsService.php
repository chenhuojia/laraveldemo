<?php
/**
 * YICMS
 * ============================================================================
 * 版权所有 2014-2017 YICMS，并保留所有权利。
 * 网站地址: http://www.yicms.vip
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * Created by PhpStorm.
 * Author: kenuo
 * Date: 2017/11/17
 * Time: 下午4:38
 */

namespace App\Service\Admin;
use Route;
use Zhuzhichao\IpLocationZh\Ip;
use App\Models\ActionLogModel;
use App\Models\RulesModel;

class ActionLogsService
{
   // protected $rulesRepository;

    protected $actionLogsRepository;

    /**
     * ActionLogsService constructor.
     * @param $actionLogsRepository
     */
    public function __construct( )
    {
        //$this->rulesRepository = $rulesRepository;

    }

    /**
     * 登录操作日志
     * @param $request
     * @return mixed
     */
    public function loginActionLogCreate($request,$status = false)
    {
        //获取当前登录管理员信息
        $admin = session(config('extra.admin.admin_cache_key'));

        $ip = $request->getClientIp();

        $address = Ip::find($ip);

        $action = $status ? "管理员: {$admin->name} 登录成功" : " 登录失败,登录的账号为：{$request->username}　密码为：{$request->password}";

        $data = [            
            'ip'=> $ip,
            'address'=> $address[0].$address[1].$address[2],
            'action'=> $action,
        ];

        $datas['data'] = json_encode($data);
        $datas['type'] = 2;
        return $this->create($datas);
    }


    /**
     * 后台操作日志
     * @param $request
     * @return mixed
     */
    public function mudelActionLogCreate($request)
    {
        $path = Route::currentRouteName();
        $rule = RulesModel::where('route','=',$path)->first();
        if(is_null($rule)) return false;

        //获取当前操作方法上级模块名称
        if($rule->parent_id != 0)
        {
            $parent_rule =RulesModel::find($rule->id);
        }else{
            $parent_rule=(object)['name'=>$rule->name];
        }
    
        //获取当前登录管理员信息
         $admin = session(config('extra.admin.admin_cache_key'));

        $address = Ip::find($request->getClientIp());
        $action = "管理员: {$admin->name} 操作了 【{$parent_rule->name}】- {$rule->name} 模块";

        $data = [
            'ip'=> $request->getClientIp(),
            'address'=> $address[0].$address[1].$address[2],
            'action'=> $action,
        ];

        $datas['admin_id'] = $admin->id;
        $datas['data'] = json_encode($data);
        $datas['type'] = 1;
        isset($admin->id) ? $datas['admin_id'] = $admin->id : null;
        return $this->create($datas);
    }
   
    /**
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        return ActionLogModel::create($data);
    }
    
    /**
     * 获取全部的操作日志
     * @return mixed
     */
    public function getWithAdminActionLogs()
    {
        return ActionLogModel::with('admin')->latest('created_at')->paginate(20);
    }
}