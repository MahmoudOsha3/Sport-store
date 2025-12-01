@extends('layouts.dashboard.app')
@section('title' , ' المنتجات المؤرشفة')
@section('css')

@endsection

@section('content')
    <!-- Admin Content Area -->
    <div class="lg:w-2/3 w-full bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">

        <section id="products-all" class="admin-section">

            {{-- search  --}}
            <div class="flex items-center justify-between p-4 bg-gray-100 border-b border-gray-200">
                <div class="flex items-center space-x-4 rtl:space-x-reverse">
                    <h1 class="text-2xl font-bold text-gray-800" >
                        جميع المنتجات المؤرشفة
                    </h1>
                </div>
                <form action="{{ URL::Current() }}" method="get">
                    <div class="flex items-center space-x-2 rtl:space-x-reverse">
                            <input
                                type="search"
                                name="search"
                                id="productSearch"
                                placeholder="ابحث عن ما تريد ..."
                                class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent
                                    text-gray-900 placeholder-gray-500 text-sm w-64" value="{{ request('search') }}"
                            >
                            <button
                                type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2
                                    flex items-center justify-center"
                            >
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                <span class="ml-2">بحث</span>
                            </button>
                    </div>
                </form>
            </div>

            {{-- tabel --}}
            <div class="overflow-x-auto" style="padding:10px">
                <table class="min-w-full bg-white dark:bg-gray-800 rounded-lg shadow-sm">
                    <thead>
                        <tr class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 text-right">
                            <th class="py-2 px-4 border-b border-gray-300 dark:border-gray-600"  style="text-align: center">#</th>
                            <th class="py-2 px-4 border-b border-gray-300 dark:border-gray-600"  style="text-align: center">المنتج</th>
                            <th class="py-2 px-4 border-b border-gray-300 dark:border-gray-600"  style="text-align: center">السعر</th>
                            <th class="py-2 px-4 border-b border-gray-300 dark:border-gray-600"  style="text-align: center">رقم التحققي</th>
                            <th class="py-2 px-4 border-b border-gray-300 dark:border-gray-600"  style="text-align: center">التقيم</th>
                            <th class="py-2 px-4 border-b border-gray-300 dark:border-gray-600"  style="text-align: center">حالة</th>
                            <th class="py-2 px-4 border-b border-gray-300 dark:border-gray-600"  style="text-align: center">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody id="products-table-body" >
                        @forelse ($products as $index => $product)
                            <tr style="height: 40px;border-bottom:1px solid rgb(222, 219, 219)">
                                <td style="text-align: center">{{ ++ $index  }}</td>
                                <td style="text-align: center">{{ $product->title }}</td>
                                <td style="text-align: center">{{ $product->price }}</td>
                                <td style="text-align: center">{{ $product->sku }}</td>
                                <td style="text-align: center">{{ $product->rate }}</td>
                                <td class="text-center">

                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-green-800">
                                        {{ $product->status }}
                                    </span>
                                </td>
                                <td style="text-align: center">
                                    <a href="{{ route('product.restore', $product->id ) }}" id="openModalBtnEdit" class="edit-product-btn bg-green-500 text-white px-3 py-1 rounded-md text-sm hover:bg-green-600 transition-colors duration-200 ml-2 rtl:mr-2" >إستراجع المنتج</a>
                                    <a href="{{ route('products.destroy', $product->id ) }}" id="openModalBtnEdit" class="edit-product-btn bg-red-500 text-white px-3 py-1 rounded-md text-sm hover:bg-green-600 transition-colors duration-200 ml-2 rtl:mr-2" >حذف دائم</a>

                                </td>

                            </tr>
                        @empty
                            <tr id="no-products-message" >
                                <td colspan="5" class="text-center py-5 text-gray-500">لا توجد منتجات حالياً.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table><br>
                  {{ $products->links() }}
            </div>
        </section>
    </div>
@endsection

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const openModalButton = document.getElementById('openAddProductModal');
        const closeModalButton = document.getElementById('closeAddProductModal');
        const cancelAddButton = document.getElementById('cancel-add-product'); // الزر الجديد للإلغاء داخل الفورم
        const addProductModal = document.getElementById('addProductModal');

        // Show modal when 'إضافة منتج جديد' button is clicked
        openModalButton.addEventListener('click', function () {
            addProductModal.classList.remove('hidden');
            addProductModal.classList.add('flex'); // For flex centering
        });

        // Hide modal when close button is clicked
        closeModalButton.addEventListener('click', function () {
            addProductModal.classList.add('hidden');
            addProductModal.classList.remove('flex');
        });

        // Hide modal when cancel button inside form is clicked
        cancelAddButton.addEventListener('click', function () {
            addProductModal.classList.add('hidden');
            addProductModal.classList.remove('flex');
            // optionally, you might want to reset the form here
            // document.getElementById('product-form').reset();
        });

        // Optional: Hide modal when clicking outside the modal content
        addProductModal.addEventListener('click', function (event) {
            if (event.target === addProductModal) {
                addProductModal.classList.add('hidden');
                addProductModal.classList.remove('flex');
            }
        });
    });
</script>
@endsection

