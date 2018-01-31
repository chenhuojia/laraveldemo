<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RolesModel extends Model
{
    protected $table='roles';
    protected $primaryKey= 'id';
    protected $fillable =['name','remark','order','status'];
    
    public function admins()
    {
        return $this->belongsToMany(AdminModel::class,'admin_role','role_id','admin_id')->withTimestamps();
    }
    
    public function rules()
    {
        return $this->belongsToMany(RulesModel::class,'role_auth','role_id','rule_id')->withTimestamps();
    }
    /**
     * 获取显示的权限
     * @return mixed
     */
    public function rulesPublic()
    {
        return $this->rules()->where('is_hidden','=',0)->orderBy('sort','asc')->get();
    }
}

