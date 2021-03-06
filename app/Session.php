<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $fillable = [
       'lesson_id', 'title', 'slug', 'content', 'video', 'completed',
    ];
    
    public function users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }
    
}
