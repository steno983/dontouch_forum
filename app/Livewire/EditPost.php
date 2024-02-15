<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class EditPost extends Component
{

  public $post;

  public $content;

  public function mount($post)
  {
    $this->post = $post;
    $this->content = $post['content'];
  }

  public function editPost()
  {
    $response = Http::withToken(getToken())->put(config('app.url') . '/api/posts/' . $this->post['id'], [
      'content' => $this->content
    ]);
    $this->redirect('/thread/' . $this->post['thread_id']);
  }

  public function render()
  {
    return view('livewire.edit-post');
  }
}
