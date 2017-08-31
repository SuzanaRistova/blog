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
        $session->slug = 'session-1-1';
        $session->content = 'Sesson Content';
        $session->video = 'http://www.youtube.com/embed/W7qWa52k-nE';
        $session->completed = 0;
        $session->save();
        
        //Session 2 Lesson 1
        $session = new Session();
        $session->lesson_id = 1;
        $session->title = 'Sesson 2 Lesson 1';
        $session->slug = 'session-1-2';
        $session->content = 'Sesson Content';
        $session->video = 'http://www.youtube.com/embed/W7qWa52k-nE';
        $session->completed = 0;
        $session->save();
        
        //Session 1 Lesson 2
        $session = new Session();
        $session->lesson_id = 2;
        $session->title = 'Sesson 1 Lesson 2';
        $session->slug = 'session-2-1';
        $session->content = 'Sesson Content';
        $session->video = 'http://www.youtube.com/embed/W7qWa52k-nE';
        $session->completed = 0;
        $session->save();
        
        //Session 2 Lesson 2
        $session = new Session();
        $session->lesson_id = 2;
        $session->title = 'Sesson 2 Lesson 2';
        $session->slug = 'session-2-2';
        $session->content = 'Sesson Content';
        $session->video = 'http://www.youtube.com/embed/W7qWa52k-nE';
        $session->completed = 0;
        $session->save();
        
        //Session 1 Lesson 3
        $session = new Session();
        $session->lesson_id = 3;
        $session->title = 'Sesson 1 Lesson 3';
        $session->slug = 'session-3-1';
        $session->content = 'Sesson Content';
        $session->video = 'http://www.youtube.com/embed/W7qWa52k-nE';
        $session->completed = 0;
        $session->save();
        
        //Session 2 Lesson 3
        $session = new Session();
        $session->lesson_id = 3;
        $session->title = 'Sesson 2 Lesson 3';
        $session->slug = 'session-3-2';
        $session->content = 'Sesson Content';
        $session->video = 'http://www.youtube.com/embed/W7qWa52k-nE';
        $session->completed = 0;
        $session->save();
        
        //Session 1 Lesson 4
        $session = new Session();
        $session->lesson_id = 4;
        $session->title = 'Sesson 1 Lesson 4';
        $session->slug = 'session-4-1';
        $session->content = 'Sesson Content';
        $session->video = 'http://www.youtube.com/embed/W7qWa52k-nE';
        $session->completed = 0;
        $session->save();
        
        //Session 2 Lesson 4
        $session = new Session();
        $session->lesson_id = 4;
        $session->title = 'Sesson 2 Lesson 4';
        $session->slug = 'session-4-2';
        $session->content = 'Sesson Content';
        $session->video = 'http://www.youtube.com/embed/W7qWa52k-nE';
        $session->completed = 0;
        $session->save();
     
    }
}
