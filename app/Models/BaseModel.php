<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model{
    protected $dateFormat = 'U';
    protected $primaryKey= 'id';
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';
}