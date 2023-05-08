<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(rand(2, 3), true),
            'slug' => $this->faker->slug(rand(2, 3)),
            'content' => $this->faker->sentences(15, true),
            'image' => 'https://placehold.jp/3d4070/ffffff/150x150.png'
        ];
    }
}
