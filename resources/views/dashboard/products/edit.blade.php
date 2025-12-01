
<div id="editProductModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl w-full max-w-2xl overflow-y-auto max-h-[90vh]">
        <div class="flex justify-between items-center p-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100">إضافة منتج جديد</h3>
            <button id="closeAddProductModal" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <div class="p-4">
            <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-md shadow-sm mb-6" >
                <h3 class="text-xl font-semibold mb-4 text-gray-800 dark:text-gray-100" data-lang-ar="تفاصيل المنتج" data-lang-en="Product Details">تفاصيل المنتج</h3>
                <form id="product-form" class="space-y-4" method="post" action="{{ route('products.store') }}"  enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="product-id">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="product-name-ar" class="block text-sm font-medium text-gray-700 dark:text-gray-300">اسم المنتج </label>
                            <input type="text" name="title" id="product-name-ar" class="mt-1 block w-full p-2 border border-gray-300 rounded-md dark:bg-gray-600 dark:border-gray-500 dark:text-gray-100">
                        </div>
                        <div>
                            <label for="product-compare-price" class="block text-sm font-medium text-gray-700 dark:text-gray-300" >سعر المنتج قبل الخصم</label>
                            <input type="number" name="compare_price" id="product-compare-price" class="mt-1 block w-full p-2 border border-gray-300 rounded-md dark:bg-gray-600 dark:border-gray-500 dark:text-gray-100">
                        </div>
                        <div>
                            <label for="product-price" class="block text-sm font-medium text-gray-700 dark:text-gray-300" >سعر المنتج بعد الخصم</label>
                            <input type="number" name="price" id="product-price" class="mt-1 block w-full p-2 border border-gray-300 rounded-md dark:bg-gray-600 dark:border-gray-500 dark:text-gray-100">
                        </div>
                    </div>
                    <div>
                        <label for="product-category" class="block text-sm font-medium text-gray-700 dark:text-gray-300" >القسم</label>
                        <select name="category_id" id="product-category" class="mt-1 block w-full p-2 border border-gray-300 rounded-md dark:bg-gray-600 dark:border-gray-500 dark:text-gray-100">
                            <option value="" disabled selected>...</option> {{-- Value changed to empty string for better default handling --}}
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="product-description-ar" class="block text-sm font-medium text-gray-700 dark:text-gray-300" data-lang-ar="الوصف (عربي)" data-lang-en="Description (Arabic)">الوصف (عربي)</label>
                        <textarea id="product-description-ar" name="description" rows="3" class="mt-1 block w-full p-2 border border-gray-300 rounded-md dark:bg-gray-600 dark:border-gray-500 dark:text-gray-100"></textarea>
                    </div>
                    <div>
                        <label for="product-image" class="block text-sm font-medium text-gray-700 dark:text-gray-300" data-lang-ar="رابط الصورة" data-lang-en="Image URL">رابط الصورة</label>
                        <input type="file" id="product-image" name="image" class="mt-1 block w-full p-2 border border-gray-300 rounded-md dark:bg-gray-600 dark:border-gray-500 dark:text-gray-100">
                    </div>
                    <div class="flex justify-end space-x-2 rtl:space-x-reverse mt-4">
                        <button type="button" id="cancel-add-product" class="bg-gray-400 text-white px-4 py-2 rounded-md hover:bg-gray-500 transition-colors duration-200" data-lang-ar="إلغاء" data-lang-en="Cancel">إلغاء</button>
                        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition-colors duration-200" data-lang-ar="حفظ المنتج" data-lang-en="Save Product">حفظ المنتج</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

