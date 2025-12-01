@extends('layouts.dashboard.app')
@section('title', 'Dashboard')
@section('css')

@endsection

@section('content')

    <!-- Admin Content Area -->
    <div class="lg:w-2/3 w-full bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
        <!-- Home Dashboard Section (formerly Dashboard Overview) -->
        <section id="home-dashboard" class="admin-section">
            <h2 class="text-2xl font-bold mb-6 text-gray-900 dark:text-gray-100" data-lang-ar="الرئيسية" data-lang-en="Home">
                الرئيسية</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-md shadow-sm">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200"> إجمالي المنتجات تم إضافتها في هذا الشهر</h3>
                    <p class="text-3xl font-bold text-indigo-600 mt-2" id="total-products-count">{{ $countNewProducts }}</p>
                </div>
                <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-md shadow-sm">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200"> إجمالي الطلبات في هذا الشهر</h3>
                    <p class="text-3xl font-bold text-indigo-600 mt-2" id="total-products-count">{{ $countNewOrders }}</p>
                </div>
                <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-md shadow-sm">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200" data-lang-ar="الطلبات المعلقة"
                        data-lang-en="Pending Orders">الطلبات المعلقة</h3>
                    <p class="text-3xl font-bold text-yellow-600 mt-2" id="pending-orders-count">
                        {{ $countOrdersNonCompleted }}</p>
                </div>
                <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-md shadow-sm">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200" data-lang-ar="إجمالي المستخدمين"
                        data-lang-en="Total Users">إجمالي المستخدمين</h3>
                    <p class="text-3xl font-bold text-green-600 mt-2" id="total-users-count">{{ $countUsers }}</p>
                </div>
                <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-md shadow-sm">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">إجمالي المبيعات في هذا الشهر</h3>
                    <p class="text-3xl font-bold text-teal-600 mt-2" id="total-sales-amount">
                        {{ number_format($totalBuyingInThisMonth) }} جنية</p>
                </div>
                <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-md shadow-sm">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200" data-lang-ar="المنتجات الأكثر مبيعاً"
                        data-lang-en="Top Selling Products">المنتجات الأكثر مبيعاً</h3>
                    <ul class="list-disc list-inside text-gray-600 dark:text-gray-300 mt-2">
                        @foreach ($productsMoreSales as $moreSales)
                            <li>
                                <a style="font-size: 12px;font-weight:bold" href="{{ route('products.show', $moreSales->product_id) }}">{{ $moreSales->product_name }}
                                    - (عدد البيع : {{ $moreSales->total }})</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </section>

    </div>
@endsection

@section('js')

@endsection
