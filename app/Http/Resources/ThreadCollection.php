<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ThreadCollection extends ResourceCollection
{
  /**
   * Transform the resource collection into an array.
   *
   * @return array<int|string, mixed>
   */
  public function toArray(Request $request): array
  {
    //return parent::toArray($request);
    return $this->collection->map(fn($el) => (new ThreadResource($el))->additional(['with_posts' => false]))->toArray();
  }
}
