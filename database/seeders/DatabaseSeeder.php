<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tags;
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

         \App\Models\User::factory(10)->create();
         \App\Models\Post::factory(50)->create();
         \App\Models\Comment::factory(50)->create();
         \App\Models\Tags::factory(50)->create();

    }
}
