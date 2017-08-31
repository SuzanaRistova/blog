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
        //Module 1 Lesson 1
        $lesson_module = new Lesson();
        $lesson_module->module_id = 1;
        $lesson_module->title = 'Module 1 Lesson 1';
        $lesson_module->slug = 'module-1-lesson-1';
        $lesson_module->content = 'Lesson Content 1';
        $lesson_module->save();
        
        //Module 1 Lesson 2
        $lesson_module = new Lesson();
        $lesson_module->module_id = 1;
        $lesson_module->title = 'Module 1 Lesson 2';
        $lesson_module->slug = 'module-1-lesson-2';
        $lesson_module->content = 'Lesson Content 2';
        $lesson_module->save();
        
        //Module 1 Lesson 3
        $lesson_module = new Lesson();
        $lesson_module->module_id = 1;
        $lesson_module->title = 'Module 1 Lesson 3';
        $lesson_module->slug = 'module-1-lesson-3';
        $lesson_module->content = 'Lesson Content 3';
        $lesson_module->save();
        
        //Module 1 Lesson 4
        $lesson_module= new Lesson();
        $lesson_module->module_id = 1;
        $lesson_module->title = 'Module 1 Lesson 4';
        $lesson_module->slug = 'module-1-lesson-4';
        $lesson_module->content = 'Lesson Content 4';
        $lesson_module->save();
        
         //Module 2 Lesson 1
        $lesson_module = new Lesson();
        $lesson_module->module_id = 2;
        $lesson_module->title = 'Module 2 Lesson 1';
        $lesson_module->slug = 'module-2-lesson-1';
        $lesson_module->content = 'Lesson Content 1';
        $lesson_module->save();
        
        //Module 2 Lesson 2
        $lesson_module = new Lesson();
        $lesson_module->module_id = 2;
        $lesson_module->title = 'Module 2 Lesson 2';
        $lesson_module->slug = 'module-2-lesson-2';
        $lesson_module->content = 'Lesson Content 2';
        $lesson_module->save();
        
        //Module 2 Lesson 3
        $lesson_module = new Lesson();
        $lesson_module->module_id = 2;
        $lesson_module->title = 'Module 2 Lesson 3';
        $lesson_module->slug = 'module-2-lesson-3';
        $lesson_module->content = 'Lesson Content 3';
        $lesson_module->save();
        
        //Module 2 Lesson 4
        $lesson_module= new Lesson();
        $lesson_module->module_id = 2;
        $lesson_module->title = 'Module 2 Lesson 4';
        $lesson_module->slug = 'module-2-lesson-4';
        $lesson_module->content = 'Lesson Content 4';
        $lesson_module->save();
        
          
         //Module 3 Lesson 1
        $lesson_module = new Lesson();
        $lesson_module->module_id = 3;
        $lesson_module->title = 'Module 3 Lesson 1';
        $lesson_module->slug = 'module-3-lesson-1';
        $lesson_module->content = 'Lesson Content 1';
        $lesson_module->save();
        
        //Module 3 Lesson 2
        $lesson_module = new Lesson();
        $lesson_module->module_id = 3;
        $lesson_module->title = 'Module 3 Lesson 2';
        $lesson_module->slug = 'module-3-lesson-2';
        $lesson_module->content = 'Lesson Content 2';
        $lesson_module->save();
        
        //Module 3 Lesson 3
        $lesson_module = new Lesson();
        $lesson_module->module_id = 3;
        $lesson_module->title = 'Module 3 Lesson 3';
        $lesson_module->slug = 'module-3-lesson-3';
        $lesson_module->content = 'Lesson Content 3';
        $lesson_module->save();
        
        //Module 3 Lesson 4
        $lesson_module= new Lesson();
        $lesson_module->module_id = 3;
        $lesson_module->title = 'Module 3 Lesson 4';
        $lesson_module->slug = 'module-3-lesson-4';
        $lesson_module->content = 'Lesson Content 4';
        $lesson_module->save();       
          
        //Module 4 Lesson 1
        $lesson_module = new Lesson();
        $lesson_module->module_id = 4;
        $lesson_module->title = 'Module 4 Lesson 1';
        $lesson_module->slug = 'module-4-lesson-1';
        $lesson_module->content = 'Lesson Content 1';
        $lesson_module->save();
        
        //Module 4 Lesson 2
        $lesson_module = new Lesson();
        $lesson_module->module_id = 4;
        $lesson_module->title = 'Module 4 Lesson 2';
        $lesson_module->slug = 'module-4-lesson-2';
        $lesson_module->content = 'Lesson Content 2';
        $lesson_module->save();
        
        //Module 4 Lesson 3
        $lesson_module = new Lesson();
        $lesson_module->module_id = 4;
        $lesson_module->title = 'Module 4 Lesson 3';
        $lesson_module->slug = 'module-4-lesson-3';
        $lesson_module->content = 'Lesson Content 3';
        $lesson_module->save();
        
        //Module 4 Lesson 4
        $lesson_module= new Lesson();
        $lesson_module->module_id = 4;
        $lesson_module->title = 'Module 4 Lesson 4';
        $lesson_module->slug = 'module-4-lesson-4';
        $lesson_module->content = 'Lesson Content 4';
        $lesson_module->save();
    }
}
