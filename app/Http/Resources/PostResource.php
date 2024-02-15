<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @return array<string, mixed>
   */
  public function toArray(Request $request): array
  {
    return [
      'id' => $this->id,
      'thread_id' => $this->thread_id,
      'content' => $this->content,
      'created_at' => $this->created_at,
      'user' => new UserResource($this->user),
    ];
  }
}
