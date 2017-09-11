<?php

namespace App\Http\Controllers;

use App\Lesson;
use JWTAuth;
use DB;
use Illuminate\Http\Request;

class LessonApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = JWTAuth::toUser($request->token);
        if ($user->hasRole('admin')) {
            return Lesson::all();
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
    public function store(Request $request) {
        $validator = \Validator::make(
                [   
                    'module_id'=> $request->module_id,
                    'title' => $request->title,
                    'slug' => $request->slug,
                    'content' => $request->content ], 
                [
                    'module_id' => 'required|integer',
                    'title' => 'sometimes|string|max:255',
                    'slug' => 'sometimes|string|max:255',
                    'content' => 'sometimes|string|max:255',
                ]
        );
        $user = JWTAuth::toUser($request->token);
        
        if ($user->hasRole('admin')) {
            if ($validator->fails()) {
                $result = ['result' => 'Failed',
                    'message' => $validator->errors()];
                return \Response::json($result)->setStatusCode(400, 'Fail');
            } else {
                $lesson = new Lesson();
                $lesson->title = $request->title;
                $lesson->slug = $request->slug;
                $lesson->content = $request->content;
                $lesson->module_id = $request->module_id;
                $lesson->save();
                return response()->json($lesson, 201);
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
    public function show(Request $request, Lesson $lesson)
    {       
        $user = JWTAuth::toUser($request->token);
        $lesson_id = $lesson->id;
        $first_lesson = Lesson::first();
        
        $previous = Lesson::where('id', '<', $lesson->id)->orderBy('id','desc')->first();
        $previous_count = Lesson::where('id', '<', $lesson->id)->orderBy('id','desc')->count();
        
        if($previous_count == 0){
            $previous = $first_lesson;
        }

        $sessions_completed = DB::table('sessions')
                ->join('session_user', 'sessions.id', '=', 'session_user.session_id')
                ->where('user_id', $user->id)
                ->where('lesson_id', $previous->id)
                ->select('sessions.*')
                ->count();

        $all_sessions = $lesson->sessions()->count();

        $completed = false;
        if ($sessions_completed == $all_sessions) {
            $completed = true;
        } else {
            $completed = false;
        }

        if ($user->hasRole('admin')) {
            return $lesson;
        } else if ((($user->hasRole('subscriber')) && $completed) || (($user->hasRole('subscriber') && ($first_lesson->id == $lesson->id) ))) {
            return $lesson;
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
    public function update(Request $request, Lesson $lesson)
    {
        $user = JWTAuth::toUser($request->token);
        if($user->hasRole('admin')){
            $lesson->update($request->all());
            return response()->json($lesson, 200); }
        else{
            return response()->json(['result' => abort(403, 'Unauthorized action.')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Lesson $lesson) {
        
        $user = JWTAuth::toUser($request->token);
        if ($user->hasRole('admin')) {
            $lesson->delete();
            return response()->json(null, 204);
        } else {
            return response()->json(['result' => abort(403, 'Unauthorized action.')]);
        }
    }
    
    public function get_sessions(Request $request, Lesson $lesson)
    {
        $user = JWTAuth::toUser($request->token);
        if($user->hasRole('admin')){
            $lessons = $lesson->sessions;
            return response()->json($lessons, 200);
        } else {
            return response()->json(['result' => abort(403, 'Unauthorized action.')]);
        }
    }

}
