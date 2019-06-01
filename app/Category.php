<?php
/**
 * Created by PhpStorm.
 * User: Adam
 * Date: 04/05/2019
 * Time: 13:04
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    protected $fillable = ['name', 'parent'];

    public function parentInfo()
    {
        return $this->hasOne('App\Category', 'id', 'parent');
    }

    public function children()
    {
        return $this->hasMany('App\Category', 'parent', 'id');
    }

    public function guides()
    {
        return $this->hasMany('App\Guide', 'category', 'id');
    }
}