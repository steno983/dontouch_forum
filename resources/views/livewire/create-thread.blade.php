<div class="w-3/4 mx-4">
  <h1 class="font-bold text-lg uppercase">Crea nuovo thread</h1>
  <form wire:submit="create">
    <div>
      <label for="title"></label>
      <input id="title" type="text" wire:model="title" class="border p-2 rounded drop-shadow my-3 w-full"
             placeholder="Titolo">
    </div>
    <div>
      <label for="content"></label>
      <textarea id="content" wire:model="content" class="border p-2 rounded drop-shadow my-3 w-full h-80" placeholder="Post"></textarea>
    </div>
    <button type="submit" class="my-4 p-2 border rounded-xl bg-purple-800 text-gray-100 font-bold hover:bg-purple-700">Invia</button>
  </form>
</div>
