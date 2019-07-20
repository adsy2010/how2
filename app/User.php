<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function usergroups()
    {
        return $this->hasMany('App\UserGroupMember', 'userID', 'id');
    }

    public function feedback()
    {
        return $this->hasMany('App\Feedback', 'user', 'id');
    }

    public function guides()
    {
        return $this->hasMany('App\Guide', 'publisher', 'id');
    }

    public function hasRole($role)
    {
        return (in_array($role, json_decode($this->usergroups->pluck('groupInfo')->pluck('name'), TRUE)));
    }

    public function hasPermission($role)
    {
        return (in_array($role, json_decode($this->usergroups->pluck('groupInfo')->pluck('permissions')->pluck('name'), TRUE)));
    }
}
