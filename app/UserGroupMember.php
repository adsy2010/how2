<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class UserGroupMember extends Model
{
    protected $table = 'usergroupmembers';

    protected $fillable = ['userID', 'groupID'];

    public function user(){
        return $this->hasOne('App\User', 'id', 'userID');
    }

    public function groupInfo()
    {
        return $this->hasOne('App\UserGroup', 'id', 'groupID');
    }
}