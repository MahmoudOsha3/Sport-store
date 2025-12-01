@props([
    'id' => '',
    'title' => '' ,
    'price' => '' ,
    'description' => '' ,
    'image' => '' ,
    'rate' => '4.9',
])

<div class="flex-shrink-0 w-full sm:w-1/2 lg:w-1/3 xl:w-1/4 snap-start">
    <div class="bg-white rounded-lg shadow-md overflow-hidden transform hover:scale-105 transition-transform duration-300 dark:bg-gray-800">
        <div class="link-product">
            <a href="{{ route('product.show' , $id ) }}">
                <img src="products/{{ $image }}" alt="Sport Shorts" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-lg font-semibold mb-2" >{{ $title }}</h3>
                    <p class="text-gray-600 text-sm mb-2 dark:text-gray-400" >{{ $description }}</p>
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-xl font-bold text-indigo-600">{{ $price }} EG</span>
                        <div class="flex items-center">
                            <span class="text-yellow-500">⭐</span>
                            <span class="text-gray-600 text-sm ml-1 dark:text-gray-400">{{ $rate }}</span>
                        </div>
                    </div>
            </a>
        </div>
            {{-- <form action="{{ route('carts.store') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $id }}">
                <input type="hidden" name="quantity" value="1">
                <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700">
                    أضف إلى العربة
                </button>
            </form> --}}
        </div>
    </div>
</div>

