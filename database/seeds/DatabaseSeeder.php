<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        
        // Role comes before User seeder here.
        $this->call(RoleTableSeeder::class);
        
        // User seeder will use the roles above created.
        $this->call(UserTableSeeder::class);
        
        // Page seeder will use the roles above created.
        $this->call(PageTableSeeder::class);
        
        // Module seeder will use the roles above created.
        $this->call(ModuleTableSeeder::class);
        
        // Lesson seeder will use the roles above created.
        $this->call(LessonTableSeeder::class);
        
        // Session seeder will use the roles above created.
        $this->call(SessionTableSeeder::class);
    }
}
