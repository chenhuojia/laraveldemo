<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    protected $table='user';
    protected $primaryKey= 'id';
    protected $fillable=['id','openid'];
    public $timestamps=false;
    
    public static function getByOpenID($openid){
       return self::where('openid',$openid)->first();
    }
}

