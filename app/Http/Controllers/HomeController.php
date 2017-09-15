<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $user = Auth::user();
        return view('home', compact('user'));
    }
    
    public function mail() {
        $user = User::find(1)->toArray();

        \Mail::send('emails.email', $user, function($message) use ($user) {
            $message->to("suzanaristova@yahoo.com");
            $message->subject('Blog');
        });

        dd('Mail Send Successfully');
    }

}
