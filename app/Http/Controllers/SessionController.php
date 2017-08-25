<?php

namespace App\Http\Controllers;

use App\Session;
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
        $sessions = Session::get();
        if ($user->hasRole('admin') || $user->hasRole('editor')) {
            $admin_role = true;  
            $sessions = Session::get();
        } else {
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
        $session = new Session();
        $session->lesson_id = $request->lesson_id;
        $session->title = $request->title;
        $session->slug = $request->slug;
        $session->content = $request->content;
        $session->video = $request->video;
        $session->completed = $request->completed;
        $session->save();
        
        return \Redirect::route('session.show', array($session->id))->with('message', 'New Session created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function show(Session $session)
    {
        return view('session.show', compact('session'));
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
        
        if($request->completed == NULL){
            $request->completed = 0;
        }
        
        $session->lesson_id = $request->lesson_id;
        $session->title = $request->title;
        $session->slug = $request->slug;
        $session->content = $request->content;
        $session->video = $request->video;
        $session->completed = $request->completed;
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
