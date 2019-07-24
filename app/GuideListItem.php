<?php
/**
 * Created by PhpStorm.
 * User: Adam
 * Date: 21/07/2019
 * Time: 14:26
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class GuideListItem extends Model
{
    protected $table = 'guidelist_items';

    public function guidelistInfo()
    {
        return $this->hasMany('App\GuideList', 'id', 'guidelist');
    }

    public function guideInfo()
    {
        return $this->hasMany('App\Guide', 'id', 'guide');
    }
}