<?php
namespace App\Service\Admin;

use App\Models\RolesModel;
use Illuminate\Support\Facades\DB;
use App\Models\Traits\RbacCheck;
class RolesServer
{
    use RbacCheck;
    protected  $role;
    
    public function __construct(RolesModel $role){
        $this->role=$role;
    }
    
    //获取所有角色
    public function getRoles(){
       return  $this->role->get();
    }
    
    //获取角色
    public function ById($id){
        return  $this->role->find($id);
    }
    //创建角色
    public function create($request){
       $this->role->fill($request->all());
       $this->role->save();
       return true;
    }
    
    //更新角色
    public function update($request,$id){
        $role= $this->ById($id);
        $role->update([
            'name'=>$request->name,
            'remark'=>$request->remark,
            'order'=>$request->order,
            'status'=>$request->status,
        ]);
        return $role;
    }
    
    /**
     * 删除角色
     * @return boolean
     * ***/
    public function delete($id){
        $role=$this->ById($id);
        if(empty($role))
        {
            return false;
        }
        $role->delete();
        $role->rules()->detach();
        $role->admins()->detach();
        return true;
    }
    
    /**
     * 分配角色权限
     * @return array
     * ***/
    public function groupAccess($roleID,$data){
        $role= $this->ById($roleID);     
        $role->rules()->sync($data);
        return $role;
    }
    
}

