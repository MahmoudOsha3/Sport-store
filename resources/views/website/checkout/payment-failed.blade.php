@extends('layouts.website.app')

@section('title', 'Payment Failed')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 px-4">
    <div class="bg-white shadow-lg rounded-2xl p-10 max-w-md w-full text-center">

        <!-- أيقونة فشل -->
        <div class="flex justify-center mb-6">
            <svg class="w-20 h-20 text-red-500" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2M12 2a10 10 0 1 0 0 20a10 10 0 0 0 0-20z"></path>
            </svg>
        </div>

        <!-- الرسالة -->
        <h2 class="text-2xl font-bold text-gray-800 mb-2">فشل الدفع ❌</h2>
        <p class="text-gray-600 mb-4">عذراً، لم تتم عملية الدفع. حدث خطأ أثناء معالجة الدفع أو تم إلغاء المعاملة.</p>

        <!-- أسباب مقترحة (اختياري) -->
        <ul class="text-sm text-gray-500 mb-6 space-y-1">
            <li>• تأكد من معلومات البطاقة أو وسيلة الدفع.</li>
            <li>• تأكد من رصيد حسابك أو صلاحية البطاقة.</li>
            <li>• حاول المحاولة مرة أخرى أو استخدم وسيلة دفع أخرى.</li>
        </ul>

        <div class="flex justify-center gap-3">
            <!-- الذهاب للطلبات -->
            <a href="{{ route('order.index') }}"
               class="inline-block border border-gray-300 hover:bg-gray-50 text-gray-700 font-semibold py-2 px-4 rounded-lg transition duration-200">
               عرض الطلبات
            </a>
        </div>
    </div>
</div>
@endsection
