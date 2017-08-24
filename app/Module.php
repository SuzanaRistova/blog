<?php

namespace App;
use App\Lesson;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $fillable = [
        'title', 'slug', 'content',
    ];
    
    public function lessons()
    {
        return $this->hasMany('App\Lesson');
    }
}
