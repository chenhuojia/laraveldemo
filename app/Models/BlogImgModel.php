<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class BlogImgModel extends Model{
    
    protected $table='blog_img';
    public $timestamps = false;
    
    protected $fillable=['blog_id','url','status'];
    

}