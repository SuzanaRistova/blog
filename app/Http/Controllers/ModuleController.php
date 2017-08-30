<?php

namespace App\Http\Controllers;

use App\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModuleController extends Controller
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
        $modules = Module::where('user_id', $user->id)->get();
        if ($user->hasRole('admin') || $user->hasRole('subscriber')) { 
            $modules = Module::get();
        } 
        
        return view('module.index', compact('modules', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {  
        return view('module.create');
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
        $module = new Module();
        $module->user_id = $user_id;
        $module->title = $request->title;
        $module->slug = $request->slug;
        $module->content = $request->content;
        $module->save();
        
        return \Redirect::route('module.show', array("slug" => $request->slug))->with('message', 'New Module created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function show(Module $module, $slug)
    {
        $user = Auth::user();
        $lessons = $module->lessons()->get();
        if($lessons == NULL){
            $lessons = "";
        }
         
        $module = Module::where('slug', $slug)->first();
        
        return view('module.show', compact('module', 'lessons', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function edit(Module $module)
    {
         return view('module.edit', compact('module'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Module $module)
    {
        $user = Auth::user();
        $validator = $this->validate($request, $this->rules());
        
        $user_id = Auth::user()->id;
        $module->user_id = $user_id;
        $module->title = $request->title;
        $module->slug = $request->slug;
        $module->content = $request->content;
        $module->update();
        
        $lessons = $module->lessons()->get();
        if($lessons == NULL){
            $lessons = "";
        }
        
        return view('module.show', compact('module','lessons','user'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function destroy(Module $module)
    {
        $module->delete();
        return back();
    }
}
