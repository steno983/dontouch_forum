<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Post;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    if (User::where('email', 'test@test.com')->count() == 0) {
      User::create([
        'name' => 'Test',
        'email' => 'test@test.com',
        'password' => 'password',
      ]);
      User::factory(100)->create();

      Thread::factory(100)
        ->has(Post::factory()->count(10))
        ->create();
    }
  }
}
