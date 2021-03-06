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
 * Time: 下午2:30
 */

namespace App\Models\Traits;

use App\Handlers\Tree;
use Cache;
use App\Models\RulesModel;

trait RbacCheck
{
    // 缓存相关配置
    protected $cache_key = '_cache_rules';

    protected $menu_cache = '_menu_cache'; //菜单缓存key
    
    //protected $admin_cache_key='_admin_cache_key';
    protected $id=0;
    
    
    /**
     * 获取当前用户的所有权限
     * @return mixed
     */
    public function getRules()
    { 
        $this->checkLoginAdmin();
        $cache_key = $this->id . $this->cache_key;
        if(!Cache::tags(['rbac', 'rules'])->has($cache_key))
        {
            $permissions = [];

            foreach ($this->roles as $role) {
                $permissions = array_merge($permissions, $role->rules()->pluck('route')->toArray());
            }
           
            /**获得当前用户所有权限路由*/
            $permissions = array_unique($permissions);
            /**将权限路由存入缓存中*/
            Cache::tags(['rbac', 'rules'])->forever($cache_key, $permissions);
        }
        return Cache::tags(['rbac', 'rules'])->get($cache_key);
    }

    /**
     * 获取树形菜单导航栏
     * @return array
     */
    public function getMenus()
    {   
        $this->checkLoginAdmin();
        $menu_cache = $this->id . $this->menu_cache;
        if (!Cache::tags(['rbac', 'menus'])->has($menu_cache))
        { 
            $rules = [];
            //判断是否是超级管理员用户组
            if (in_array(1, $this->roles->pluck('id')->toArray()))
            {
                //超级管理员用户组获取全部权限数据
                $rules = RulesModel::orderBy('sort','asc')->where('is_hidden',1)->get()->toArray();

            } else {
    
                foreach ($this->roles as $role)
                {
                    $rules = array_merge($rules, $role->rulesPublic()->toArray());
                }
                
                if($rules)
                {
                    $rules = unique_arr($rules);
                }
                
            }
            /**将权限路由存入缓存中*/
            Cache::tags(['rbac', 'menus'])->put($menu_cache, $rules,86400);
        }
        $rules = Cache::tags(['rbac', 'menus'])->get($menu_cache);
        $tree=Tree::array_tree($rules);       
        if (!session('admin_menu')){
            session(['admin_menu'=>$tree]);
        }
        return $tree;
    }

    /**
     * 删除权限缓存和菜单缓存
     * @return bool
     */
    public function clearRuleAndMenu()
    {
        return Cache::tags('rbac')->flush();
    }
    
    public function createRuleAndMenu($admin){
        //$this->roles=$admin->roles()->get();
        $this->getRules();
        $this->getMenus();
        //dump($this->getMenus());
        //return $this->roles;
    }
    
    public  function checkLoginAdmin(){
        if($admin=session(config('extra.admin.admin_cache_key'))){
            $this->id=$admin->id;
            if (!$this->roles=session('admin_roles')){
                $this->roles=$admin->roles()->get();
                session(['admin_roles'=>$this->roles]);
            }
            return true;
        }
        return false;
    }
}