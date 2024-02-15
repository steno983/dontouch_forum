<?php

use App\Models\User;
use App\Models\Thread;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);


beforeEach(fn() => \Illuminate\Support\Facades\Artisan::call('db:seed'));

test('that user can show threads', function () {
  $data = $this->get(config('app.url') . '/api/threads')->json('data');
  expect($data)->toBeArray();
})->group('threads');

test('that user can view a thread', function () {
  $thread = Thread::first();
  $data = $this->get('/api/threads/' . $thread->id)->json('data');
  expect($data)->toBeArray();
});

test('that guest cant create start a new thread', function () {
  $response = $this->post('/api/threads', [
    'title' => fake()->words(2),
    'content' => fake()->words(2),
  ]);
  expect($response->status())->toBe(401);
});

test('that guest cant destroy a thread', function () {
  $thread = Thread::first();
  $response = $this->delete('/api/threads/' . $thread->id);
  expect($response->status())->toBe(401);
});

test('that guest cant destroy a non existing thread', function () {
  $response = $this->delete('/api/threads/2131298989831');
  expect($response->status())->toBe(404);
});

test('that a logged user can create a new thread', function () {
  $response = $this->actingAs(User::first())->post('/api/threads', [
    'title' => 'test test',
    'content' => 'test content',
  ]);
  expect($response->status())->toBe(200);
});

test('that a logged user can delete his own thread', function () {
  $user = User::first();
  $thread = Thread::create([
    'user_id' => $user->id,
    'title' => 'test'
  ]);
  $response = $this->actingAs($user)->delete("/api/threads/{$thread->id}");
  expect($response->status())->toBe(204);
});

test('that a logged user cant delete a thread he wont own', function () {
  $user = User::first();
  $thread = Thread::create([
    'user_id' => $user->id + 1,
    'title' => 'test'
  ]);
  $response = $this->actingAs($user)->delete("/api/threads/{$thread->id}");
  expect($response->status())->toBe(403);
});
