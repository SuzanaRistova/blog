<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use JWTAuth;
use Illuminate\Support\Facades\Auth;

class PageApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $user = Auth::user();
       if($user->hasRole('admin') || $user->hasRole('editor')){
            return Page::all();
       } else if($user->hasRole('author')){
            $page = Page::where('user_id', $user->id)->get();
            return $page;
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
        
        $user = Auth::user();
        if(!$user->hasRole('subscriber')){
        if ($validator->fails()){
                $result = ['result' => 'Failed',
                'message' => $validator->errors()];
                return \Response::json($result)->setStatusCode(400, 'Fail');
        } else {
            $page = new Page();
            $page->title = $request->title;
            $page->slug = $request->slug;
            $page->content = $request->content;
            $page->user_id = $user->id;
            $page->save();
            return response()->json($page, 201);
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
    public function show(Page $page)
    {
        $user = Auth::user();
        if(!$user->hasRole('subscriber')){
            return $page;
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
    public function edit(Page $page)
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
    public function update(Request $request, Page $page)
    {
        $user = Auth::user();
        if($user->hasRole('admin') || ($user->hasRole('editor'))){
            $page->update($request->all());
            return response()->json($page, 200);
        } else if($user->hasRole('author')){
            $page_author = Page::where('user_id', $user->id)->where('id', $page->id)->first();
            return response()->json($page_author, 200);
        } else{
            return response()->json(['result' => abort(403, 'Unauthorized action.')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        $user = Auth::user();
        if($user->hasRole('admin') || ($user->hasRole('editor'))){
            $page->delete();
            return response()->json(null, 204);
        } else if($user->hasRole('author')){
            $page_author = Page::where('user_id', $user->id)->where('id', $page->id)->first();
            if($page_author != NULL){
                $page_author->delete();
                return response()->json(null, 204);
            } else {
                 return response()->json(['result' => abort(403, 'Unauthorized action.')]);
            }
        } else{
            return response()->json(['result' => abort(403, 'Unauthorized action.')]);
        }
       
    }
}
