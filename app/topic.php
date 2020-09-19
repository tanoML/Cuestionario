<?php

namespace App;

use App\Scopes\IdScope;
use Illuminate\Database\Eloquent\Model;

class topic extends Model
{
    //
    protected $table = 'topics';
    protected $fillable = ['slug','tema'];

    //this scope can get the id from the topic
    public function scopeIdFromtopic($query,$slug)
    {
        return $query->select('id')->where('slug',$slug);
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }

// protected static function boot()
// {
//     parent::boot();
//     static::addGlobalScope(new IdScope());
// }

}
