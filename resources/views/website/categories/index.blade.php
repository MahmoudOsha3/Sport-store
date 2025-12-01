@extends('layouts.website.app')

@section('title', $category->name . ' - المنتجات')

@section('content')
<div class="min-h-screen bg-gray-100 py-12 px-6">
    <div class="max-w-7xl mx-auto">

        <!-- عنوان الصفحة -->
        <div class="text-center mb-10">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $category->name }}</h1>
            {{-- <p class="text-gray-500">اكتشف أجمل المنتجات والاندية ضمن هذا التصنيف</p> --}}
        </div>

        <!-- عرض المنتجات -->
        @if($products->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach ($products as $product)
                    <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition duration-300 overflow-hidden group">
                        <!-- صورة المنتج -->
                        <div class="relative">
                            <img src="{{ asset('products/' . $product->image) }}"
                                 alt="{{ $product->title }}"
                                 class="w-full h-56 object-cover group-hover:scale-105 transition duration-300">
                        </div>

                        <!-- تفاصيل المنتج -->
                        <div class="p-5 text-right">
                            <h3 class="text-lg font-semibold text-gray-800 truncate mb-2">
                                {{ $product->title }}
                            </h3>
                            <p class="text-gray-500 text-sm mb-3 line-clamp-2">
                                {{ Str::limit($product->description, 60) }}
                            </p>
                            <div class="flex items-center justify-between">
                                <span class="text-lg font-bold text-indigo-600">
                                    {{ number_format($product->price) }} EGP
                                </span>
                                <a href="{{ route('product.show', $product->id) }}"
                                   class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold px-4 py-2 rounded-lg transition duration-200">
                                   عرض التفاصيل
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- ترقيم الصفحات -->
            <div class="mt-10">
                {{ $products->links() }}
            </div>
        @else
            <div class="text-center bg-white py-10 rounded-xl shadow-sm">
                <p class="text-gray-600 text-lg">لا توجد منتجات متاحة في هذا التصنيف حالياً.</p>
            </div>
        @endif
    </div>
</div>
@endsection
