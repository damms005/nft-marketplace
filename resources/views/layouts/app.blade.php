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

  @vite(['resources/css/app.css', 'resources/js/app.js'])
  @livewireStyles
</head>

<body>
  <div>
    @yield('content')
  </div>
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

  @livewireScripts

  @livewire('notifications')

  @filamentScripts

  <script>
    addEventListener('load', () => {
      handlePaymentEvent({{ auth()->id() }}, (event) => {
        console.log(event)
        toast(JSON.stringify(event))
      })
    })
  </script>

</body>

</html>
