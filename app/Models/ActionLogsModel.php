<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActionLogsModel extends Model
{
    protected $table='action_logs';
    protected $fillable = ['admin_id','data'];
    
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
    
}

