<?php

use App\Module;
use Illuminate\Database\Seeder;

class ModuleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Module Admin
        $module_admin = new App\Module();
        $module_admin->user_id = 1;
        $module_admin->title = 'Module Page';
        $module_admin->slug = 'admin-module';
        $module_admin->content = 'Admin Content';
        $module_admin->save();
        
        //Module Editor
        $module_editor = new Module();
        $module_editor->user_id = 2;
        $module_editor->title = 'Editor Module';
        $module_editor->slug = 'editor-module';
        $module_editor->content = 'Editor Content';
        $module_editor->save();
        
        //Module Author
        $module_author = new Module();
        $module_author->user_id = 3;
        $module_author->title = 'Author Module';
        $module_author->slug = 'author-module';
        $module_author->content = 'Author Content';
        $module_author->save();
        
        //Module Subscriber
        $module_subscriber= new Module();
        $module_subscriber->user_id = 4;
        $module_subscriber->title = 'Subscriber Module';
        $module_subscriber->slug = 'subscriber-module';
        $module_subscriber->content = 'Subscriber Content';
        $module_subscriber->save();
        
    }
}
