<?php

namespace App\Http\Controllers;

use DB;
use Hash;
use App\User;
use JWTAuth;
use Illuminate\Http\Request;

class UserApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       $login_user = JWTAuth::toUser($request->token);
       if($login_user->hasRole('admin') || $user->hasRole('editor')){
            return User::all();
       } else {
            return response()->json(['result' => abort(403, 'Unauthorized action.')]);
       }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $validator = \Validator::make(
            [
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password
            ],
            [
                'name' => 'sometimes|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6',
                'role' => 'sometimes|string|max:255',
            ]
        );
         
        if($request->role_id == NULL){
            $request->role_id  = 4;
        }

        $user = JWTAuth::toUser($request->token);
        
        if ($user->hasRole('admin') || $user->hasRole('editor')) {
            
            if ($validator->fails()) {
                $result = ['result' => 'Failed', 'message' => $validator->errors()];
                return \Response::json($result)->setStatusCode(400, 'Fail');
            } else {
                $input = $request->all();
                $input['password'] = Hash::make($input['password']);
                $user = User::create($input);
                $user->roles()->attach($request->role_id);
                return response()->json($user, 201);
            }
        } else {
            
            return response()->json(['result' => abort(403, 'Unauthorized action.')]);
        }

        return response()->json($user, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, User $user)
    {
        $login_user = JWTAuth::toUser($request->token);
        if($login_user->hasRole('admin') || $login_user->hasRole('editor')){
            return $user;
        } else {
            return response()->json(['result' => abort(403, 'Unauthorized action.')]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user = JWTAuth::toUser($request->token);
        if ($user->hasRole('admin')) {
            $user->update($request->all());
            return response()->json($user, 200);
        } else {
            return response()->json(['result' => abort(403, 'Unauthorized action.')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, User $user)
    {
        $login_user = JWTAuth::toUser($request->token);
        if ($login_user->hasRole('admin')) {
            DB::table('role_user')->where('user_id', $user->id)->delete();
            $user->delete();
            return response()->json(null, 204);
        } else {
            return response()->json(['result' => abort(403, 'Unauthorized action.')]);
        }
    }
    
    public function get_pages(Request $request, User $user)
    {
        $user = JWTAuth::toUser($request->token);
        if(!$user->hasRole('subscriber')){
            $pages = $user->pages;
            return response()->json($pages, 200);
        } else {
            return response()->json(['result' => abort(403, 'Unauthorized action.')]);
        }
    }
    
    public function get_modules(Request $request, User $user)
    {
        $user = JWTAuth::toUser($request->token);
        if($user->hasRole('admin') || $user->hasRole('subscriber')){
            $modules = $user->modules;
            return response()->json($modules, 200);
        } else {
            return response()->json(['result' => abort(403, 'Unauthorized action.')]);
        }
    }
}
