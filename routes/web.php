<?php

use App\Livewire\CreateThread;
use App\Livewire\ShowThread;
use App\Livewire\Threads;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', Threads::class);
Route::get('/thread/new', CreateThread::class)
  ->name('new');
Route::get('/thread/{id}', ShowThread::class)
  ->name('show');


/*Route::get('/', function () {
    return view('welcome');
});*/
