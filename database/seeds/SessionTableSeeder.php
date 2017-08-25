<?php
use App\Session;
use Illuminate\Database\Seeder;

class SessionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Session 1 Lesson 1
        $session = new Session();
        $session->lesson_id = 1;
        $session->title = 'Sesson 1 Lesson 1';
        $session->slug = 'session-1';
        $session->content = 'Sesson Content';
        $session->video = 'Video';
        $session->completed = 0;
        $session->save();
        
        //Session 2 Lesson 1
        $session = new Session();
        $session->lesson_id = 1;
        $session->title = 'Sesson 2 Lesson 1';
        $session->slug = 'session-2';
        $session->content = 'Sesson Content';
        $session->video = 'Video';
        $session->completed = 0;
        $session->save();
        
        //Session 1 Lesson 2
        $session = new Session();
        $session->lesson_id = 2;
        $session->title = 'Sesson 1 Lesson 2';
        $session->slug = 'session-1-2';
        $session->content = 'Sesson Content';
        $session->video = 'Video';
        $session->completed = 0;
        $session->save();
        
        //Session 2 Lesson 2
        $session = new Session();
        $session->lesson_id = 2;
        $session->title = 'Sesson 2 Lesson 2';
        $session->slug = 'session-2-2';
        $session->content = 'Sesson Content';
        $session->video = 'Video';
        $session->completed = 0;
        $session->save();
     
    }
}
