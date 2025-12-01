@extends('layouts.dashboard.app')
@section('title' , 'المشرفين')
@section('css')

@endsection

@section('content')
    <!-- Admin Content Area -->
    <div class="lg:w-2/3 w-full bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">

        <section id="products-all" class="admin-section">

            {{-- search  --}}
            <div class="flex items-center justify-between p-4 bg-gray-100 border-b border-gray-200">
                <div class="flex items-center space-x-4 rtl:space-x-reverse">
                    <h1 class="text-2xl font-bold text-gray-800" data-lang-ar="جميع المشرفين" data-lang-en="All Admins">
                        جميع المشرفين
                    </h1>
                    @can('create.admin')
                    <button id="openAddProductModal"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2
                            flex items-center justify-center text-sm"
                    >

                        <svg class="h-4 w-4 ml-2 rtl:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        <a href="{{ route('admin.register') }}">إضافة مشرف جديد</a>
                    </button>
                    @endcan

                </div>
                <form action="{{ URL::Current() }}" method="get">
                    <div class="flex items-center space-x-2 rtl:space-x-reverse">
                            <input
                                type="search"
                                name="search"
                                id="productSearch"
                                placeholder="ابحث عن ما مشرف ..."
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
                            <th class="py-2 px-4 border-b border-gray-300 dark:border-gray-600"  style="text-align: center">الاسم</th>
                            <th class="py-2 px-4 border-b border-gray-300 dark:border-gray-600"  style="text-align: center">البريد الابكتروني</th>
                            <th class="py-2 px-4 border-b border-gray-300 dark:border-gray-600"  style="text-align: center">رقم التليفون</th>
                            <th class="py-2 px-4 border-b border-gray-300 dark:border-gray-600"  style="text-align: center">الدور</th>
                            <th class="py-2 px-4 border-b border-gray-300 dark:border-gray-600"  style="text-align: center">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody id="products-table-body" >
                        @forelse ($admins as $index => $admin)
                            <tr style="height: 40px;border-bottom:1px solid rgb(222, 219, 219)">
                                <td style="text-align: center">{{ ++ $index  }}</td>
                                <td style="text-align: center">{{ $admin->name }}</td>
                                <td style="text-align: center">{{ $admin->email }}</td>
                                <td style="text-align: center">{{ $admin->phone }}</td>
                                <td style="text-align: center">{{ $admin->role }}</td>
                                {{-- <td class="text-center">
                                    @php
                                        $statusClasses = [
                                            'active'       => 'bg-green-100 text-green-800', // لون أخضر للحالة المتاحة
                                            'draft' => 'bg-yellow-100 text-yellow-800', // لون أصفر للحالة قيد المعالجة
                                            'archived'       => 'bg-blue-100 text-blue-800',     // لون أزرق للحالة المعلقة
                                        ];
                                        $currentStatusClass = $statusClasses[$product->status] ?? $statusClasses['active'];
                                    @endphp

                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $currentStatusClass }}">
                                        {{ $product->status }}
                                    </span>
                                </td> --}}
                                <td style="text-align: center">
                                    <a href="{{ route('products.show' , $admin->id ) }}" class="edit-product-btn bg-green-500 text-white px-3 py-1 rounded-md text-sm hover:bg-green-600 transition-colors duration-200 ml-2 rtl:mr-2" data-lang-ar="إدارة" data-lang-en="Edit">إدارة</a>
                                    <button id="openModalBtnEdit" class="edit-product-btn bg-blue-500 text-white px-3 py-1 rounded-md text-sm hover:bg-blue-600 transition-colors duration-200 ml-2 rtl:mr-2" data-lang-ar="تعديل" data-lang-en="Edit">تعديل</button>
                                    <a href="{{ route('product.archived' , $admin->id ) }}" class="delete-product-btn bg-red-500 text-white px-3 py-1 rounded-md text-sm hover:bg-red-600 transition-colors duration-200" data-lang-ar="ارشيف" data-lang-en="Delete">ارشيف</a>
                                </td>
                            </tr>
                        @empty
                            <tr id="no-products-message" >
                                <td colspan="5" class="text-center py-5 text-gray-500">لا يوجد مشرفين حالياً.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table><br>
                  {{ $admins->links() }}
            </div>
        </section>

        {{-- @include('dashboard.products.create') --}}
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

