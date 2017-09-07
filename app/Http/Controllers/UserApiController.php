<?php

namespace App\Http\Controllers;

use DB;
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
    public function index()
    {
        return User::all();
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
        $user = User::create($request->all());
        $user->roles()->attach($request->role_id);
        return response()->json($user, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return $user;
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
        $user->update($request->all());

        return response()->json($user, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        DB::table('role_user')->where('user_id', $user->id)->delete();
        $user->delete();

        return response()->json(null, 204);
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
