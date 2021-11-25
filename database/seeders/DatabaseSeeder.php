<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Post;
use App\Models\Tag;
use Carbon\Factory;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

     
    public function run()
    {
        if ($this->command->confirm('Do you want to refresh the databse?', true)) {
            $this->command->call('migrate:refresh');
            $this->command->info('Database was refresh');
        }


        $userCount = max((int)$this->command->ask('How many user would you like?', 20),1);
        $postCount = (int)$this->command->ask('How many post would you like?', 20);
        $commentCount = (int)$this->command->ask('How many comment would you like?', 20);
        $tagCount = (int)$this->command->ask('How many tags would you like?', 20);
        $posttag = (int)$this->command->ask('How many post for join tag would you like?', 20);

        DB::table('users')->insert([
            'name' => 'Darshan Borse',
            'email' => 'borsedarshan77@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$7bWncSFqfE0V/EatOh7MD.hVw76IFPuV7X9UyJIt87kajm7KwQL9.', //Darshan@123
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
            'is_admin' =>true,
        ]);

        // DB::table('post_tags')->insert([
        //     'posts_id' => rand(1, Post::count()),
        //     'tags_id' => rand(1, Tags::count()),
        // ]);

        Cache::flush();

         \App\Models\User::factory($userCount)->create();
         \App\Models\Post::factory( $postCount)->create();
         \App\Models\Comment::factory($commentCount)->create();
         \App\Models\Tag::factory($tagCount)->create();

         for ($i = 0; $i < $posttag; $i++) {
                
            DB::table('post_tag')->insert([
                'posts_id' => rand(1, Post::count()),
                'tags_id' => rand(1, Tag::count()),
            ]);
        }
    }
}
