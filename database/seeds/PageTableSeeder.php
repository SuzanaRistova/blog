<?php

use Illuminate\Database\Seeder;
use App\Page;

class PageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Page Admin
        $page_admin = new Page();
        $page_admin->user_id = 1;
        $page_admin->title = 'Admin Page';
        $page_admin->slug = 'admin-page';
        $page_admin->content = 'Admin Content';
        $page_admin->save();
        
        // Page Editor
        $page_editor = new Page();
        $page_editor->user_id = 2;
        $page_editor->title = 'Editor Page';
        $page_editor->slug = 'editor-page';
        $page_editor->content = 'Editor Content';
        $page_editor->save();
        
        // Page Author
        $page_author = new Page();
        $page_author->user_id = 3;
        $page_author->title = 'Author Page';
        $page_author->slug = 'author-page';
        $page_author->content = 'Author Content';
        $page_author->save();
        
        // Page Subscriber
        $page_subscriber = new Page();
        $page_subscriber->user_id = 4;
        $page_subscriber->title = 'Subscriber Page';
        $page_subscriber->slug = 'subscriber-page';
        $page_subscriber->content = 'Subscriber Content';
        $page_subscriber->save();
    }
}
