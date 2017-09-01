<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SessionUser extends Model
{
     public $table = "session_user";


     protected $fillable = [
       'session_id', 'user_id',
    ];
}
