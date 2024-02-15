<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewTheadRequest;
use App\Http\Resources\ThreadCollection;
use App\Http\Resources\ThreadResource;
use App\Models\Post;
use App\Models\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ThreadController extends Controller
{
  public function __construct()
  {
    $this->middleware('jwt.auth')
      ->except(['index', 'show']);
  }

  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    return new ThreadCollection(Thread::orderBy('id', 'desc')->paginate(10));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(NewTheadRequest $request)
  {
    $thread = Thread::create([
      'user_id' => auth()->id(),
      'title' => $request->get('title'),
    ]);

    Post::create([
      'user_id' => auth()->id(),
      'thread_id' => $thread->id,
      'content' => $request->get('content'),
    ]);

    return response()->json(['thread_id' => $thread->id]);
  }

  /**
   * Display the specified resource.
   */
  public function show(Thread $thread)
  {
    return new ThreadResource($thread);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Thread $thread)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Thread $thread)
  {
    if (!Gate::allows('delete-thread', $thread)) {
      return response()->json(null, 403);
    }

    $thread->delete();
    return response()->json(null, 204);
  }
}
