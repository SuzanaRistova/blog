<?php

use Illuminate\Database\Seeder;
use App\Lesson;

class LessonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Lesson 1
        $lesson_admin = new Lesson();
        $lesson_admin->module_id = 4;
        $lesson_admin->title = 'Lesson 1';
        $lesson_admin->slug = 'lesson-1';
        $lesson_admin->content = 'Lesson Content 1';
        $lesson_admin->save();
        
        //Lesson 2
        $lesson_editor = new Lesson();
        $lesson_editor->module_id = 4;
        $lesson_editor->title = 'Lesson 2';
        $lesson_editor->slug = 'lesson-2';
        $lesson_editor->content = 'Lesson Content 2';
        $lesson_editor->save();
        
        //Lesson 3
        $lesson_author = new Lesson();
        $lesson_author->module_id = 4;
        $lesson_author->title = 'Lesson 3';
        $lesson_author->slug = 'lesson-3';
        $lesson_author->content = 'Lesson Content 3';
        $lesson_author->save();
        
        //Lesson 4
        $lesson_subscriber= new Lesson();
        $lesson_subscriber->module_id = 4;
        $lesson_subscriber->title = 'Lesson 4';
        $lesson_subscriber->slug = 'lesson-4';
        $lesson_subscriber->content = 'Lesson Content 4';
        $lesson_subscriber->save();
    }
}
