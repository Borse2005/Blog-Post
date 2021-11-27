<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
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
        if ($this->command->confirm('Do you want to refersh th database', true)) {
            $this->command->call('migrate:refresh');
            $this->command->info('Database was refresh');
        }

        $this->call(UserSeeder::class); 
        $this->call(PostSeeder::class);  
        $this->call(CommentSeeder::class); 
        $this->call(TagSeeder::class); 

        $tag = max((int)$this->command->ask('How many tags to post would you like?', 20), 1);
        
        for ($i=1; $i < $tag; $i++) { 
            DB::table('post_tag')->insert([
                'posts_id' => rand(1, Post::count()),
                'tags_id' => rand(1, Tag::count()),
            ]);
        }
    }
}
