<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">

  <script src="{{ asset(mix('js/app.js')) }}"></script>

  @livewireStyles

</head>

<body>
  <div class="text-right p-3 text-gray-500 italic fixed z-10 top-1 right-1 -mt-1">
    @if (auth()->check())
      {{ auth()->user()->name }}
      <span class="mx-1 bg-gray-200 text-sm py-1 px-2 rounded-lg"> ${{ Auth::user()->account_balance }}</span>
      <a class="underline mx-2" href="{{ route('logout') }}">Logout</a>
    @else
      <a class="underline" href="{{ route('login') }}">Login</a>
    @endif
  </div>
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
