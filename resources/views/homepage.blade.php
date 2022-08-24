<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
  <div class="text-right p-3 text-gray-500 italic">
    @if (auth()->check())
      {{ auth()->user()->name }}
      <a class="underline mx-2" href="{{ route('logout') }}">Logout</a>
    @else
    <a class="underline" href="{{ route('login') }}">Login</a>
    @endif
  </div>
  <div class="bg-white">
    <div class="max-w-7xl mx-auto py-16 px-4 overflow-hidden sm:py-24 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-5 lg:gap-x-8">

        @foreach ($nfts as $nft)
          <x-nft-card :nft="$nft" />
        @endforeach

      </div>
    </div>
  </div>

</body>

</html>
