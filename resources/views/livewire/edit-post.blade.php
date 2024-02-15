<div x-data="{open: false}">
  <button type="button" x-on:click="open = true" class="text-cyan-300 mx-4 text-sm">
    [EDIT]
  </button>
  <div x-show="open"
       class="fixed inset-0 flex justify-center items-center bg-gray-500/50">
    <div class="bg-white rounded-xl shadow-xl p-8 w-3/4">
      <div class="text-xl font-bold p-3 border-b">
        Modifica post
      </div>
      <form wire:submit="editPost">
        <label for="content"></label>
        <textarea id="content" wire:model="content"
                  class="border p-4 w-full mt-4 rounded drop-shadow h-80">{{$post['content']}}</textarea>
        <button type="submit"
                class="my-4 p-2 border rounded-xl bg-purple-800 text-gray-100 font-bold hover:bg-purple-700">Salva
        </button>
      </form>
    </div>

  </div>
</div>
