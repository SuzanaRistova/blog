<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = [
       'module_id', 'title', 'slug', 'content',
    ];
    
    public function sessions()
    {
        return $this->hasMany('App\Session');
    }
    
//    public function module()
//    {
//        return $this->belongsTo('App\Module');
//    }

}
