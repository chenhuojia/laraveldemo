<?php
namespace App\Models;

use App\Models\BaseModel;
class BlogModel extends BaseModel{
    
    protected $table='blog';
    protected $fillable =['user_id','section_id','title','content','start_time','deadline','address','contact_phone','create_time','update_time','discuss','approve','status'];

    public function images()
    {
        return $this->hasMany('App\Models\BlogImgModel', 'blog_id', 'id');
    }

}