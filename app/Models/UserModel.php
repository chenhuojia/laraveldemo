<?php
namespace App\Models;

use App\Models\BaseModel;
class UserModel extends BaseModel
{
    protected $table='user';
    protected $primaryKey= 'id';
    protected $fillable=['id','openid','longitude','latitude','status','create_time','update_time'];

    
    public static function getByOpenID($openid){
       return self::where('openid',$openid)->first();
    }
}

