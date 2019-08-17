<?php
/**
 * Created by PhpStorm.
 * User: Adam
 * Date: 04/05/2019
 * Time: 13:05
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Steps extends Model
{
    protected $table = 'steps';
    protected $fillable = ['stepNumber', 'stepContent', 'guide'];

    public function guideInfo()
    {
        return $this->hasOne('App\Guide', 'id', 'guide');
    }

    public function supplementaryContent()
    {
        return $this->hasMany('App\SupplementaryContent', 'step', 'id');
    }
}