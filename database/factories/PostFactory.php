<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->text(25),
            'content' => $this->faker->paragraph(10),
            'user_id' => rand(1, User::count()),
            'created_at' => $this->faker->dateTimeBetween('-1month'),
            'deleted_at' => null
        ];
    }
}
