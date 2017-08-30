<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Lesson extends Model
{
    protected $fillable = [
       'module_id', 'title', 'slug', 'content',
    ];
    
    public function sessions()
    {
        return $this->hasMany('App\Session');
    }
    
    public function isCompleted()
    {
        $user_id = Auth::user()->id;
        $lesson_id = $this->id;
        $sessions = Session::where('lesson_id',$lesson_id)->get();
        dd($sessions);
        //Site sessi za ovoj lesson/user_id/Sessions
        //Dali site ovie sessii se vo session_user. Ako se tamu site, togas e lessono completed.
        
        
        var_dump($this->id);
        exit();
    }


//    public function module()
//    {
//        return $this->belongsTo('App\Module');
//    }

}
