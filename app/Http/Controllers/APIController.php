<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Hash;
use DB;
use JWTAuth;
use Illuminate\Support\Facades\Auth;

class APIController extends Controller
{
    public $successStatus = 200;
    
   public function register(Request $request)
    {   
        $request->headers->set('Header-app-token', 'header token');
        $request = \Route::getCurrentRequest();
        $all_headers = $request->header();
        $specific_header = $request->header("Header-app-token");
        
        if ($specific_header == "header token") {
            
            $validator = \Validator::make($request->all(), [
                        'name' => 'required|sometimes|string|max:255',
                        'email' => 'required|string|email|max:255|unique:users',
                        'password' => 'required|string|min:6|confirmed',
                        'password_confirmation' => 'required|same:password'
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 401);
            }

            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
            $user = User::create($input);
//            $success['token'] = $user->createToken('MyApp')->accessToken;
//            $success['name'] = $user->name;

            $user->roles()->attach(Role::where('name', 'subscriber')->first());

            // create oauth client
//            $oauth_client = \App\OauthClient::create([
//                        'user_id' => $user->id,
//                        'id' => $user->email,
//                        'name' => $user->name,
//                        'secret' => base64_encode(hash_hmac('sha256', $user->password, 'secret', true)),
//                        'password_client' => 1,
//                        'personal_access_client' => 0,
//                        'redirect' => '',
//                        'revoked' => 0,
//            ]);
            
            return response()->json(['user' => $user], $this->successStatus);
            
        } else {
            
            return response()->json(['error' => 'Unauthorised, header is not equal'], 401);
        }
    }
    
    public function login(){
        
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            
            $user = Auth::user();
            if($user->hasRole('admin')){
                $success['token'] =  $user->createToken('Admin Token', ['read', 'delete', 'create', 'update'])->accessToken; 
            } else if($user->hasRole('editor')){
                $success['token'] =  $user->createToken('Editor Token', ['user-create', 'user-read'])->accessToken;
            } else if($user->hasRole('author')){
                $success['token'] =  $user->createToken('Author Token', ['create', 'read'])->accessToken;
            } else {
                $success['token'] =  $user->createToken('Subscriber Token', ['module-read', 'session-view-edit', 'lesson-show'])->accessToken;
            }

            
//            $oauth_client = \App\OauthClient::create([
//                        'user_id' => $user->id,
//                        'id' => $user->email,
//                        'name' => $user->name,
//                        'secret' => base64_encode(hash_hmac('sha256', $user->password, 'secret', true)),
//                        'password_client' => 1,
//                        'personal_access_client' => 0,
//                        'redirect' => '',
//                        'revoked' => 0,
//            ]);
            
            return response()->json(['success' => $success], $this->successStatus);
        }
        
        else {
            
            return response()->json(['error'=>'Not valid email or password'], 401);
        }
    }
    
    protected function guard()
    {
        return Auth::guard('api');
    }
    
    public function logout(Request $request)
    {
        $user = Auth::guard('api')->user();
        $token_id = $user->token()->id;

        if ($user) {
            
            $token = DB::table('oauth_access_tokens')
                    ->where('id', '=', $token_id)
                    ->update(['revoked' => true]);
        }

        $json = [
            'success' => true,
            'code' => 200,
            'message' => 'You are Logged out.',
        ];
        return response()->json($json, '200');
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
