<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller {

    /**
     * Instantiate a new UserController instance.
     */
    public function __construct() {
        $this->middleware('auth');
    }

    protected function rules() {
        $user_id = Auth::id();

        $rules = [
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|string|email|max:255|unique:users,email,' . $user_id,
            'role' => 'sometimes|string|max:255',
        ];

        return $rules;
    }

    public function index() {
        $users = User::get();
        $user = Auth::user();
        if($user->hasRole('admin')){
            $admin_role = true;
        } else {
             $admin_role = false;
        }
        return view('user.index', compact('users', 'admin_role'));
    }

    public function show(User $user) {
        $role = $user->roles->first();
        return view('user.show', compact('user', 'role'));
    }

    public function create() {
        $roles = Role::get();
        return view('user.create', compact('roles'));
    }

    public function store(Request $request) {
        $validator = $this->validate($request, $this->rules());
        
        $roles = $request->role;
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = "da";
        $user->save();
        $user->roles()->attach($roles);
        return \Redirect::route('user.show', array($user->id));
    }

    public function edit(User $user) {
        $roles = Role::get();
        return view('user.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user) {
        
        $validator = $this->validate($request, $this->rules());
        
        $user_id = Auth::id();
        $roles = $request->role;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = "da";
        $user->remember_token = NULL;
        $user->roles()->attach($roles);
        $user->update();

        return view('user.show', compact('user'));
    }

    public function destroy(User $user) {
        $user->delete();
        return back();
    }

}
