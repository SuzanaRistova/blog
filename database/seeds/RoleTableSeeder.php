<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Role Admin
        $role_admin = new Role();
        $role_admin->name = 'admin';
        $role_admin->save();
        
        // Role Editor
        $role_editor = new Role();
        $role_editor->name = 'editor';
        $role_editor->save();
        
        // Role Author
        $role_author = new Role();
        $role_author->name = 'author';
        $role_author->save();
        
        // Role subscriber
        $role_subscriber = new Role();
        $role_subscriber->name = 'subscriber';
        $role_subscriber->save();
    }
}
