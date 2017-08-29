<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Role
{


public function handle($request, Closure $next, ... $roles)
{
    if (!Auth::check()) 
        return redirect('login');

    $user = Auth::user();

    if($user->isAdmin())
        return $next($request);

    foreach($roles as $role) {
        if($user->hasRole($role)){
            return $next($request);
        } 
    }
      abort(403, 'Unauthorized action.');
//    return redirect('login');
    }
}