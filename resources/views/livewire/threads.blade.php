<div>
  <div class="flex px-4 justify-between">
    <p class="text-lg font-bold">Threads</p>
    @if(isLogged())
      <div>
        <a href="/thread/new" wire:navigate
           class="my-4 p-2 border rounded-xl bg-purple-800 text-gray-100 font-bold hover:bg-purple-700 cursor-pointer">Nuovo thread</a>
      </div>
    @endif
  </div>
  @if($threads)
    @foreach($threads as $thread)
      <div class="w-2/3 border my-4 mx-2 p-4">
        <div class="flex w-full justify-between">
          <div>
            <a href="/thread/{{$thread['id']}}" wire:navigate class="hover:underline">{{$thread['title']}}</a>
          </div>
          <div>
            Comments: {{$thread['posts']}}
          </div>
        </div>

        <div class="flex text-sm mt-8 text-gray-600 w-full border-t">
          {{$thread['opener']['name']}}
          - {{\Illuminate\Support\Carbon::createFromDate($thread['created_at'])->format('d/m/Y H:i')}}
        </div>
      </div>
    @endforeach
    <div>
      <div>
        @if($prev)
          <a wire:click="gotoPrev" class="my-4 p-2 border rounded-xl bg-purple-800 text-gray-100 font-bold hover:bg-purple-700 cursor-pointer"> << </a>
        @endif

        (Pagina {{$meta['current_page']}} di {{$meta['last_page']}})

        @if($next)
          <a wire:click="gotoNext" class="my-4 p-2 border rounded-xl bg-purple-800 text-gray-100 font-bold hover:bg-purple-700 cursor-pointer"> >> </a>
        @endif
      </div>
    </div>
  @else
    <h1>no data</h1>
  @endif

</div>
