<div class="text-right p-3 text-gray-500 italic fixed z-10 top-1 right-1 -mt-1">
  @if (auth()->check())
    {{ auth()->user()->name }}
    <span class="mx-1 bg-gray-200 text-sm py-1 px-2 rounded-lg"> ${{ Auth::user()->account_balance }}</span>
    <a class="underline mx-2" href="{{ route('logout') }}">Logout</a>
  @else
    <a class="underline" href="{{ route('login') }}">Login</a>
  @endif

  <script>
    addEventListener('load', () => {
      window.handlePaymentEvent({{ auth()->id() }}, (event) => {
        toast('Payment received')
      })
    })
  </script>

</div>
