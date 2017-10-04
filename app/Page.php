<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'user_id','title', 'slug', 'content', 'image', 'map', 'lat', 'lng'
    ];
      
//    public function user()
//    {
//        return $this->belongsTo('App\User');
//    } 
}
