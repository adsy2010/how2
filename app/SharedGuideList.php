<?php
/**
 * Created by PhpStorm.
 * User: Adam
 * Date: 21/07/2019
 * Time: 14:26
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class SharedGuideList extends Model
{
    protected $table = 'guidelist_shared';

    public function guidelistInfo()
    {
        return $this->hasMany('App\GuideList', 'id', 'guidelist');
    }

    public function userInfo()
    {
        return $this->hasMany('App\User', 'id', 'user');
    }
}