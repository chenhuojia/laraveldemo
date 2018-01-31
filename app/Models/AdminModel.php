<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminModel extends Model
{
    protected $table='admins';
    protected $primaryKey= 'id';
    protected $fillable = ['name', 'password', 'avatr', 'login_count', 'create_ip', 'last_login_ip', 'status'];
    //public $timestamps=false;
    
    public function roles()
    {
        return $this->belongsToMany('App\Models\RolesModel','admin_role','admin_id','role_id')->withTimestamps();
    }
    

    
}

