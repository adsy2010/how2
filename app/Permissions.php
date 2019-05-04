<?php
/**
 * Created by PhpStorm.
 * User: Adam
 * Date: 04/05/2019
 * Time: 13:05
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Permissions extends Model
{

    protected $table = 'permissions';
    protected $fillable = ['groupID', 'permission'];

    public function usergroup()
    {
        return $this->hasOne('App\UserGroup', 'id', 'groupID');
    }

}