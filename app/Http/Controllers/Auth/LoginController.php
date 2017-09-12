<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
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
    
//    protected function authenticateClient(Request $request) {
//
//        $credentials = $this->credentials($request);
//
//        $data = $request->all();
//
//        $user = User::where('email', $credentials['email'])->first();
//
//        $request->request->add([
//            'grant_type'    => $data['grant_type'],
//            'client_id'     => $data['client_id'],
//            'client_secret' => $data['client_secret'],
//            'username'      => $credentials['email'],
//            'password'      => $credentials['password'],
//            'scope'         => null,
//        ]);
//
//        $proxy = Request::create(
//            'oauth/token',
//            'POST'
//        );
//
//        return Route::dispatch($proxy);
//    }
//    
//    protected function authenticated(Request $request, $user) {
//
//        return $this->authenticateClient($request);
//    }
//
//    protected function sendLoginResponse(Request $request)
//    {
//        $request->session()->regenerate();
//
//        $this->clearLoginAttempts($request);
//
//        return $this->authenticated($request, $this->guard()->user());
//
//    }
//
//    public function login(Request $request)
//    {   
//        $credentials = $this->credentials($request);
//
//        if ($this->guard('api')->attempt($credentials, $request->has('remember'))) {
//
//            return $this->sendLoginResponse($request);
//        }
//    }

    
//    public function login(Request $request) {
//        $this->validateLogin($request);
//
//        if ($this->attemptLogin($request)) {
//            $user = $this->guard()->user();
//            $user->api_token = $user->generateToken();
//            $user->save();
//
//            return response()->json([
//                        'data' => $user->toArray(),
//            ]);
//        }
//
//        return $this->sendFailedLoginResponse($request);
//    }
//    
//    public function logout(Request $request) {
//        
//        $user = Auth::guard('api')->user();
//
//        if ($user) {
//            $user->api_token = null;
//            $user->save();
//        }
//
//        return response()->json(['data' => 'User logged out.'], 200);
//    }

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
            return \Redirect::route("home");
        } else {
            $user = new \App\User;
            $user->name = $userSocial->name;
            $user->email = $userSocial->email;
            $user->password = bcrypt("user");
            $user->save();
            Auth::login($user);
            $user->roles()->attach(Role::where('name', 'subscriber')->first());
            return \Redirect::route("home");
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
            return \Redirect::route("home");
        } else {
            $user = new \App\User;
            $user->name = $userSocial->name;
            $user->email = $userSocial->email;
            $user->password = bcrypt("user");
            $user->save();
            Auth::login($user);
            $user->roles()->attach(Role::where('name', 'subscriber')->first());
            return \Redirect::route("home");
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
            return \Redirect::route("home");
        } else {
            $user = new \App\User;
            $user->name = $userSocial->name;
            $user->email = $userSocial->email;
            $user->password = bcrypt("user");
            $user->save();
            Auth::login($user);
            $user->roles()->attach(Role::where('name', 'subscriber')->first());
            return \Redirect::route("home");
        }
    }
}
