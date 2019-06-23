<?php
/**
 * Created by PhpStorm.
 * User: Adam
 * Date: 04/05/2019
 * Time: 13:05
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    protected $table = 'approvals';
    protected $fillable = ['user', 'guide'];

    public function userInfo()
    {
        return $this->hasOne('App\User', 'id', 'user');
    }

    public function guideInfo()
    {
        return $this->hasOne('App\Guide', 'id', 'guide');
    }
}