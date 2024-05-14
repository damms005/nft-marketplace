<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <style>
    [x-cloak] {
      display: none !important;
    }
  </style>

  @filamentStyles
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  @livewireStyles
</head>

<body>

  @if ($errors->any())
    <div class="m-5 inline-block p-5">
      <ul>
        @foreach ($errors->all() as $error)
          <li class="m-2 inline-block rounded-lg bg-red-400 p-3 text-white">{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <livewire:user-data-card />


  <div class="bg-white">
      <div class="mx-auto max-w-7xl overflow-hidden px-4 py-16 sm:px-6 sm:py-24 lg:px-8">
        <div class="text-gray-800 mt-5 mb-20 text-3xl">
          NFT for <span class="bg-gray-300 rounded-md py-1 px-3">Domains</span>
        </div>
      <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-5 lg:gap-x-8">

        @foreach ($nfts as $nft)
          <livewire:nft-card :nft="$nft" />
        @endforeach

      </div>
    </div>
  </div>

  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

  @livewireScripts

  @livewire('notifications')

  @filamentScripts

</body>

</html>
