@extends('layouts.website.app')

@section('title', 'عربة التسوق')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">🛒 عربة التسوق</h2>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- المنتجات --}}
        <div class="lg:col-span-2 space-y-4">
            @forelse ($carts as $cart)
                <div class="flex flex-col sm:flex-row items-center justify-between bg-white dark:bg-gray-800 rounded-lg shadow-md p-4 transition hover:shadow-lg">

                    {{-- صورة المنتج --}}
                    <div class="w-full sm:w-24 h-24 flex-shrink-0 mb-3 sm:mb-0">
                        <img src="{{ asset('products/' . $cart->product->image) }}"
                             alt="{{ $cart->product->title }}"
                             class="w-full h-full object-cover rounded-md">
                    </div>

                    {{-- تفاصيل المنتج --}}
                    <div class="flex-1 sm:ml-6 text-center sm:text-right">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">{{ $cart->product->title }}</h3>
                        <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">
                            {{ Str::limit($cart->product->description, 60) }}
                        </p>
                        <p class="mt-2 text-blue-600 dark:text-blue-400 font-semibold">
                            {{ number_format($cart->variant->price, 2) }} ج.م
                            <span style="background-color: rgb(237, 237, 237);padding:5px;border-radius:20px;color:black">اللون : {{ $cart->variant->color }}</span>
                             <span style="background-color: rgb(237, 237, 237);padding:5px;border-radius:20px;color:black">المقاس : {{ $cart->variant->size }}</span>
                        </p>
                    </div>

                    {{-- التحكم في الكمية --}}
                    <div class="flex items-center space-x-2 sm:space-x-0 sm:space-y-2 sm:flex-col mt-3 sm:mt-0">
                        <form action="#" method="POST" class="flex items-center">
                            @csrf
                            @method('PUT')
                            <button type="submit" name="action" value="decrease"
                                class="bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 rounded-full px-2 py-1 text-gray-800 dark:text-gray-100">−</button>
                            <input type="text" name="quantity" readonly
                                value="{{ $cart->quantity }}"
                                class="w-10 text-center mx-2 border border-gray-300 dark:border-gray-600 rounded-md bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-gray-100 text-sm">
                            <button type="submit" name="action" value="increase"
                                class="bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 rounded-full px-2 py-1 text-gray-800 dark:text-gray-100">+</button>
                        </form>

                        {{-- زر الحذف --}}
                        <form action="{{route('cart.delete')}}" method="POST"
                              onsubmit="return confirm('هل أنت متأكد من حذف هذا المنتج؟')"
                              class="sm:mt-2">
                            @csrf
                            <input type="hidden" name="cart_id" value="{{ $cart->id }}">
                            <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-semibold">
                                حذف
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 text-center">
                    <p class="text-gray-600 dark:text-gray-300 text-lg">🛍️ السلة فارغة حالياً.</p>
                </div>
            @endforelse
        </div>

        {{-- ملخص الطلب --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 h-fit">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4">ملخص الطلب</h3>

            <div class="flex justify-between text-gray-700 dark:text-gray-300 mb-2">
                <span>عدد المنتجات:</span>
                <span>{{ $carts->count() }}</span>
            </div>
            <div class="flex justify-between text-gray-700 dark:text-gray-300 mb-2">
                <span>الإجمالي:</span>
                <span>{{ number_format($total, 2) }} ج.م</span>
            </div>
            <div class="flex justify-between text-gray-700 dark:text-gray-300 mb-4">
                <span>الشحن:</span>
                <span>مجاني 🚚</span>

            </div>

            <div class="border-t border-gray-300 dark:border-gray-600 my-3"></div>

            <div class="border-t border-gray-300 dark:border-gray-600 my-4 pt-4">
                <form action="{{ route('order.store') }}" method="POST" class="space-y-3">
                    @csrf
                    <label for="coupon_code" class="block text-gray-700 dark:text-gray-300 font-semibold">🎟️ أضف كود الخصم</label>
                    <div class="flex">
                        <input type="text" id="coupon_code" name="coupon_code" placeholder="أدخل كود الكوبون"
                            class="flex-1 border border-gray-300 dark:border-gray-700 rounded-l-md px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none dark:bg-gray-700 dark:text-white"
                            value="{{ old('coupon_code') }}">
                    </div>
            </div>

                    <div class="border-t border-gray-300 dark:border-gray-600 my-3"></div>

                    <button type="submit" class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center font-semibold py-2 rounded-md transition"> إتمام الطلب</button>
                </form>
        </div>
    </div>
</div>
@endsection
