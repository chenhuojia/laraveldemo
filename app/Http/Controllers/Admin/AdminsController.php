<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\AdminRequest;
use App\Service\Admin\AdminServer;
use App\Models\AdminModel;
use App\Service\Admin\RolesServer;
use App\Exceptions\SuccessMessage;
use App\Exceptions\Api\MissException;
class AdminsController extends Controller
{
    
    protected $AdminServer;
    protected $RolesServer;
    public function __construct(AdminServer $AdminServer,RolesServer $RolesServer){
        $this->AdminServer=$AdminServer;
        $this->RolesServer=$RolesServer;
    }
   
    
    /**
     * 管理员列表页面
     * method get
     * **/
    public function index(){
        $admins=$this->AdminServer->getAdmins();
        //return $admins->links();
        return view('admin.admins.index',['admins'=>$admins]);
    }
    
    /**
     * 创建管理员页面
     * method get
     * url admin/admins/create
     * **/
    public function create(){
        $roles=$this->RolesServer->getRoles();
        return view('admin.admins.create',['roles'=>$roles]);
    }
    
    /**
     * 创建管理员 操作
     * method POST
     * url admin/admins
     * **/
    public function store(AdminRequest $request){
        $this->AdminServer->create($request);
        flash('新增成功')->success()->important();
        return redirect()->route('admins.index');
    }
    
    /**
     * 修改页面
     * method get
     * url admin/admins/{admin}
     * **/
    
    public function edit(Request $request,$id){
        //return $request->route('admins');
        $admin=AdminModel::find($id);
        $roles=$this->RolesServer->getRoles();
        $rolesID=$admin->roles->pluck('id')->toArray();
        return view('admin.admins.show',['admin'=>$admin,'roles'=>$roles,'rolesID'=>$rolesID]);
    }
    
    /**
     * 更新 操作
     * method put
     * url admin/admins/{admin}
     * **/
    public function update(AdminRequest $request,$id){

        $this->AdminServer->update($request,$id);

        flash('更新资料成功')->success()->important();
        
        return redirect()->route('admins.index');
    }
    
    /**
     * 删除  
     * method delete
     * url admin/admins/{admin}
     * **/
    public function destroy(Request $request,$id){
        if($this->AdminServer->delete($id)){
            throw new SuccessMessage();
        }else{
           throw new MissException(['msg'=>'删除失败']);
        } 
    }
    
}

