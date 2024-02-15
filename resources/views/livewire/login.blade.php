<div>
  @if(!$isLogged)
    <form wire:submit="login">
      <input type="email" wire:model="email">
      <input type="password" wire:model="password">
      <button type="submit">Login</button>
    </form>
  @else
    Hey {{session('user.name')}} | <button type="button" wire:click="logout" class="pointer">Logout</button>
  @endif
</div>
