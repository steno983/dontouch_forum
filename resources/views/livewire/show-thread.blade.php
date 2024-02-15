<div class="mx-2">
  <div class="w-4/5 border p-4 text-2xl">
    <h1>{{$thread['title']}}</h1>
    @if($thread['opener']['id'] == session('user.id'))
      <a wire:click="deleteThread" class="text-red-300 text-sm cursor-pointer">
        [DELETE]
      </a>
    @endif
  </div>
  <div>
    @foreach($thread['posts'] as $post)
      <div class="w-4/5 border p-4 my-1" wire:key="{{$post['id']}}">
        <div class="text-sm text-gray-600 w-full border-b">
          {{$post['user']['name']}}
          @if($post['user']['id'] == session('user.id'))
            @livewire('edit-post', ['post' => $post])
            @if($loop->index > 0)
              <a wire:click="deletePost({{$post['id']}})" class="text-red-300 text-sm cursor-pointer">
                [DELETE]
              </a>
            @endif
          @endif
        </div>
        <div class="my-4 text-lg">
          {{$post['content']}}
        </div>
        <div class="text-sm text-gray-600 w-full border-t">
          {{\Illuminate\Support\Carbon::createFromDate($post['created_at'])->format('d/m/Y H:i')}}
        </div>
      </div>
    @endforeach
  </div>
  @if(isLogged())
    @livewire('reply-to-thread', ['thread_id' => $thread['id']])
  @endif
  <div class="my-4 border-t py-2">
    <a href="/" wire:navigate>
      <button type="button"
              class="my-4 p-2 border rounded-xl bg-purple-800 text-gray-100 font-bold hover:bg-purple-700">
        << Back
      </button>
    </a>
  </div>
</div>
