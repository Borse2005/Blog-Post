<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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
        $this->call(PostTagSeeder::class);

       
    }
}
