<div class="my-4 border-t py-2">
  <form wire:submit="sendReply">
    <label for="reply">Rispondi: </label>
    <textarea id="reply" name="reply" wire:model="reply" class="w-full border h-80 p-1"></textarea>
    <button type="submit" class="p-2 border rounded-xl bg-purple-800 text-gray-100 font-bold hover:bg-purple-700">
      Rispondi
    </button>
  </form>
</div>
