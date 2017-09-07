<?php

namespace App\Http\Controllers;

use App\Module;
use JWTAuth;
use Illuminate\Http\Request;

class ModuleApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = JWTAuth::toUser($request->token);
        if ($user->hasRole('admin') || $user->hasRole('subscriber')) {
            return Module::all();
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
                'title' => $request->title,
                'slug' => $request->slug,
                'content' => $request->content
            ],
                
            [
                'title' => 'sometimes|string|max:255',
                'slug' => 'sometimes|string|max:255',
                'content' => 'sometimes|string|max:255',
            ]
        );
        
        $user = JWTAuth::toUser($request->token);
        if ($user->hasRole('admin')) {
            if ($validator->fails()){
                $result = ['result' => 'Failed',
                'message' => $validator->errors()];
                return \Response::json($result)->setStatusCode(400, 'Fail');
            } else {
                $module = new Module();
                $module->title = $request->title;
                $module->slug = $request->slug;
                $module->content = $request->content;
                $module->user_id = $user->id;
                $module->save();
                return response()->json($module, 201);
            }
        } else {
            return response()->json(['result' => abort(403, 'Unauthorized action.')]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Module $module)
    {
        $user = JWTAuth::toUser($request->token);
        if($user->hasRole('admin') || $user->hasRole('subscriber')){
            return $module;
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
    public function update(Request $request, Module $module)
    {
        $user = JWTAuth::toUser($request->token);
        if($user->hasRole('admin')){
            $module->update($request->all());
            return response()->json($module, 200);
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
    public function destroy(Request $request, Module $module)
    {
        $user = JWTAuth::toUser($request->token);
        if ($user->hasRole('admin')) {
            $module->delete();
            return response()->json(null, 204);
        } else {
            return response()->json(['result' => abort(403, 'Unauthorized action.')]);
        }
    }
}
