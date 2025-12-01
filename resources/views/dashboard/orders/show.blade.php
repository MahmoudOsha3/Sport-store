@extends('layouts.dashboard.app')

@section('title', 'تفاصيل الطلب #' . $order->number_order)

@section('css')
    <style>
        .status-badge {
            @apply px-3 py-1 rounded-full text-sm font-semibold;
        }
    </style>
@endsection

@section('content')
<div class="max-w-6xl mx-5 mt-3 bg-white shadow-xl rounded-2xl p-8" style="margin: 5px;
  display: block;">
    {{-- عنوان الصفحة --}}
    <div class="text-center mb-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-2">
            🛍️ تفاصيل الطلب رقم <span class="text-indigo-600">#{{ $order->number_order }}</span>
        </h2>
        <p class="text-gray-500">تاريخ الإنشاء: {{ $order->created_at->format('Y-m-d H:i') }}</p>
    </div>

    {{-- تفاصيل الطلب --}}
    <div class="bg-gray-50 border border-gray-200 rounded-xl p-6 mb-8">
        <h3 class="text-xl font-semibold text-gray-700 mb-4 flex items-center gap-2">
            <i class="fa-solid fa-receipt text-indigo-500"></i> بيانات الطلب
        </h3>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-gray-700">
            <p><i class="fa-solid fa-hashtag text-gray-500"></i> <strong>رقم الطلب:</strong> {{ $order->number_order }}</p>
            <p><i class="fa-solid fa-circle-info text-gray-500"></i> <strong>الحالة:</strong>
                <span class="status-badge
                    @if($order->status == 'pending') bg-yellow-100 text-yellow-700
                    @elseif($order->status == 'completed') bg-green-100 text-green-700
                    @elseif($order->status == 'cancelled') bg-red-100 text-red-700
                    @endif">
                    {{ ucfirst($order->status) }}
                </span>
            </p>
            <p><i class="fa-solid fa-user text-gray-500"></i> <strong>اسم العميل:</strong> {{ $order->user->name ?? 'غير محدد' }}</p>
            <p><i class="fa-solid fa-phone text-gray-500"></i> <strong>الهاتف:</strong> {{ $order->user->phone ?? '-' }}</p>
            <p><i class="fa-solid fa-city text-gray-500"></i> <strong>الدولة:</strong> {{ $order->user->country ?? 'مصر' }}</p>
            <p><i class="fa-solid fa-envelope text-gray-500"></i> <strong>الإيميل:</strong> {{ $order->user->email ?? '-' }}</p>
        </div>
    </div>

    {{-- المنتجات داخل الطلب --}}
    <div class="border-t pt-6">
        <h3 class="text-xl font-semibold text-gray-700 mb-4 flex items-center gap-2">
            <i class="fa-solid fa-boxes-stacked text-indigo-500"></i> المنتجات في الطلب
        </h3>

        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 rounded-xl overflow-hidden shadow-sm">
                <thead class="bg-indigo-50 text-indigo-700 text-sm uppercase tracking-wide">
                    <tr>
                        <th class="py-3 px-4 text-center border-b">الصورة</th>
                        <th class="py-3 px-4 text-center border-b">المنتج</th>
                        <th class="py-3 px-4 text-center border-b">الكمية</th>
                        <th class="py-3 px-4 text-center border-b">السعر</th>
                        <th class="py-3 px-4 text-center border-b">الإجمالي</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach ($order->orderItems as $item)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="py-3 px-4 border-b">
                            <img src="{{ asset('products/' . $item->product->image) }}"
                                 alt="Product"
                                 class="w-16 h-16 object-cover rounded-lg mx-auto shadow-sm">
                        </td>
                        <td class="py-3 px-4 border-b font-medium">
                            {{ $item->product->title ?? 'منتج محذوف' }}
                        </td>
                        <td class="py-3 px-4 border-b">{{ $item->quantity }}</td>
                        <td class="py-3 px-4 border-b">{{ number_format($item->price, 2) }} ج.م</td>
                        <td class="py-3 px-4 border-b font-semibold text-green-600">
                            {{ number_format($item->quantity * $item->price, 2) }} ج.م
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- الإجمالي الكلي --}}
{{-- الإجمالي الكلي مع الخصم --}}
<div class="mt-8 flex justify-end">
    <div class="bg-indigo-50 border border-indigo-100 rounded-xl px-6 py-4 text-right shadow-sm space-y-2">
        @if($order->couponUsage)
        
        <p class="text-gray-700 font-medium">
            الإجمالي قبل الخصم:
            <span class="text-gray-900 font-semibold">
                {{ number_format($order->couponUsage->total_order_before_discound , 2) }} ج.م
            </span>
        </p>

            <p class="text-red-600 font-semibold">
                قيمة الخصم: -{{ number_format($order->couponUsage->value_discound , 2) }} ج.م
            </p>
            <p class="text-indigo-600 font-medium">
                كوبون مستخدم: {{ $order->couponUsage->coupon->code ?? '-' }}
            </p>
        @endif

        <div class="border-t border-indigo-100 my-2"></div>

        <p class="text-xl font-bold text-green-600">
            الإجمالي  :
            <span class="text-green-700">{{ number_format($order->total_price , 2) }} ج.م</span>
        </p>
    </div>
</div>

</div>
@endsection

@section('js')
@endsection
