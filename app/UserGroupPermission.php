<?php
/**
 * Created by PhpStorm.
 * User: Adam
 * Date: 19/05/2019
 * Time: 15:59
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class UserGroupPermission extends Model
{
    protected $table = 'permission';
    protected $fillable = ['name'];

    public function groupPermissions()
    {
        return $this->hasMany('App\UserGroupPermissions', 'groupID', 'id');
    }
}