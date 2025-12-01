@extends('layouts.website.app')

@section('title', 'طلباتي')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-6">
        📦 طلباتي
    </h2>

    @forelse ($orders as $order)
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md p-5 mb-6 hover:shadow-lg transition-all duration-300">

            <!-- رأس الطلب -->
            <div class="flex flex-wrap justify-between items-center border-b border-gray-200 dark:border-gray-700 pb-3 mb-3">
                <div>
                    <h3 class="font-semibold text-gray-800 dark:text-gray-100">
                        رقم الطلب: <span class="text-indigo-600">#{{ $order->number_order }}</span>
                    </h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        تاريخ الطلب: {{ $order->created_at->format('Y-m-d H:i') }}
                    </p>
                </div>

                <div class="flex flex-wrap gap-3 mt-2 sm:mt-0">
                    <span class="px-3 py-1 rounded-full text-sm font-medium
                        @if($order->status == 'pending') bg-yellow-100 text-yellow-700 dark:bg-yellow-800 dark:text-yellow-200
                        @elseif($order->status == 'processing') bg-blue-100 text-green-700 dark:bg-green-800 dark:text-green-200
                        @elseif($order->status == 'completed') bg-green-100 text-green-700 dark:bg-green-800 dark:text-green-200
                        @elseif($order->status == 'cancelled') bg-red-100 text-red-700 dark:bg-red-800 dark:text-red-200
                        @endif">
                        حالة الطلب: {{ __($order->status) }}
                    </span>

                    <span class="px-3 py-1 rounded-full text-sm font-medium
                        @if($order->payment_status == 'paid') bg-green-100 text-green-700 dark:bg-green-800 dark:text-green-200
                        @else bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-200
                        @endif">
                        الدفع: {{$order->payment_status }}
                    </span>
                </div>
            </div>

            <!-- قائمة المنتجات -->
            <div class="space-y-4">
                @foreach ($order->orderItems as $item)
                    <div class="flex items-center gap-4 border-b border-gray-100 dark:border-gray-700 pb-3 last:border-none">
                        <img src="/products/{{ $item->product->image }}"
                             alt="{{ $item->product->title }}"
                             class="w-20 h-20 rounded-lg object-cover shadow-sm">

                        <div class="flex-1 min-w-0">
                            <h4 class="font-medium text-gray-800 dark:text-gray-100 truncate">
                                {{ $item->product->title }}
                            </h4>
                            <div class="details" style="display: flex;gap:25px">
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                الكمية: {{ $item->quantity }}
                                </p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    اللون : {{ $item->options['color'] }}
                                </p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    المقاس : {{ $item->options['size'] }}
                                </p>
                            </div>

                        </div>

                        <div class="text-right">
                            <p class="text-gray-800 dark:text-gray-100 font-semibold">
                                {{ number_format($item->price * $item->quantity) }} EGP
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- إجمالي الطلب -->
            <div class="mt-6 border-t border-gray-200 dark:border-gray-700 pt-4">
                @if ($order->couponUsage)
                <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-3">💰 تفاصيل المجموع</h4>
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between text-gray-600 dark:text-gray-400">
                        <span>الإجمالي قبل الخصم:</span>
                        <span>{{ number_format($order->couponUsage ? $order->couponUsage->total_order_before_discound : $order->total_price) }} ج.م</span>
                    </div>

                    @if ($order->couponUsage)
                        <div class="flex justify-between text-gray-600 dark:text-gray-400">
                            <span>قيمة الخصم:</span>
                            <span class="text-red-600 dark:text-red-400 font-semibold">
                                -{{ number_format($order->couponUsage->value_discound) }} ج.م
                            </span>
                        </div>
                        <div class="flex justify-between text-gray-600 dark:text-gray-400">
                            <span>كود الكوبون:</span>
                            <span class="font-medium text-indigo-600 dark:text-indigo-400">
                                {{ $order->couponUsage->coupon->code ?? 'غير متاح' }}
                            </span>
                        </div>
                    @endif
                </div>
                <div class="border-t border-gray-300 dark:border-gray-600 my-3"></div>
                @endif



                <div class="flex justify-between items-center">
                    <span class="text-lg font-bold text-gray-900 dark:text-gray-100">الإجمالي:</span>
                    <span class="text-xl font-extrabold text-green-600 dark:text-green-400">
                        {{ number_format($order->total_price) }} ج.م
                    </span>
                </div>
            </div>

            <!-- أزرار -->
            <div class="mt-4 flex justify-end gap-3">
                @if($order->status == 'pending' && $order->payment_status != 'paid')
                <form action="{{ route('order.cancelled' , $order->id ) }}" method="post">
                    @csrf
                    <button class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition" type="submit">الغاء الطلب</button>
                </form>
                    <form action="{{ route('payment' , $order->id ) }}" method="post">
                        @csrf

                        <button type="submit"
                                class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition">
                            إتمام الدفع
                        </button>
                    </form>

                @endif
            </div>
        </div>

        <div id="paymentModal-{{ $order->id }}"
            class="fixed inset-0 flex items-center justify-center bg-black/50 z-50 hidden">

        <!-- المحتوى -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl w-[90%] sm:w-[400px] p-6 relative animate-fadeIn">

            <!-- زر الإغلاق -->
            <button onclick="closePaymentModal({{ $order->id }})"
                    class="absolute top-3 right-3 text-gray-500 hover:text-gray-700 dark:text-gray-300 dark:hover:text-white">
            ✕
            </button>

            <h2 class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-4 text-center">معلومات الدفع</h2>

            <form action="#" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">الاسم</label>
                    <input type="text" name="name" required
                        class="w-full p-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">العنوان</label>
                    <input type="text" name="address" required
                        class="w-full p-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">رقم الهاتف</label>
                    <input type="text" name="phone" required
                        class="w-full p-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500">
                </div>

                <button type="submit"
                        class="w-full bg-green-600 hover:bg-green-700 text-white py-2 rounded-md transition">
                    تأكيد الدفع
                </button>
            </form>
        </div>
</div>

    @empty
        <div class="text-center text-gray-500 dark:text-gray-400 py-12 bg-white dark:bg-gray-800 rounded-2xl shadow">
            😔 لم تقم بأي طلب حتى الآن.
        </div>
    @endforelse
</div>



@endsection

@section('js')
<script>
    function openPaymentModal(orderId) {
        document.getElementById(`paymentModal-${orderId}`).classList.remove('hidden');
    }

    function closePaymentModal(orderId) {
        document.getElementById(`paymentModal-${orderId}`).classList.add('hidden');
    }
</script>

@endsection
