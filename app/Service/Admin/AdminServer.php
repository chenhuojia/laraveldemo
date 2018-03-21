<?php
namespace App\Service\Admin;
use App\Models\AdminModel;
use Illuminate\Support\Facades\Hash;
use App\Models\Traits\RbacCheck;
use App\Exceptions\Api\ParmaeterException;
class AdminServer
{
    use RbacCheck;
    //新增管理员
    public function create($request){
        $admin=AdminModel::create([
            'name'=>$request->username,
            'password'=>Hash::make($request->password),
            'status'=>$request->status,
            'create_ip'=>$request->ip(),
        ]);
       $admin->roles()->attach($request->role_id);
       return $admin;
    }
    
    //更新管理员
    public function update($request,$id){
        $admin=$this->ById($id);
        $datas=[
            'name'=>$request->username,
            'password'=>$request->password,
            'status'=>$request->status,
            'create_ip'=>$request->ip(),
        ];
        if (!empty(($datas['password']))) {
            $datas['password'] = Hash::make($request->password);
        } else {
            unset($datas['password']);
        }
        $admin->update($datas);
        $admin->roles()->sync($request->role_id);
        return $admin;
    }
    
    /**
     * 根据id获取管理员资料
     * @param $id
     * @return mixed
     */
    public function ById($id)
    {
        return AdminModel::find($id);
    }
    
    /**
     * 获取所有管理员
     * @return array
     * ***/
    public function getAdmins(){
        return AdminModel::with('roles')->latest('updated_at')->paginate('10');
    }
    
    /**
     * 删除管理员
     * @return boolean
     * ***/
    public function delete($id){
        $admin=$this->ById($id);
         if(empty($admin))
        {
            return false;
        }
        $admin->roles()->detach();
        $admin->delete();
        return true;
    }
    
    
    public function Login($request){  
       throw new ParmaeterException();
      $admin=AdminModel::where('name','=',$request->username)->first();
      if (empty($admin)){
          (new ActionLogsService())->loginActionLogCreate($request);
          return viewError('管理员不存在','admin.login');
      }
      if(!Hash::check($request->password,$admin->password)){
          (new ActionLogsService())->loginActionLogCreate($request);
          return viewError('管理员密码不匹配','admin.login');
      }
      $admin->update([
        'login_count'=>($admin->login_count+1),
        'last_login_ip'=>$request->ip(),
      ]);
      //$admin->increment('login_count');
      $request->session()->put(config('extra.admin.admin_cache_key'),$admin);
      $this->createRuleAndMenu($admin);
      (new ActionLogsService())->loginActionLogCreate($request,true);
      return redirect()->route('admin.index');
    }
    
    public function logout($request){
        return $request->session()->flush();
        //$this->clearRuleAndMenu();
    }
}

