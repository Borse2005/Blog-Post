<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tag = max((int)$this->command->ask('How many tags would you like?', 20), 1);
        Tag::factory()->times($tag)->create();
    }
}
