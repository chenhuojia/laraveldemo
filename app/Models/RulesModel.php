<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RulesModel extends Model
{
    protected $table='rules';
    protected $primaryKey= 'id';
    protected $fillable = ['name', 'fonts', 'route', 'parent_id', 'is_hidden', 'sort', 'status'];

    public function roles()
    {
        return $this->belongsToMany(RolesModel::class, 'role_auth','rule_id','role_id')->withTimestamps();
    }
}

