<div class="text-sm relative h-72">
  @if (auth()->user()->canBuy($nft))
    <form method="POST" action="{{ route('payment.show_transaction_details_for_user_confirmation') }}">
      @csrf
      <input type='hidden' name='currency' value='NGN' />
      <input type='hidden' name='amount' value='{{ $nft->price }}' />
      <input type='hidden' name='user_id' value='{{ auth()->id() }}' />
      <input type='hidden' name='transaction_description' value='Payment for NFT: {{ $nft->name }}' />
      <input type='hidden' name='metadata' value='@json($nft->paymentMetadata())' />
      <input type='hidden' name='payment_processor' value='Paystack' />

      <button type="submit"
              class="absolute top-1 right-1 inline-flex items-center px-2.5 py-1 border text-xs font-medium rounded-full shadow-sm text-blue-500 bg-white hover:bg-gray-50 hover:text-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-400">
        buy
      </button>
    </form>
  @endif

  <div class="w-full aspect-w-1 aspect-h-1 rounded-lg overflow-hidden bg-gray-100 group-hover:opacity-75 h-full">
    <img src="{{ $nft->image_url }}" alt="{{ $nft->name }}" class="object-cover" />
  </div>

  <div class="absolute bottom-0 w-full p-3 opacity-90">
    <div class="bg-white rounded-lg shadow-lg p-2 bg-gradient-to-r from-cyan-200 to-red-200 bg-opacity-5 overflow-ellipsis overflow-hidden">
      <h3 class="italic font-medium text-gray-700">{{ $nft->name }}</h3>
      <div class="text-indigo-500 my-1 flex flex-nowrap relative">
        <x-heroicon-s-user class="block mt-[1px] absolute my-1 w-4 h-4 " />
        <div class="ml-5"> {{ $nft->current_owner->name }} </div>
      </div>
      <p class="mt-2 font-medium text-gray-900">${{ $nft->price }}</p>
    </div>
  </div>

  <script>
    addEventListener('load', () => {
      window.Echo.channel('nft-{{ $nft->id }}-purchase')
        .listen('NftPurchase', (event) => {
          toast(`New sale: ${event.nft.name}`)
        })
    })
  </script>
</div>
