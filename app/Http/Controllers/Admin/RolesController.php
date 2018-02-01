<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Service\Admin\RolesServer;
use App\Http\Requests\Admin\RoleRequest;
use Illuminate\Http\Request;
use App\Exceptions\SuccessMessage;
use App\Exceptions\Api\MissException;
use App\Service\Admin\RulesServer;
class RolesController extends Controller
{
    

    protected $RolesServer;
    protected $RulesServer;
    public function __construct(RolesServer $roleserver,RulesServer $RulesServer){
        $this->RolesServer=$roleserver;
        $this->RulesServer=$RulesServer;
    }
   
    
    /**
     * 角色列表页面
     * method get
     * url admin/role
     * **/
    public function index(){
       $roles=$this->RolesServer->getroles();
       return view('admin.roles.index',['roles'=>$roles]);
    }
    
    /**
     * 创建角色页面
     * method get
     * url admin/roles/create
     * **/
    public function create(){
        return view('admin.roles.create');
    }
    
    /**
     * 创建角色 操作
     * method POST
     * url admin/roles
     * **/
    public function store(RoleRequest $request){
        $this->RolesServer->create($request);
        flash('新增成功')->success()->important();
        return redirect()->route('role.index');
    }
    
    /**
     * 修改页面
     * method get
     * url admin/roles/{admin}/edit
     * **/
    
    public function edit(Request $request,$id){
        $role=$this->RolesServer->ById($id);
        return view('admin.roles.edit',['role'=>$role]);
    }
    
    /**
     * 更新 操作
     * method put
     * url admin/roles/{admin}
     * **/
    public function update(RoleRequest $request,$id){
        
        $this->RolesServer->update($request,$id);

        flash('更新资料成功')->success()->important();
        
        return redirect()->route('role.index');
    }
    
    /**
     * 删除  
     * method delete
     * url admin/roles/{admin}
     * **/
    public function destroy(Request $request,$id){
        if($this->RolesServer->delete($id)){
            throw new SuccessMessage();
        }else{
           throw new MissException(['msg'=>'删除失败']);
        } 
    }
    
    /**
     * 展示分配权限页面
     * method get
     * url  admin/role/access/{id}
     * @return
     */
    public function access(Request $request,$id)
    {
        $role=$this->RolesServer->ById($id);
        $data=$this->RulesServer->getRulesChannelLevel($id);
        $rules=$role->rules()->get()->pluck('id')->toArray();
        return view('admin.roles.access',['role'=>$role,'datas'=>$data['data'],'rules'=>$rules]);
    }
    
    /***
     * 分配权限 操作
     * method POST
     * url admin/role/group-access/{id}
     * **/
    public function groupAccess(Request $request,$id){
        $this->RolesServer->groupAccess($id,$request->post('rule_id'));
        flash('分配权限成功')->success()->important();
        return redirect()->route('role.index');
    }
    
}

