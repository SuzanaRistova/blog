<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
      protected $fillable = [
        'name', 'slug', 'content',
    ];
      
    public function users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    } 
}
