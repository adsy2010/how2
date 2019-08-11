<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class SearchTerm extends Model
{
    protected $table = 'searchterm';

    protected $fillable = ['term', 'lastSearch'];

    public function cache()
    {
        return $this->hasMany('App\SearchCache', 'termId', 'id')->orderBy('rank', 'DESC');
    }
}
