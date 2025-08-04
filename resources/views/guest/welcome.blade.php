<x-guest.header>
  <div class="mt-8">
    <h2 class="text-xl font-semibold text-pam-blue mb-6">Related Products</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      @foreach ($products as $product)
        <div class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition">
          <div class="relative">
            @if($product->images)
              @php
                $images = json_decode($product->images);
                $firstImage = $images[0] ?? null;
              @endphp
              @if($firstImage)
                <img src="{{ asset('storage/'.$firstImage) }}" alt="Product image" class="w-full h-48 object-cover">
              @else
                <img src="https://via.placeholder.com/80" alt="Product image" class="h-full w-full object-cover">
              @endif
            @else
              <img src="https://via.placeholder.com/80" alt="Product image" class="h-full w-full object-cover">
            @endif
            <div class="absolute top-2 right-2">
              <button class="like-btn bg-white rounded-full p-2 shadow-md hover:bg-pam-gray-light" aria-label="Like this item">
                <i class="far fa-heart text-pam-gray"></i>
              </button>
            </div>
          </div>
          <div class="p-4">
            <h3 class="font-semibold text-lg text-pam-blue mb-1">{{ $product->name }}</h3>
            <p class="text-pam-gray text-sm mb-2">{{ $product->description }}</p>
            <div class="mt-3 flex justify-between items-center">
              <span class="font-bold text-pam-blue">GH₵{{ $product->price }}</span>
              <a href="{{ route('products.show', $product->id) }}" class="text-pam-blue-light hover:text-pam-blue text-sm font-medium">View Details →</a>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</x-guest.header>