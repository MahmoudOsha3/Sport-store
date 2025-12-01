@extends('layouts.website.app')

@section('title' ,'ميلانو | '. $product->title)

@section('content')
<main class="container mx-auto py-12 px-6 md:px-10">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 md:p-8 flex flex-col lg:flex-row gap-8">

        <!-- ✅ معرض الصور -->
        <div class="lg:w-1/2 w-full flex flex-col items-center">
            <img id="main-product-image"
                 src="{{ asset("products/$product->image") }}"
                 alt="{{ $product->title }}"
                 class="w-full h-auto rounded-lg shadow-lg object-cover mb-4">

            <div id="thumbnail-gallery" class="flex space-x-2 rtl:space-x-reverse overflow-x-auto no-scrollbar">
                {{-- @foreach ($product->images as $img)
                    <img src="{{ asset("products/$img->filename") }}"
                         class="w-20 h-20 object-cover rounded-md border border-gray-300 cursor-pointer hover:opacity-75 transition"
                         onclick="document.getElementById('main-product-image').src=this.src;">
                @endforeach --}}
            </div>
        </div>


        <!-- ✅ تفاصيل المنتج -->
        <div class="lg:w-1/2 w-full">
            <h1 class="text-3xl md:text-4xl font-bold mb-4 text-gray-900 dark:text-gray-100">{{ $product->title }}</h1>
            <p class="text-gray-700 dark:text-gray-300 mb-6">{{ $product->description }}</p>

            <div class="flex items-baseline mb-4">
                <span class="text-indigo-600 text-3xl font-bold mr-2 rtl:ml-2">{{ $product->price }} جنيه</span>
                @if($product->compare_price)
                    <span class="text-gray-500 line-through text-lg mr-2 rtl:ml-2">{{ $product->compare_price }} جنيه</span>
                @endif
                @if($product->discount_percentage)
                    <span class="bg-red-500 text-white text-sm font-semibold px-2 py-1 rounded-full">خصم {{ $product->discount_percentage }}%</span>
                @endif
            </div>

            <form action="{{ route('carts.store') }}" method="POST" id="add-to-cart-form">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="variant_id" id="selected_variant_id">

                <!-- ✅ اختيار اللون -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-3 text-gray-800">اختر اللون:</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($product->variants->groupBy('color') as $color => $variants)
                            <button type="button"
                                    data-color="{{ $color }}"
                                    class="color-btn border border-gray-300 rounded-full w-10 h-10 flex items-center justify-center hover:ring-2 hover:ring-indigo-400 transition"
                                    style="background-color: {{ $color }}">
                            </button>
                        @endforeach
                    </div>
                </div>

                <!-- ✅ اختيار المقاس -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-3 text-gray-800">اختر المقاس:</h3>
                    <div id="size-options" class="flex flex-wrap gap-3"></div>
                </div>

                @error('variant_id')
                    <div class="mt-2 flex items-center gap-2 bg-red-50 border border-red-200 text-red-700 text-sm px-3 py-2 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-500" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01M12 5a7 7 0 100 14 7 7 0 000-14z" />
                        </svg>
                        <span>{{ $message }}</span>
                    </div>
                @enderror

                @error('product_id')
                    <div class="mt-2 flex items-center gap-2 bg-red-50 border border-red-200 text-red-700 text-sm px-3 py-2 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-500" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01M12 5a7 7 0 100 14 7 7 0 000-14z" />
                        </svg>
                        <span>{{ $message }}</span>
                    </div>
                @enderror

                <br>
                <!-- ✅ الكمية -->
                <div class="mb-6 flex items-center">
                    <h3 class="text-lg font-semibold mr-4 rtl:ml-4">الكمية:</h3>
                    <button type="button" id="qty-decrease"
                            class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-full w-8 h-8 flex items-center justify-center text-lg font-bold">-</button>
                    <input type="number" name="quantity" id="product-quantity" value="1" min="1"
                           class="w-16 text-center mx-2 p-1 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-gray-100">
                    <button type="button" id="qty-increase"
                            class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-full w-8 h-8 flex items-center justify-center text-lg font-bold">+</button>
                </div>

                <button type="submit"
                        class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-3 rounded-md text-lg font-semibold transition">
                    أضف إلى العربة
                </button>
            </form>
        </div>
    </div>
</main>
@endsection

@section('js')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const allVariants = @json($product->variants);
    const colorButtons = document.querySelectorAll('.color-btn');
    const sizeContainer = document.getElementById('size-options');
    const variantInput = document.getElementById('selected_variant_id');

    // عند اختيار اللون
    colorButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const selectedColor = btn.dataset.color;

            // إزالة التحديد من باقي الأزرار
            colorButtons.forEach(b => b.classList.remove('ring-4', 'ring-indigo-500'));
            btn.classList.add('ring-4', 'ring-indigo-500');

            // تصفية المقاسات حسب اللون
            const sizes = allVariants.filter(v => v.color === selectedColor);
            sizeContainer.innerHTML = '';

            sizes.forEach(v => {
                const sizeBtn = document.createElement('button');
                sizeBtn.type = 'button';
                sizeBtn.textContent = v.size;
                sizeBtn.className = "size-btn px-4 py-2 border border-gray-300 rounded-md hover:bg-indigo-600 hover:text-white transition";

                sizeBtn.addEventListener('click', () => {
                    document.querySelectorAll('.size-btn').forEach(s => s.classList.remove('bg-indigo-600', 'text-white'));
                    sizeBtn.classList.add('bg-indigo-600', 'text-white');
                    variantInput.value = v.id;
                });
                sizeContainer.appendChild(sizeBtn);
            });
        });
    });

    // التحكم في الكمية
    document.getElementById('qty-increase').onclick = () => {
        const input = document.getElementById('product-quantity');
        input.value = parseInt(input.value) + 1;
    };
    document.getElementById('qty-decrease').onclick = () => {
        const input = document.getElementById('product-quantity');
        if (parseInt(input.value) > 1) input.value = parseInt(input.value) - 1;
    };
});

</script>
@endsection
