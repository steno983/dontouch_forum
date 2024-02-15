<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ShowThread extends Component
{
  public $id;
  public $thread;

  public $meta;

  public $next = null;
  public $prev = null;
  private $first = null;
  private $last = null;


  public function mount()
  {
    $response = Http::get(config('app.url') . '/api/threads/' . $this->id);
    if ($response->status() != 200) {
      $this->redirect('/');
    }

    $this->thread = $response->json('data');
  }

  public function deletePost($post_id)
  {
    $response = Http::withToken(getToken())->delete(config('app.url') . '/api/posts/' . $post_id);
    if ($response->status() == 204) {
      $this->redirect(route('show', ['id' => $this->id]));
    }
  }

  public function deleteThread()
  {
    $response = Http::withToken(getToken())->delete(config('app.url') . '/api/threads/' . $this->id);
    if ($response->status() == 204) {
      $this->redirect('/');
    } else {
      dd(getToken());
      dd($response->status());
    }
  }

  public function render()
  {
    return view('livewire.show-thread');
  }
}
