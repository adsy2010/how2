<?php
/**
 * Created by PhpStorm.
 * User: Adam
 * Date: 19/05/2019
 * Time: 15:59
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    protected $table = 'permission';
    protected $fillable = ['name'];

    public function rolePermissions()
    {
        return $this->hasMany('App\RolePermissions', 'permissionID', 'id');
    }

    public function groups()
    {
        return $this->hasManyThrough('App\UserGroup', 'App\RolePermissions', 'permissionID', 'groupID', 'groupID', 'groupID')->where('permissionID', $this->id);
    }
}