<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = max((int)$this->command->ask('How many users would you like?', 20),1);
        User::factory()->times($user)->create();

        DB::table('users')->insert([
            'name' => 'Darshan Borse',
            'email' => 'borsedarshan77@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$TDOnf0cXY91hXuI4QVUMPuk8XOwZRxHzddSLYydUjrL96ndrmPR/S', // Darshan@123
            'remember_token' => Str::random(10),
            'is_admin' => true,
        ]);
    }
}
