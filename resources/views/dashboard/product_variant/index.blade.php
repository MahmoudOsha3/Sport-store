@extends('layouts.dashboard.app')

@section('title', 'إضافة خصائص المنتج')

@section('content')
    <div class="container mx-auto p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg">
        <div class="container mx-auto p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg">
            <!-- Section 1: Product Main Properties (خصائص المنتج الرئيسية) -->
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">تفاصيل المنتج الأساسية</h2>
                <!-- الاسم والسعر الأساسي جنبًا إلى جنب في صف واحد -->
                <div
                    class="flex items-center justify-start space-x-8 rtl:space-x-reverse bg-gray-50 dark:bg-gray-700 p-4 rounded-md shadow-sm mb-6">
                    <div class="flex items-center space-x-2 rtl:space-x-reverse">
                        <span
                            class="text-lg font-medium text-gray-700 dark:text-gray-300"><img src="{{ asset('products/' . $product->image) }}" width="100px" height="100px" alt=""></span>
                        <span
                            class="text-lg font-medium text-gray-700 dark:text-gray-300">المنتج :</span> <span
                            class="text-lg text-gray-900 dark:text-gray-100">{{ $product->title }}</span>
                        </div>
                    <div class="flex items-center space-x-2 rtl:space-x-reverse"> <span
                            class="text-lg font-medium text-gray-700 dark:text-gray-300">السعر :</span> <span
                            class="text-lg text-gray-900 dark:text-gray-100">{{ $product->price }}</span> </div>
                </div> <!-- جدول الخصائص الإضافية (مثل الوصف العام للمنتج) -->
<div class="bg-gray-50 dark:bg-gray-700 rounded-md p-4 mt-6">
    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-3">خصائص المنتج</h3>

    @forelse ($product->variants as $variant)
        <div class="border border-gray-300 dark:border-gray-600 rounded-lg p-4 mb-4 bg-white dark:bg-gray-800 shadow-sm">
            <div class="flex justify-between items-start">
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 w-full">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">اللون: </p>
                        <p class="font-medium text-gray-900 dark:text-gray-100">{{ $variant->color ?? '—' }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">المقاس:</p>
                        <p class="font-medium text-gray-900 dark:text-gray-100">{{ $variant->size ?? '—' }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">السعر:</p>
                        <p class="font-medium text-gray-900 dark:text-gray-100">{{ number_format($variant->price, 2) }} جنيه</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">المخزون:</p>
                        <p class="font-medium text-gray-900 dark:text-gray-100">{{ $variant->stock != 0 ? $variant->stock : 'تم نفاذ الكمية' }}</p>
                    </div>

                    {{-- <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">تم بيع:</p>
                        <p class="font-medium text-gray-900 dark:text-gray-100">{{ $variant->stock }}</p>
                    </div> --}}
                </div>


                <a href="#" class="text-red-500 hover:text-red-700 bg-red-100 hover:bg-red-200 rounded-full p-2 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </a>
            </div>
        </div>
    @empty
        <p class="text-gray-600 dark:text-gray-300 text-sm">لا توجد خصائص مضافة بعد.</p>
    @endforelse
</div>

            </div> {{-- tabel --}}
            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">إضافة خصائص المنتج</h2>

            <form action="{{ route('product_variant.store') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">

                <table class="min-w-full bg-white dark:bg-gray-800 rounded-lg shadow-md mb-4">
                    <thead class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 text-right">
                        <tr>
                            <th class="py-2 px-4 border-b text-center">اللون</th>
                            <th class="py-2 px-4 border-b text-center">المقاس</th>
                            <th class="py-2 px-4 border-b text-center">السعر</th>
                            <th class="py-2 px-4 border-b text-center">المخزون</th>
                            <th class="py-2 px-4 border-b text-center">حذف</th>
                        </tr>
                    </thead>
                    <tbody id="variants-table-body">
                        <tr class="variant-row">
                            <td class="py-2 px-4 border-b text-center">
                                <select name="variants[0][color]" class="border rounded-md px-2 py-1 w-full">
                                    <option value="" disabled selected>اختر اللون</option>
                                    @foreach (config('colors') as $color)
                                        <option value="{{ $color }}">{{ $color }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="py-2 px-4 border-b text-center">
                                <select name="variants[0][size]" class="border rounded-md px-2 py-1 w-full">
                                    <option value="" disabled selected>اختر المقاس</option>
                                    @foreach (config('size') as $size)
                                        <option value="{{ $size }}">{{ $size }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="py-2 px-4 border-b text-center">
                                <input type="number" step="0.01" name="variants[0][price]" placeholder="السعر"
                                    class="border rounded-md px-2 py-1 w-full">
                            </td>
                            <td class="py-2 px-4 border-b text-center">
                                <input type="number" name="variants[0][stock]" placeholder="الكمية"
                                    class="border rounded-md px-2 py-1 w-full">
                            </td>
                            <td class="py-2 px-4 border-b text-center">
                                <button type="button"
                                    class="delete-row bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">حذف</button>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="flex justify-between">
                    <button type="button" id="add-row"
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        + إضافة صف جديد
                    </button>
                    <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
                        حفظ
                    </button>
                </div>
            </form>
        </div>
    @endsection

    @section('js')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const addRowBtn = document.getElementById('add-row');
                const tableBody = document.getElementById('variants-table-body');

                let rowIndex = 1;

                addRowBtn.addEventListener('click', function() {
                    const newRow = document.createElement('tr');
                    newRow.classList.add('variant-row');
                    newRow.innerHTML = `
                <td class="py-2 px-4 border-b text-center">
                    <select name="variants[${rowIndex}][color]" class="border rounded-md px-2 py-1 w-full">
                        <option value="" disabled selected>اختر اللون</option>
                        @foreach (config('colors') as $color)
                            <option value="{{ $color }}">{{ $color }}</option>
                        @endforeach
                    </select>
                </td>
                <td class="py-2 px-4 border-b text-center">
                    <select name="variants[${rowIndex}][size]" class="border rounded-md px-2 py-1 w-full">
                        <option value="" disabled selected>اختر المقاس</option>
                        @foreach (config('size') as $size)
                            <option value="{{ $size }}">{{ $size }}</option>
                        @endforeach
                    </select>
                </td>
                <td class="py-2 px-4 border-b text-center">
                    <input type="number" step="0.01" name="variants[${rowIndex}][price]" placeholder="السعر" class="border rounded-md px-2 py-1 w-full">
                </td>
                <td class="py-2 px-4 border-b text-center">
                    <input type="number" name="variants[${rowIndex}][stock]" placeholder="الكمية" class="border rounded-md px-2 py-1 w-full">
                </td>
                <td class="py-2 px-4 border-b text-center">
                    <button type="button" class="delete-row bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">حذف</button>
                </td>
            `;
                    tableBody.appendChild(newRow);
                    rowIndex++;
                });

                // حذف الصف
                tableBody.addEventListener('click', function(e) {
                    if (e.target.classList.contains('delete-row')) {
                        e.target.closest('tr').remove();
                    }
                });
            });
        </script>
    @endsection
