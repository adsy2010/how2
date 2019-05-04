<?php
/**
 * Created by PhpStorm.
 * User: Adam
 * Date: 04/05/2019
 * Time: 13:05
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class SupplementaryContent extends Model
{
    protected $table = 'supplementarycontent';
    protected $fillable = ['step', 'contentLocation', 'dataType'];

    public function step()
    {
        return $this->hasOne('App\Steps', 'id', 'step');
    }
}