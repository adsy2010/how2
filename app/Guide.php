<?php
/**
 * Created by PhpStorm.
 * User: Adam
 * Date: 04/05/2019
 * Time: 13:04
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Guide extends Model
{
    protected $table = 'guide';
    protected $fillable = [
        'name',
        'publisher',
        'category',
        'draft',
        'published',
        'helpful',
        'unhelpful',
        'publishedTimestamp',
        'tags',
        'restrictedGroup
        '];

    public function publisher()
    {
        return $this->hasOne('App\User', 'id', 'publisher');
    }

    public function category()
    {
        return $this->hasOne('App\Category', 'id', 'category');
    }

    public function steps()
    {
        return $this->hasMany('App\Steps', 'guide', 'id');
    }

    public function restrictedGroup()
    {
        return $this->hasOne('App\UserGroup', 'id', 'restrictedGroup');
    }

    public function feedback()
    {
        return $this->hasMany('App\Feedback', 'guide', 'id');
    }

    public function guidelists()
    {
        return $this->hasMany('App\GuideList', 'guide', 'id');
    }
}