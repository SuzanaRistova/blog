<?php

use Illuminate\Database\Seeder;
use App\User;
class PageFakerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $limit = 30;

        for ($i = 0; $i < $limit; $i++) {
             
            DB::table('pages')->insert([//,
                'user_id' => $faker->randomElement(App\User::pluck('id', 'id')->toArray()),
                'title' => $faker->word,
                'slug' => $faker->unique()->slug,
                'content' => $faker->paragraph,
                'image' => $faker->image,
                'created_at' => $faker->dateTime($max = 'now'),
                'updated_at' => $faker->dateTime($max = 'now'),
            ]);
            
        }
    }
}
