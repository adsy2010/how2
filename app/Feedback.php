<?php
/**
 * Created by PhpStorm.
 * User: Adam
 * Date: 04/05/2019
 * Time: 13:06
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedback';
    protected $fillable = ['user', 'guide', 'comment'];

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user');
    }

    public function guide()
    {
        return $this->hasOne('App\Guide', 'id', 'guide');
    }
}