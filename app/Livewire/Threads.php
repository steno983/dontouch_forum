<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Threads extends Component
{
  public array $threads;
  public $links;
  public $meta;

  public $next = null;
  public $prev = null;
  private $first = null;
  private $last = null;


  public function getPage($url)
  {
    $response = Http::withToken(getToken())->get($url);
    if($response->status() == 200){
      $data = $response->json();
      $this->threads = $data['data'];//array_map(fn($item) => ThreadDTO::fromArray($item), $data['data']);
      $this->meta = $data['meta'];
      $this->prev = $data['links']['prev'];
      $this->next = $data['links']['next'];
      $this->first = $data['links']['first'];
      $this->last = $data['links']['last'];
    } else {
      $this->threads = [];
      $this->meta = [];
    }
  }

  public function mount()
  {
    $this->getPage(config('app.url') . '/api/threads');
  }

  public function gotoNext()
  {
    $this->getPage($this->next);
  }

  public function gotoPrev()
  {
    $this->getPage($this->prev);
  }

  public function render()
  {
    return view('livewire.threads');
  }
}
