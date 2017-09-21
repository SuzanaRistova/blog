<?php
namespace App\Http\Controllers;

use DB;
use App\User;
use App\Role;
use Image;
use App\Page;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller {

    /**
     * Instantiate a new UserController instance.
    */
    public function __construct() {
        
        $this->middleware('auth', ['except' => ['signup', 'login']]);
    }

    protected function rules() {
        
        $rules = [
            'name' => 'sometimes|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'sometimes|string|max:255',
        ];

        return $rules;
    }

    public function index() {
        
        $users = User::get();
        $user = Auth::user();
        
        if ($user->hasRole('admin')) {
            $admin_role = true;  
        } else {
            $admin_role = false;  
        }
        return view('user.index', compact('users', 'admin_role'));
    }
    
    public function profile() {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }
    
    public function signup(Request $request) {

        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        $password_bcrypt = bcrypt($password);

        $validator = \Validator::make(
                
            [
                'name' => $name,
                'email' => $email,
                'password' => $password
            ],
                
            [
                'name' => 'sometimes|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6',
            ]
        );
        
        if ($validator->fails()){

            $result = ['result' => 'Failed',
                       'message' => $validator->errors()];

             $response = \Response::json($result)->setStatusCode(400, 'Fail');

             return $response;

        } else {

          $user = new \App\User;

          $user->name = $name;
          $user->email = $email;
          $user->password = $password_bcrypt;

          $user->save();

          $result = ['result' => 'Success',
                     'message' => 'Account '. $name . ' with email '. $email . ' was created'];

           $response = \Response::json($result)->setStatusCode(200, 'Success');
           
           return $response;

        }
        
    }
    
      public function login(Request $request) {

        $email = $request->email;
        $password = $request->password;
        $user = User::where('email', $email)->first();
        
        if ($user != null) {

            if (\Hash::check($password, $user->password)) {

                $result = ['result' => 'Success',
                    'message' => 'Password correct',
                    'user_id' => $user->id];

                $response = \Response::json($result)->setStatusCode(200, 'Success');
                
                return $response;
                
            } else {

                $result = ['result' => 'Failed',
                    'message' => 'Password Incorrect'];

                $response = \Response::json($result)->setStatusCode(400, 'Fail');
                
                return $response;
            }

        } else {

            $result = ['result' => 'Failed',
                'message' => 'User with email not found'];

            $response = \Response::json($result)->setStatusCode(400, 'Fail');
            
            return $response;
        }
    }

    public function update_avatar(Request $request) {
            if($request->hasFile('avatar')){
                $avatar = $request->file('avatar');
                $filename = time().".".$avatar->getClientOriginalExtension();
                Image::make($avatar)->resize(300, 300)->save(public_path('/uploads/avatars/'. $filename));
                $user = Auth::user();
                $user->avatar = $filename;
                $user->save();
            }
    
        return view('user.profile', compact('user'));
    }

    public function show(User $user) {
        
        $role = $user->roles->first();
        return view('user.show', compact('user', 'role'));
    }
    
    public function  notify(User $user){
        
        $user->notify(new \App\Notifications\UserPaged($user));
        
        return back()->with('status', 'Notification send on '.$user->name .' : '.$user->email);
        
    }

    public function create() {
        
        $roles = Role::get();
        $user = Auth::user();
        if ($user->hasRole('admin')) {
            $admin_role = true;
        } else {
            $admin_role = false;
        }
        
        return view('user.create', compact('roles', 'admin_role'));
    }

    public function store(Request $request) {
        
        $validator = $this->validate($request, $this->rules());
        $roles = $request->role;
        
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        
        $user->roles()->attach($roles);
        
        return \Redirect::route('user.show', array($user->id));
    }

    public function edit(User $user) {
        
        $roles = Role::get();
        $selectedRole = $user->roles->first();
        
        return view('user.edit', compact('user', 'roles', 'selectedRole'));
    }

    public function update(Request $request, User $user) {
        $validator = $this->validate($request, $this->rules());
        DB::table('role_user')->where('user_id', $user->id)->delete();
        $roles = $request->role;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->remember_token = NULL;
        $user->roles()->attach($roles);
        $user->update();
        
        return view('user.show', compact('user'));
    }

    public function destroy(User $user) {
      
        DB::table('role_user')->where('user_id', $user->id)->delete();
        $user->delete();
        return back();
    }

}
