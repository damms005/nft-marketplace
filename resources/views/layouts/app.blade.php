<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  @livewireStyles

  <script src="{{ asset(mix('js/app.js')) }}"></script>
</head>

<body>
  <div>
    @yield('content')
  </div>
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
  @livewireScripts

  <x:notify-messages />
  @notifyJs

  <script>
    handlePaymentEvent({{ auth()->id() }}, (event) => {
      console.log(event)
      window.toast(JSON.stringify(event))
    })
  </script>

</body>

</html>
