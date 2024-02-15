<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class CreateThread extends Component
{
  public $title;
  public $content;

  public function create()
  {
    $response = Http::withToken(getToken())
      ->post(config('app.url') . '/api/threads', [
        'title' => $this->title,
        'content' => $this->content,
      ]);

    switch ($response->status()) {
      case 200:
        $this->redirect('/thread/' . $response->json('thread_id'));
        break;
      case 401:
        dd('401');
        break;
      case 500:
        dd('500');
        break;
    }
  }

  public function render()
  {
    return view('livewire.create-thread');
  }
}
