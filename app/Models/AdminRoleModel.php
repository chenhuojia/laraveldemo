<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminRoleModel extends Model
{

    protected $table='admin_role';
    protected $primaryKey= 'id';
    protected $fillable = ['admin_id','role_id'];
    
    
}

