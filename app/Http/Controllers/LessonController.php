<?php

namespace App\Http\Controllers;

use App\Lesson;
use App\Module;
use App\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LessonController extends Controller
{
    public function __construct() {
        
        $this->middleware('auth');
    }
    
    protected function rules() {
        
        $rules = [
            'title' => 'sometimes|string|max:255',
            'slug' => 'sometimes|string|max:255',
            'content' => 'sometimes|string|max:255',
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
//        $modules = \App\Module::where('user_id', $user->id)->get();
        $lessons = Lesson::get();
        if ($user->hasRole('admin') || $user->hasRole('editor')) {
            $admin_role = true;  
            $lessons = Lesson::get();
        } else {
            $admin_role = false;  
        }
        
        
        return view('lesson.index', compact('lessons', 'admin_role'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($module_id)
    {
         return view('lesson.create', array('module_id'=> $module_id));
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

        $lesson = new Lesson();
        $lesson->module_id = $request->module_id;
        $lesson->title = $request->title;
        $lesson->slug = $request->slug;
        $lesson->content = $request->content;
        $lesson->save();
        
        return \Redirect::route('lesson.show', array($lesson->id))->with('message', 'New Lesson created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function show(Lesson $lesson) {
        $user = Auth::user();
        $sessions = $lesson->sessions()->get();
        
        $sessions_this_user = $user->sessions()->count();
        $sessions_all = $lesson->sessions()->count();
        
        $completed = false;
        
        if($sessions_this_user == $sessions_all){
                $completed = true;
        } else {
                $completed = false;
        }
        
        return view('lesson.show', compact('lesson', 'sessions', 'completed', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function edit(Lesson $lesson)
    {
        return view('lesson.edit', compact('lesson'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lesson $lesson)
    {
        $validator = $this->validate($request, $this->rules());
          
        $lesson->module_id = $request->module_id;
        $lesson->title = $request->title;
        $lesson->slug = $request->slug;
        $lesson->content = $request->content;
        $lesson->update();
        
//        $sessions = $lesson->sessions()->get();
//        $sessions_completed = Session::where("completed", 0)->where("lesson_id", $lesson->id)->count();
//        $completed = false;
//        if ($sessions_completed == 0) {
//            $completed = true;
//        } else {
//            $completed = false;
//        }
        return view('lesson.show', compact('lesson', 'sessions', 'completed'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lesson $lesson)
    {
        $lesson->delete();
        return back();
    }
}
