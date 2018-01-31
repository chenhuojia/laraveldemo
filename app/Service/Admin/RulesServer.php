<?php
namespace App\Service\Admin;
use App\Models\RulesModel;
use App\Handlers\Tree;
class RulesServer
{
    protected  $model;
    
    public function __construct(RulesModel $model){
        $this->model=$model;
    }
    
    /**
     * 获取树形结构权限列表
     * @return array
     */
    public function getRulesTree()
    {
        $rules = $this->model->orderBy('sort','asc')->get()->toArray();
        return Tree::tree($rules,'name','id','parent_id');
    }
    
    /**
     * 获取等级结构权限列表
     * @return unknown[]
     * ***/
    public function getRulesChannelLevel()
    {
        $rules = $this->model->orderBy('sort','asc')->get();
        $data=Tree::channelLevel($rules, 0, '&nbsp;', 'id','parent_id');
        return ['rules'=>$rules,'data'=>$data];
    }
    
    //新增权限
    public function create($request){
        $rule=$this->model->create([
            'name'=>$request->name,
            'route'=>$request->route,
            'status'=>$request->status,
            'parent_id'=>$request->parent_id,
            'sort'=>$request->sort,
            'is_hidden'=>$request->is_hidden,
        ]);     
       return $rule;
    }
    
    //更新权限
    public function update($request,$id){
        $rule=$this->ById($id);
        $rule->update([
            'name'=>$request->name,
            'route'=>$request->route,
            'status'=>$request->status,
            'parent_id'=>$request->parent_id,
            'sort'=>$request->sort,
            'is_hidden'=>$request->is_hidden,
        ]);
        return $rule;
    }
    
    /**
     * 根据id获取权限资料
     * @param $id
     * @return mixed
     */
    public function ById($id)
    {
        return $this->model->find($id);
    }
    
    
    /**
     * 删除权限
     * @return boolean
     * ***/
    public function delete($id){
        $rule=$this->ById($id);
         if(empty($rule))
        {
            return false;
        }
        $rule->delete();
        $rule->roles()->detach();
        return true;
    }
    
    
    public function getRulesAndPublic(){
        return $this->model->orderBy('sort','asc')->public()->get();
    }
}

