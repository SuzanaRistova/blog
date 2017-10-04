<?php

namespace App\Http\Controllers;

use App\Page;
use Image;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function __construct() {
        
        $this->middleware('auth',  ['except' => ['show', 'index']]);
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
//        $pages = Page::where('user_id', $user->id)->get();
//        if ($user->hasRole('admin') || $user->hasRole('editor')) {
//            $admin_role = true;  
//            $pages = Page::get();
//        } else {
//            $admin_role = false;  
//        }
        
        $pages = DB::table('pages')->get();
        $lat = DB::table('pages')->select('lat')->get();

        if ($user != NULL) {
            $admin_role = true;
        } else {
            $admin_role = false;
        }
        $pages_paginate =  Page::paginate(4);

        return view('page.index', compact('pages', 'admin_role', 'pages_paginate', 'lat'));
    }

    public function pages(Request $request)
    {
        $user_id = $request->user_id;
        $validator = \Validator::make(\Illuminate\Support\Facades\Input::all(), [
                    'user_id' => 'required|integer',
        ]);
        
        $pages = Page::where('user_id', $user_id)->get();
        
        return \Response::json([
                'errors' => $validator->errors(),
                'pages' => $pages
            ], 201); 
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('page.create');
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
        $page = new Page();
        $page->user_id = $user_id;
        $page->title = $request->title;
        $page->slug = $request->slug;
        $page->content = $request->content;
        
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . "." . $image->getClientOriginalExtension();
            Image::make($image)->save(public_path('/uploads/pages/large/' . $filename));
            Image::make($image)->resize(32, 32)->save(public_path('/uploads/pages/small/' . $filename));
            $page->image = $filename;
        }
        
        $page->save();

        
        return \Redirect::route('page.show', array("slug" => $request->slug))->with('message', 'New Page created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page, $slug)
    {
//        $user_id = Auth::user()->id;
//        $user =  Auth::user();
        $page = Page::where('slug', $slug)->first();
//
//        if (($user->hasRole('author')) && ($page->user_id != $user_id)) {
//            abort(403, 'Unauthorized action.');
//        }

        return view('page.show', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        $user_id = Auth::user()->id;
        $user =  Auth::user();
        
        if ( ($user->id == 3 ) && ($page->user_id != $user_id) ) {
            abort(403, 'Unauthorized action.');
        }
        return view('page.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        $validator = $this->validate($request, $this->rules());
        $user_id = Auth::user()->id;
        $page->user_id = $user_id;
        $page->title = $request->title;
        $page->slug = $request->slug;
        $page->content = $request->content;
        
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . "." . $image->getClientOriginalExtension();
            Image::make($image)->save(public_path('/uploads/pages/large/' . $filename));
            Image::make($image)->resize(32, 32)->save(public_path('/uploads/pages/small/' . $filename));
            $page->image = $filename;
        }    
        
        $page->update();
        
        return view('page.show', compact('page'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        $user_id = Auth::user()->id;
        $user =  Auth::user();
        
        if (($user->id == 3 ) && ($page->user_id != $user_id)) {
            abort(403, 'Unauthorized action.');
        } else {
            $page->delete();
            return back();
        }
    }
    
     public function save(Request $request){
        $rules = array('title' => 'required', 'slug' => 'required');
        $validator = \Validator::make($request->all(), $this->rules());
        if ($validator->fails()) {

            return response()->json(['errors' => $validator->errors()]);
        } else {
            $pages = Page::get();
            $user_id = Auth::user()->id;
            $page = Page::find($request->id);
            $page->user_id = $user_id;
            $page->title = $request->title;
            $page->slug = $request->slug;
            $page->content = $request->content;
            $page->image = "1506326573.jpg";
            $page->update();
            
            return response()->json(['success' => $page]);
        }
    }
    
    
    public function addPage(Request $request) {
        
    $rules = array (
           'title' => 'sometimes|string|max:255',
            'slug' => 'sometimes|string|max:255',
            'content' => 'sometimes|string|max:255',
    );
    $validator = Validator::make(\Input::all(), $rules);
        if ($validator->fails()) {

            return \Response::json(array(
                        'errors' => $validator->getMessageBag()->toArray()
            ));
        } else {

            $page = new Page();
            $page->title = $request->title;
            $page->slug = $request->slug;
            $page->content = $request->content;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = time() . "." . $image->getClientOriginalExtension();
                Image::make($image)->save(public_path('/uploads/pages/large/' . $filename));
                Image::make($image)->resize(32, 32)->save(public_path('/uploads/pages/small/' . $filename));
                $page->image = $filename;
            }

            $page->save();

            return response()->json($page);
        }
    }
    
    public function addmapsave(Request $request)
    {
        $validator = $this->validate($request, $this->rules());
        $user_id = Auth::user()->id;
        $page = new Page();
        $page->user_id = $user_id;
        $page->title = $request->title;
        $page->slug = str_random(10);
        $page->content = "content";
        $page->image = NULL;
        $page->map = $request->map;
        $page->lat = $request->lat;
        $page->lng = $request->lng;
        
        $page->save();
        
       return view('page.show', compact('page'));
        
    }
    
    public function addmap(Request $request)
    {
        $user_id = $request->user_id;
        $validator = \Validator::make(\Illuminate\Support\Facades\Input::all(), [
                    'user_id' => 'required|integer',
        ]);
        
        $pages = Page::where('user_id', $user_id)->get();
        
        return view('page.addmap', compact('page'));
        
    }

}
