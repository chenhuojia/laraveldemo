<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActionLogModel extends Model
{
    protected $fillable = ['admin_id','data'];
    protected $table="action_logs";
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function admin()
    {
        return $this->belongsTo(AdminModel::class);
    }

    /**
     * data数据修饰器
     * @param $value
     * @return mixed
     */
    public function getDataAttribute($value)
    {
        return json_decode($value,true);
    }
}
