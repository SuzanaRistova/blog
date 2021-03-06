<?php

namespace App;
use DB;

use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Laravel\Scout\Searchable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'confirmation_code', 'confirmed'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
      public function searchableAs()
    {

        return 'users_index';

    }
    
    public static function  lists(){
        $users = DB::table('users')->select('id')->get();
        return $users;
    }

        public function searches(Request $request)
    {
        $error = ['error' => 'No results found, please try with different keywords.'];

        if($request->has('q')) {

            $users = User::search($request->get('q'))->get();

            return $users->count() ? $users : $error;

        }

        // Return the error message if no keywords existed
        return $error;
    }
    
    public function roles()
    {
        return $this->belongsToMany('App\Role')->withTimestamps();
    } 

    public function sessions()
    {
        return $this->belongsToMany('App\Session')->withTimestamps();
    } 
    
    public function isAdmin() {
        if ($this->roles()->where('role_id', 1)->first()) {
            return true;
        } else {
            return false;
        }
    }
     
    public function isSubscriber() {
        if ($this->roles()->where('role_id', 2)->first()) {
            return true;
        } else {
            return false;
        }
    }

    public function pages()
    {
        return $this->hasMany('App\Page');
    }
    
    public function modules()
    {
        return $this->hasMany('App\Module');
    }
    
    public function authorizeRoles($roles)
    {
        if ($this->hasAnyRole($roles)) {
            return true;
        }
        
        abort(401, 'This action is unauthorized.');
    }
    
    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
              if ($this->hasRole($role)) {
                return true;
              }
            }
        } else {
            if ($this->hasRole($roles)) {
              return true;
            }
        }
        
      return false;
    }
    
    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
            return false;
    }

}
