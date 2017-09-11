<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Hash;
use JWTAuth;
use Illuminate\Support\Facades\Auth;

class APIController extends Controller
{
    public $successStatus = 200;
    
   public function register(Request $request)
    {   
        $validator = \Validator::make($request->all(), [
                'name' => 'sometimes|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
                'password_confirmation' =>  'required|same:password'
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;
        
        $user->roles()->attach(Role::where('name', 'subscriber')->first());

        // create oauth client
        $oauth_client = \App\OauthClient::create([
                    'user_id' => $user->id,
                    'id' => $user->email,
                    'name' => $user->name,
                    'secret' => base64_encode(hash_hmac('sha256', $user->password, 'secret', true)),
                    'password_client' => 1,
                    'personal_access_client' => 0,
                    'redirect' => '',
                    'revoked' => 0,
        ]);

        return response()->json(['success'=>$success], $this->successStatus);

    }
    
     public function login(){
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            return response()->json(['success' => $success], $this->successStatus);
        }
        else{
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }
    
//    public function login(Request $request)
//    {
//    	$input = $request->all();
//    	if (!$token = JWTAuth::attempt($input)) {
//            return response()->json(['result' => 'wrong email or password.']);
//        }
//            return response()->json(['result' => $token]);
//    }
    
    public function get_user_details(Request $request)
    {
    	$input = $request->all();
    	$user = JWTAuth::toUser($input['token']);
        return response()->json(['result' => $user]);
    }
    
     public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus);
    }
}
