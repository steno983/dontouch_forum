<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Login extends Component
{
  public $email;
  public $password;

  public $isLogged;

  public function mount()
  {
    $this->isLogged = session('token') ?? null;
  }

  public function login()
  {
    $response = Http::post(config('app.url') . '/api/auth/login', [
      'email' => $this->email,
      'password' => $this->password,
    ]);
    if ($response->status() !== 200) {
      //gestione errore
    } else {
      session(['token' => $response->json('token'), 'user' => $response->json('user')]);
      $this->isLogged = true;
      $this->redirect('/');
    }
  }

  public function logout()
  {
    request()->session()->forget(['token', 'user']);

    $this->isLogged = false;
    $this->redirect('/');
  }

  public function render()
  {
    return view('livewire.login');
  }
}
