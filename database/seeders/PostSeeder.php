<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $post = max((int)$this->command->ask('How many post would you like?',20),1);
        Post::factory()->times($post)->create();
    }
}
