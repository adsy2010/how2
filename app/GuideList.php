<?php
/**
 * Created by PhpStorm.
 * User: Adam
 * Date: 04/05/2019
 * Time: 13:05
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class GuideList extends Model
{
    protected $table = 'guidelist';
    protected $fillable = ['name', 'user'];

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user');
    }

    //TODO: Add another table and model to contain the guides within a list and their relative positions
}