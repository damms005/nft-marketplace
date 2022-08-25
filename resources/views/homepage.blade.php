<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  @livewireStyles
</head>

<body>

  @if ($errors->any())
    <div class="p-5 m-5 inline-block">
      <ul>
        @foreach ($errors->all() as $error)
          <li class="inline-block rounded-lg p-3 bg-red-400 text-white m-2">{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <livewire:user-data-card />

  <div class="bg-white">
    <div class="max-w-7xl mx-auto py-16 px-4 overflow-hidden sm:py-24 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-5 lg:gap-x-8">

        @foreach ($nfts as $nft)
          <livewire:nft-card :nft="$nft" />
        @endforeach

      </div>
    </div>
  </div>

  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
  @livewireScripts

  <x:notify-messages />
  @notifyJs

</body>

</html>
