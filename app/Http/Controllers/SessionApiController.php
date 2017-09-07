<?php

namespace App\Http\Controllers;

use App\Session;
use JWTAuth;
use Illuminate\Http\Request;
use DB;

class SessionApiController extends Controller
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
            return Session::all();
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
                    'lesson_id' => $request->lesson_id,
                    'title' => $request->title,
                    'slug' => $request->slug,
                    'content' => $request->content,
                    'video' => $request->video,
                    'completed' => $request->completed,
                ],
                
                [
                    'lesson_id' => 'required|integer',
                    'title' => 'sometimes|string|max:255',
                    'slug' => 'sometimes|string|max:255',
                    'content' => 'sometimes|string|max:255',
                    'video' => 'sometimes|string|max:255',
                    'completed' => 'required|boolean'
                ]
        );
        
        $user = JWTAuth::toUser($request->token);
        if ($user->hasRole('admin')) {
            if ($validator->fails()) {
                $result = ['result' => 'Failed',
                    'message' => $validator->errors()];
                return \Response::json($result)->setStatusCode(400, 'Fail');
            } else {
                $session = new Session();
                $session->lesson_id = $request->lesson_id;
                $session->title = $request->title;
                $session->slug = $request->slug;
                $session->content = $request->content;
                $session->video = $request->video;
                $session->save();
                
                if ($request->completed == 1) {
                    $session->users()->attach($user->id);
                } else {
                    DB::table('session_user')->where('session_id', $session->id)->delete();
                }

                return response()->json($session, 201);
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
    public function show(Request $request, Session $session)
    {
        $user = JWTAuth::toUser($request->token);
        if($user->hasRole('admin')){
            return $session;
        } else {
            return response()->json(['result' => abort(403, 'Unauthorized action.')]);
        }
    }
    
    public function view(Request $request, Session $session)
    {
        $user = JWTAuth::toUser($request->token);
        if($user->hasRole('subscriber')){
            if ($request->completed == 1) {
                $session->users()->attach($user->id);
            } else {
                DB::table('session_user')->where('session_id', $session->id)->delete();
            }
            
            if (isset($request->completed) ) {
                    $session->completed = $request->completed;
            }

            return response()->json($session, 200);
            
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
    public function update(Request $request, Session $session)
    {
       $user = JWTAuth::toUser($request->token);
        if($user->hasRole('admin')){
            if ($request->completed == 1) {
                $session->users()->attach($user->id);
            } else {
                DB::table('session_user')->where('session_id', $session->id)->delete();
            }
            
            $except_request = array_except($request->all(), ['completed']);
            $session->update($except_request);
            return response()->json($session, 200);
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
    public function destroy(Request $request, Session $session)
    {
        $user = JWTAuth::toUser($request->token);
        if ($user->hasRole('admin')) {
            $session->delete();
            return response()->json(null, 204);
        } else {
            return response()->json(['result' => abort(403, 'Unauthorized action.')]);
        }
    }
}
