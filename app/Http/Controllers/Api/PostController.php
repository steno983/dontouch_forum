<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
  public function __construct()
  {
    $this->middleware('jwt.auth');
  }

  public function update(Request $request, Post $post)
  {
    if (!Gate::allows('edit-post', $post)) {
      return response()->json(null, 403);
    }

    $post->content = $request->get('content');
    $post->save();
    return response()->json(new PostResource($post));
  }

  public function store(Request $request)
  {
    Post::create([
      'user_id' => auth()->id(),
      'thread_id' => $request->get('thread_id'),
      'content' => $request->get('content'),
    ]);

    return response()->json(null, 201);
  }

  public function destroy(Post $post)
  {
    if (!Gate::allows('delete-post', $post)) {
      return response()->json(null, 403);
    }

    $post->delete();
    return response()->json(null, 204);
  }
}
