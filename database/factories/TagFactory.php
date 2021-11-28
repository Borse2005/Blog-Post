<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $tag = collect(['Politic', 'Science', 'Sport', 'Entertain']);
        return [
            'name' => $this->faker->name('male'),
        ];
    }
}
