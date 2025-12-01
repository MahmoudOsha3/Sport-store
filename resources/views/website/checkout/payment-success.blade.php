@extends('layouts.website.app')

@section('title', 'Payment Success')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 px-4">
    <div class="bg-white shadow-lg rounded-2xl p-10 max-w-md w-full text-center">

        <!-- أيقونة نجاح -->
        <div class="flex justify-center mb-6">
            <svg class="w-20 h-20 text-green-500" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9 12l2 2l4 -4m6 2a9 9 0 1 1 -18 0a9 9 0 0 1 18 0z"></path>
            </svg>
        </div>

        <!-- الرسالة -->
        <h2 class="text-2xl font-bold text-gray-800 mb-2">تم الدفع بنجاح 🎉</h2>
        <p class="text-gray-600 mb-6">طلبك الآن تحت المراجعة  .</p>

        <!-- زر العودة -->
        <a href="{{ route('order.index') }}"
           class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-6 rounded-lg transition duration-200">
           عرض الطلبات
        </a>
    </div>
</div>
@endsection
