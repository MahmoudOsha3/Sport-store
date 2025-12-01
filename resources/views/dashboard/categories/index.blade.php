@extends('layouts.dashboard.app')
@section('title' , 'الاقسام')
@section('css')

@endsection

@section('content')

    <!-- Admin Content Area -->
    <div class="lg:w-2/3 w-full bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">

        <section id="products-all" class="admin-section">

            <h2 class="text-2xl font-bold mb-6 text-gray-900 dark:text-gray-100" data-lang-ar="جميع المنتجات" data-lang-en="All Products">جميع الاقسام</h2>
            <button id="openModalBtn" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    إضافة قسم
            </button>
            <div class="overflow-x-auto" style="padding:10px">
                <table class="min-w-full bg-white dark:bg-gray-800 rounded-lg shadow-sm">
                    <thead>
                        <tr class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 text-right">
                            <th class="py-2 px-4 border-b border-gray-300 dark:border-gray-600" data-lang-ar="الاسم" data-lang-en="Name" style="text-align: center">الاسم</th>
                            <th class="py-2 px-4 border-b border-gray-300 dark:border-gray-600" data-lang-ar="الإجراءات" data-lang-en="Actions" style="text-align: center">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody id="products-table-body" >
                        @forelse ($categories as $category)
                            <tr style="height: 40px;border-bottom:1px solid rgb(222, 219, 219)">
                                <td style="text-align: center">{{ $category->name }}</td>
                                <td style="text-align: center">
                                    <button id="openModalBtnEdit" class="edit-product-btn bg-blue-500 text-white px-3 py-1 rounded-md text-sm hover:bg-blue-600 transition-colors duration-200 ml-2 rtl:mr-2" data-lang-ar="تعديل" data-lang-en="Edit">تعديل</button>
                                    <button class="delete-product-btn bg-red-500 text-white px-3 py-1 rounded-md text-sm hover:bg-red-600 transition-colors duration-200" data-lang-ar="حذف" data-lang-en="Delete">حذف</button>
                                </td>
                                @include('dashboard.categories.edit')
                            </tr>
                        @empty
                            <tr id="no-products-message">
                                <td colspan="4" class="text-center py-4 text-gray-500" data-lang-ar="لا توجد منتجات حالياً." data-lang-en="No products available.">لا توجد منتجات حالياً.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        <div id="myModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
            <div class="bg-white rounded-lg shadow-xl w-11/12 md:w-1/2 lg:w-1/3 p-6 relative">
                <button id="closeModalBtn" class="absolute top-3 left-3 text-gray-500 hover:text-gray-700 text-2xl font-bold">
                    &times;
                </button>

                <h2 class="text-2xl font-semibold mb-4 text-gray-800">إضافة قسم جديد</h2>

                <form action="{{ route('categories.store') }}" method="post">
                    @csrf
                    <div class="mb-4">
                        <label for="sectionName" class="block text-gray-700 text-sm font-bold mb-2">اسم القسم:</label>
                        <input type="text" id="sectionName" name="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="أدخل اسم القسم">
                    </div>
                    <div class="flex items-center justify-between">
                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            حفظ القسم
                        </button>
                        <button type="button" id="cancelFormBtn" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            إلغاء
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')


@endsection

