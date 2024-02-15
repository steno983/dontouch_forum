<?php

use App\Models\Post;
use App\Models\User;
use App\Models\Thread;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);


beforeEach(fn() => \Illuminate\Support\Facades\Artisan::call('db:seed'));

test('that guest cant create start a new thread', function () {
  $response = $this->post('/api/posts', [
    'content' => fake()->words(2),
  ]);
  expect($response->status())->toBe(401);
});

test('that guest cant destroy a post', function () {
  $post = Post::first();
  $response = $this->delete('/api/posts/' . $post->id);
  expect($response->status())->toBe(401);
});

test('that guest cant destroy a non existing post', function () {
  $response = $this->delete('/api/posts/2131298989831');
  expect($response->status())->toBe(404);
});

test('that a logged user can create a new post on a thread', function () {
  $response = $this->actingAs(User::first())->post('/api/posts', [
    'thread_id' => Thread::first()->id,
    'content' => 'test content',
  ]);
  expect($response->status())->toBe(201);
});

test('that a logged user can edit a post on a thread', function () {
  $user = User::first();
  $post = Post::create([
    'user_id' => $user->id,
    'thread_id' => Thread::first()->id,
    'content' => 'test'
  ]);
  $response = $this->actingAs($user)->patch('/api/posts/' . $post->id, [
    'content' => 'test content',
  ]);
  expect($response->status())
    ->toBe(200)
    ->and($response->json()['content'])
    ->toBe('test content');
});

test('that a logged user cant edit a post dont own on a thread', function () {
  $user = User::first();
  $post = Post::create([
    'user_id' => $user->id + 1,
    'thread_id' => Thread::first()->id,
    'content' => 'test'
  ]);
  $response = $this->actingAs($user)->patch('/api/posts/' . $post->id, [
    'content' => 'test content',
  ]);
  expect($response->status())
    ->toBe(403);
});

test('that a logged user can delete his own post', function () {
  $user = User::first();
  $post = Post::create([
    'user_id' => $user->id,
    'thread_id' => 1,
    'content' => 'test'
  ]);
  $response = $this->actingAs($user)->delete("/api/posts/{$post->id}");
  expect($response->status())->toBe(204);
});

test('that a logged user cant delete a post he wont own', function () {
  $user = User::first();
  $post = Post::create([
    'user_id' => $user->id + 1,
    'thread_id' => 1,
    'content' => 'test'
  ]);
  $response = $this->actingAs($user)->delete("/api/posts/{$post->id}");
  expect($response->status())->toBe(403);
});
