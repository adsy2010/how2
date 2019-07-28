<?php
/**
 * Created by PhpStorm.
 * User: Adam
 * Date: 28/07/2019
 * Time: 21:46
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = 'log';

    protected $fillable = ['user', 'action'];

    public function userInfo()
    {
        return $this->hasOne('App\User', 'id', 'user');
    }
}