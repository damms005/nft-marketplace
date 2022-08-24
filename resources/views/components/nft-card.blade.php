<div class="text-sm relative h-72">
  @if (auth()->id() != $nft->current_owner->id)
    <button type="button"
            class="absolute top-1 right-1 inline-flex items-center px-2.5 py-1 border border-transparent text-xs font-medium rounded-full shadow-sm text-white bg-indigo-500 hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-400">
      buy
    </button>
  @endif

  <div class="w-full aspect-w-1 aspect-h-1 rounded-lg overflow-hidden bg-gray-100 group-hover:opacity-75 h-full">
    <img src="{{ $nft->image_url }}" alt="{{ $nft->name }}" class="object-cover" />
  </div>

  <div class="absolute bottom-0 w-full p-3">
    <div class="bg-white rounded-lg shadow-lg p-2 bg-gradient-to-r from-cyan-200 to-red-200 bg-opacity-5">
      <h3 class="italic font-medium text-gray-700">{{ $nft->name }}</h3>
      <div class="text-indigo-500 my-1 flex flex-nowrap relative">
        <x-heroicon-s-user class="block mt-[1px] absolute my-1 w-4 h-4 " />
        <div class="ml-5"> {{ $nft->current_owner->name }} </div>
      </div>
      <p class="mt-2 font-medium text-gray-900">${{ $nft->price }}</p>
    </div>
  </div>
</div>
