<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = [
       'module_id', 'title', 'slug', 'content',
    ];
    
    public function module()
    {
        return $this->belongsTo('App\Module');
    }

}
