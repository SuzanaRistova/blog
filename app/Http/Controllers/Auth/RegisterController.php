<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Input;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {   
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
        return $user;
    }
    
    protected function register(Request $request){
        
        $confirmation_code = str_random(30);
        $input = $request->all();
        $validator = $this->validator($input);
        if($validator->passes()){
            $data = $this->create($input)->toArray();
            $data['confirmation_code'] = $confirmation_code;
            $user = User::find($data['id']);
            $user->confirmation_code = $data['confirmation_code'];
            $user->save();
        
            \Mail::send('emails.verify', ['confirmation_code' => $confirmation_code], function($message) {
                $message->to(Input::get('email'), Input::get('name'))
                ->subject('Verify your email address');
            });  
            return redirect()->route('login')->with('status', 'Confirmation email has been send, please chack your email.');
        }
        
         return redirect()->route('login')->with('status', $validator->errors);
    }
   
     public function confirm($confirmation_code)
    {
        $user = User::where('confirmation_code', $confirmation_code)->first();

      if(!is_null($user)){
            $user->confirmed = 1;
            $user->confirmation_code = null;
            $user->save();
            $user->roles()->attach(Role::where('name', 'subscriber')->first());
            return redirect()->route('login')->with('status', 'You have successfully verified your accout');
      }
      return redirect()->route('login')->with('status', 'Something went wrong.');
    }
    
}
