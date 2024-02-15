<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>
  <script src="https://cdn.tailwindcss.com"></script>

  <title>{{ $title ?? 'Page Title' }}</title>
</head>
<body>
<header class="flex h-28 align-items-center border-b drop-shadow mb-4">
  <div class="h-auto  w-full flex my-auto justify-between">
    <div class="ml-14 text-2xl uppercase my-auto">
      <h1>Dontouch Forum</h1>
    </div>

    @persist('login')
    <div class="mr-14 text-2x uppercase">
      @livewire('login')
    </div>
    @endpersist
  </div>
</header>


{{ $slot }}
</body>
</html>
