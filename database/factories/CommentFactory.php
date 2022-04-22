<?php

namespace Database\Factories;
use App\Models\User;
use App\Models\Gallery;
use App\Models\Comment;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "user_id" => User::inRandomOrder()->first()->id,
            "gallery_id" => Gallery::inRandomOrder()->first()->id,
            "content" => $this->faker->sentence,
        ];
    }
}