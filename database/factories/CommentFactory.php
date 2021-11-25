<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'content' => $this->faker->text(50),
            'post_id' => rand(2, Post::count()),
            'user_id' => rand(1, User::count()),
            'created_at' => $this->faker->dateTimeBetween('-1month'),
        ];
    }

}
