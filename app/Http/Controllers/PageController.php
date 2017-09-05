<?php

namespace App\Http\Controllers;

use App\Page;
use Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function __construct() {
        
        $this->middleware('auth',  ['except' => ['pages']]);
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
        $pages = Page::where('user_id', $user->id)->get();
        if ($user->hasRole('admin') || $user->hasRole('editor')) {
            $admin_role = true;  
            $pages = Page::get();
        } else {
            $admin_role = false;  
        }
        
        
        return view('page.index', compact('pages', 'admin_role'));
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
        $user_id = Auth::user()->id;
        $user =  Auth::user();
        $page = Page::where('slug', $slug)->first();

        if (($user->hasRole('author')) && ($page->user_id != $user_id)) {
            abort(403, 'Unauthorized action.');
        }

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
        $page->delete();
        return back();
    }
}
