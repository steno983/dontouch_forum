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
  public function definition(): array
  {
    return [
      'user_id' => rand(1, 100),
      'thread_id' => rand(1, 100),
      'content' => fake()->paragraph(1),
      'created_at' => fake()->dateTime,
    ];
  }
}
