<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use JWTAuth;

class PageApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       $user = JWTAuth::toUser($request->token);
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
        $user = JWTAuth::toUser($request->token);
        if(!$user->hasRole('subscriber')){
            $page = new Page();
            $page->title = $request->title;
            $page->slug = $request->slug;
            $page->content = $request->content;
            $page->user_id = $user->id;
            $page->save();
            return response()->json($page, 201);
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
    public function show(Request $request, Page $page)
    {
        $user = JWTAuth::toUser($request->token);
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
        $page->update($request->all());

        return response()->json($page, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        $page->delete();

        return response()->json(null, 204);
    }
}
