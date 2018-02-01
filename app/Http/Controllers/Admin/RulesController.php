<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\Admin\RulesServer;
use App\Http\Requests\Admin\RulesRequest;
use App\Exceptions\SuccessMessage;
use App\Exceptions\Api\MissException;
class RulesController extends Controller
{
    
    protected $RuleServer;
    public function __construct(RulesServer $RuleServer){
        $this->RuleServer=$RuleServer;
    }
   
    
    /**
     * 权限列表页面
     * method get
     * url admin/rule
     * **/
    public function index(){
       
        $rules=$this->RuleServer->getRulesTree();
        //return $admins->links();
        return view('admin.rules.index',['rules'=>$rules]);
    }
    
    /**
     * 创建权限页面
     * method get
     * url admin/rule/create
     * **/
    public function create(){
        $rules=$this->RuleServer->getRulesTree();
        return view('admin.rules.create',['rules'=>$rules]);
    }
    
    /**
     * 创建权限 操作
     * method POST
     * url admin/rule
     * **/
    public function store(RulesRequest $request){
        $this->RuleServer->create($request);
        flash('新增成功')->success()->important();
        return redirect()->route('rule.index');
    }
    
    /**
     * 修改页面
     * method get
     * url admin/rule/{admin}/edit
     * **/
    
    public function edit(Request $request,$id){
        $rules=$this->RuleServer->getRulesTree();
        $rule = $this->RuleServer->ById($id);
        return view('admin.rules.edit',['rules'=>$rules,'rule'=>$rule]);
    }
    
    /**
     * 更新 操作
     * method put
     * url admin/rule/{admin}
     * **/
    public function update(RulesRequest $request,$id){

        $this->RuleServer->update($request,$id);
        flash('更新资料成功')->success()->important();
        return redirect()->route('admins.index');
    }
    
    /**
     * 删除  
     * method delete
     * url admin/rule/{admin}
     * **/
    public function destroy(Request $request,$id){
       if($this->RuleServer->delete($id)){
            throw new SuccessMessage();
        }else{
           throw new MissException(['msg'=>'删除失败']);
        }
    }
    

    
}

