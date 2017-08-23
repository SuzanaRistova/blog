<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Role;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    /**
     * Redirect the user to the Facebook authentication page.
     *
     * @return Response
     */
    public function redirectToFacebookProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from Facebook.
     *
     * @return Response
     */
    public function handleProviderFacebookCallback()
    {
        $userSocial = Socialite::driver('facebook')->user();
        $findUser = User::where("email", $userSocial->email)->first();
        if($findUser){
            Auth::login($findUser);
            return "done old";
        } else {
            $user = new \App\User;
            $user->name = $userSocial->name;
            $user->email = $userSocial->email;
            $user->password = bcrypt("user");
            $user->save();
            Auth::login($user);
            $user->roles()->attach(Role::where('name', 'author')->first());
            return "done new";
        }
    }
    
     /**
     * Redirect the user to the Twitter authentication page.
     *
     * @return Response
     */
    public function redirectToTwitterProvider()
    {
        return Socialite::driver('twitter')->redirect();
    }

    /**
     * Obtain the user information from Twitter.
     *
     * @return Response
     */
    public function handleProviderTwitterCallback()
    {
        $userSocial = Socialite::driver('twitter')->user();
        $findUser = User::where("email", $userSocial->email)->first();
        if($findUser){
            Auth::login($findUser);
            return "done old";
        } else {
            $user = new \App\User;
            $user->name = $userSocial->name;
            $user->email = $userSocial->email;
            $user->password = bcrypt("user");
            $user->save();
            Auth::login($user);
            $user->roles()->attach(Role::where('name', 'author')->first());
            return "done new";
        }
    }
    
     /**
     * Redirect the user to the Google authentication page.
     *
     * @return Response
     */
    public function redirectToGoogleProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return Response
     */
    public function handleProviderGoogleCallback()
    {
        $userSocial = Socialite::driver('google')->user();
        $findUser = User::where("email", $userSocial->email)->first();
        if($findUser){
            Auth::login($findUser);
            return "done old";
        } else {
            $user = new \App\User;
            $user->name = $userSocial->name;
            $user->email = $userSocial->email;
            $user->password = bcrypt("user");
            $user->save();
            Auth::login($user);
            $user->roles()->attach(Role::where('name', 'author')->first());
            return "done new";
        }
    }
}