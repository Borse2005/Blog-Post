<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->text(20),
            'content' => $this->faker->paragraph(40),
            'user_id' => rand(1, User::count()),
            'created_at' => $this->faker->dateTimeBetween('-3 months'),
        ];
    }
}
