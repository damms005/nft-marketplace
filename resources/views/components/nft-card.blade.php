<a href="#" class="group text-sm">
  <div class="w-full aspect-w-1 aspect-h-1 rounded-lg overflow-hidden bg-gray-100 group-hover:opacity-75">
    <img src="{{ $nft->image_url }}" alt="{{ $nft->name }}" class="w-full h-full object-center object-cover" />
  </div>
  <h3 class="mt-4 font-medium text-gray-900">{{ $nft->name }}</h3>
  <p class="text-gray-500 italic">
    <x-user class="w-6 h-6" /> {{ $nft->current_owner->name }}
  </p>
  <p class="mt-2 font-medium text-gray-900">${{ $nft->price }}</p>
</a>
