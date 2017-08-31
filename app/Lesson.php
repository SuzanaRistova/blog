<?php

namespace App;

use DB;
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
        $user = Auth::user();
        $lesson_id = $this->id;
        
        $sessions_completed = DB::table('sessions')
            ->join('session_user', 'sessions.id', '=', 'session_user.session_id')
            ->where('user_id', $user->id)  
            ->where('lesson_id', $lesson_id)
            ->select('sessions.*')
            ->count();
        
        $all_sessions = $this->sessions()->count();
        $completed = false;
        
        if($sessions_completed == $all_sessions){
                $completed = true;
        } else {
                $completed = false;
        }
        
       return $completed;
        //Site sessi za ovoj lesson/user_id/Sessions
        //Dali site ovie sessii se vo session_user. Ako se tamu site, togas e lessono completed.

    }


//    public function module()
//    {
//        return $this->belongsTo('App\Module');
//    }

}
