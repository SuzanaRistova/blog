<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OauthClient extends Model
{
    public $table = "oauth_clients";
     
    protected $fillable = [
        'user_id','name', 'secret', 'redirect', 'password_client', 'personal_access_client', 'revoked'
    ];
}
