<?php
/**
 * Created by PhpStorm.
 * User: Adam
 * Date: 04/05/2019
 * Time: 13:05
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    protected $table = 'usergroups';
    protected $fillable = ['name'];

    public function permissions()
    {
        return $this->hasMany('App\UserGroupPermissions', 'groupID', 'id');
    }

    public function members()
    {
        return $this->hasMany('App\UserGroupMember', 'groupID', 'id');
    }
}