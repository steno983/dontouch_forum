<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ReplyToThread extends Component
{
  public $thread_id;
  public $reply;

  public function mount($thread_id)
  {
    $this->thread_id = $thread_id;
  }

  public function sendReply()
  {
    $response = Http::withToken(getToken())->post(config('app.url') . '/api/posts', [
      'thread_id' => $this->thread_id,
      'content' => $this->reply,
    ]);
    if ($response->status() == 201) {
      $this->redirect(route('show', ['id' => $this->thread_id]));
    }
  }

  public function render()
  {
    return view('livewire.reply-to-thread');
  }
}
