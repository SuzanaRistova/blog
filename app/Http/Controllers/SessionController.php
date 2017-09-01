<?php

namespace App\Http\Controllers;

use DB;
use App\Session;
use App\SessionUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    public function __construct() {
        
        $this->middleware('auth');
    }
    
    protected function rules() {
        
        $rules = [
            'title' => 'sometimes|string|max:255',
            'slug' => 'sometimes|string|max:255',
            'content' => 'sometimes|string|max:255',
            'video' => 'sometimes|string|max:255',
        ];

        return $rules;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $user_id = $user->id;
        if ($user->hasRole('admin')) {
            $admin_role = true;  
            $sessions = Session::get();
        } else {
            $sessions = $user->sessions()->get();
            $admin_role = false;  
        }
        
        
        return view('session.index', compact('sessions', 'admin_role'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($lesson_id)
    {
        return view('session.create', array('lesson_id' => $lesson_id));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->validate($request, $this->rules());
        $user_id = Auth::user()->id;
        
        if($request->completed == NULL){
            $request->completed = 0;
        }
        
        $url = $request->video;
        
        if (preg_match('/youtube\.com\/watch\?v=([^\&\?\/]+)/', $url, $id)) {
            $values = $id[1];
        } else if (preg_match('/youtube\.com\/embed\/([^\&\?\/]+)/', $url, $id)) {
            $values = $id[1];
        } else if (preg_match('/youtube\.com\/v\/([^\&\?\/]+)/', $url, $id)) {
            $values = $id[1];
        } else if (preg_match('/youtu\.be\/([^\&\?\/]+)/', $url, $id)) {
            $values = $id[1];
        } else if (preg_match('/youtube\.com\/verify_age\?next_url=\/watch%3Fv%3D([^\&\?\/]+)/', $url, $id)) {
            $values = $id[1];
        } else {
            // not an youtube video
        }

        $session = new Session();
        $session->lesson_id = $request->lesson_id;
        $session->title = $request->title;
        $session->slug = $request->slug;
        $session->content = $request->content;
        $session->video = $values;
        $session->save();
        
        if($request->completed == 1){
            $session->users()->attach($user_id);
        } else {
            DB::table('session_user')->where('session_id', $session->id)->delete();
        }
        
        return \Redirect::route('session.show', array($session->slug))->with('message', 'New Session created!');
    }
    
     public function save(Request $request)
    {
        $session = Session::where('id', $request->session_id )->first();
        $session->completed = $request->completed;
        $user_id = Auth::user()->id;
        
        if($request->completed == 1){
            $session->users()->attach($user_id);
        } else {
            DB::table('session_user')->where('session_id', $session->id)->delete();
        }
        
        $session->update();
            
        $response = array(
            'status' => 'updated',
            'msg' => 'Session successfully updated',
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function show(Session $session, $slug)
    {
        $session = Session::where('slug', $slug)->first();
        return view('session.show', compact('session'));
    }
    
    public function view(Session $session, $slug)
    {
        $user = Auth::user();
        $session = Session::where('slug', $slug)->first();
        $completed_session = \App\SessionUser::where('session_id', $session->id)->where('user_id', $user->id)->first();
        $completed = false;
        if($completed_session != NULL){
            $completed = true;
        }
        
        return view('session.view', compact('session', 'completed'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function edit(Session $session)
    {
        return view('session.edit', compact('session'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Session $session)
    {
        $validator = $this->validate($request, $this->rules());
        $user_id = Auth::user()->id;
        
        if($request->completed == NULL){
            $request->completed = 0;
        }
        
        if($request->completed == 1){
            $session->users()->attach($user_id);
        } else {
            DB::table('session_user')->where('session_id', $session->id)->delete();
        }
        
        $url = $request->video;
        
        if (preg_match('/youtube\.com\/watch\?v=([^\&\?\/]+)/', $url, $id)) {
            $values = $id[1];
        } else if (preg_match('/youtube\.com\/embed\/([^\&\?\/]+)/', $url, $id)) {
            $values = $id[1];
        } else if (preg_match('/youtube\.com\/v\/([^\&\?\/]+)/', $url, $id)) {
            $values = $id[1];
        } else if (preg_match('/youtu\.be\/([^\&\?\/]+)/', $url, $id)) {
            $values = $id[1];
        } else if (preg_match('/youtube\.com\/verify_age\?next_url=\/watch%3Fv%3D([^\&\?\/]+)/', $url, $id)) {
            $values = $id[1];
        } else {
            // not an youtube video
            $values = $request->video;
        }
        
        
        $session->lesson_id = $request->lesson_id;
        $session->title = $request->title;
        $session->slug = $request->slug;
        $session->content = $request->content;
        $session->video = $values;
        $session->update();
        
        return view('session.show', compact('session'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function destroy(Session $session)
    {
        $session->delete();
        return back();
    }
}
