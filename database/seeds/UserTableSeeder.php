<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = Role::where('name', 'admin')->first();
        $role_editor = Role::where('name', 'editor')->first();
        $role_author = Role::where('name', 'author')->first();
        $role_subscriber = Role::where('name', 'subscriber')->first();
        
        $admin = new User();
        $admin->name = 'Admin';
        $admin->email = 'admin@yahoo.com';
        $admin->password = bcrypt('admin');
        $admin->save();
        $admin->roles()->attach($role_admin);
        
        
        $editor = new User();
        $editor->name = 'Editor';
        $editor->email = 'editor@yahoo.com';
        $editor->password = bcrypt('editor');
        $editor->save();
        $editor->roles()->attach($role_editor);
        
        $author = new User();
        $author->name = 'Author';
        $author->email = 'author@yahoo.com';
        $author->password = bcrypt('author');
        $author->save();
        $author->roles()->attach($role_author);
        
        $subscriber = new User();
        $subscriber->name = 'Subscriber';
        $subscriber->email = 'subscriber@yahoo.com';
        $subscriber->password = bcrypt('subscriber');
        $subscriber->save();
        $subscriber->roles()->attach($role_subscriber);
    }
}