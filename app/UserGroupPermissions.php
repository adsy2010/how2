<?php
/**
 * Created by PhpStorm.
 * User: Adam
 * Date: 04/05/2019
 * Time: 13:05
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class UserGroupPermissions extends Model
{

    protected $table = 'permissions';
    protected $fillable = ['groupID', 'permissionID'];

    public function usergroups()
    {
        return $this->hasMany('App\UserGroup', 'id', 'groupID');
    }

    public function permissions()
    {
        return $this->hasMany('App\UserGroupPermission', 'id', 'permissionID');
    }

}