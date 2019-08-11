<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class SearchCache extends Model
{
    protected $table = 'searchcache';

    protected $fillable = ['termId','guideId','rank'];

    public function guide()
    {
        return $this->hasOne('App\Guide', 'id', 'guideId');
    }

    public function term()
    {
        return $this->hasOne('App\SearchTerm', 'id', 'termId');
    }
}
