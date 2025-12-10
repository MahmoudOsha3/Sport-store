@extends('layouts.dashboard.app')
@section('title' , 'كوبونات | خصومات')
@section('css')

@endsection

@section('content')
    <!-- Admin Content Area -->
    <div class="lg:w-2/3 w-full bg-white dark:bg-gray-800 rounded-lg shadow-md p-6" style="width: -moz-available;" >

        <section id="products-all" class="admin-section">

            <h2 class="text-2xl font-bold mb-6 text-gray-900 dark:text-gray-100" >جميع كوبونات</h2>
            @can('create' , 'App\\Models\Coupon')

            <button id="openModalBtn" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    إضافة كوبون
            </button>
            @endcan

            <div class="overflow-x-auto" style="padding:10px">
                <table class="min-w-full bg-white dark:bg-gray-800 rounded-lg shadow-sm">
                    <thead>
                        <tr class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 text-right">
                            <th class="py-2 px-4 border-b border-gray-300 dark:border-gray-600"  style="text-align: center">الكود</th>
                            <th class="py-2 px-4 border-b border-gray-300 dark:border-gray-600"  style="text-align: center">بداية الكوبون</th>
                            <th class="py-2 px-4 border-b border-gray-300 dark:border-gray-600"  style="text-align: center">نهاية الكوبون</th>
                            <th class="py-2 px-4 border-b border-gray-300 dark:border-gray-600"  style="text-align: center">اقصي عدد مستخدمين للكوبون</th>
                            <th class="py-2 px-4 border-b border-gray-300 dark:border-gray-600"  style="text-align: center">عدد الاستخدام حتي الان</th>
                            <th class="py-2 px-4 border-b border-gray-300 dark:border-gray-600"  style="text-align: center">قيمه الخصم</th>
                            <th class="py-2 px-4 border-b border-gray-300 dark:border-gray-600"  style="text-align: center">الحاله</th>
                            {{-- @can('update' , 'App\\Models\Coupon') --}}
                                <th class="py-2 px-4 border-b border-gray-300 dark:border-gray-600"  style="text-align: center">الإجراءات</th>                                                                
                            {{-- @endcan --}}
                        </tr>
                    </thead>
                    <tbody id="products-table-body" >
                        @forelse ($coupons as $coupon)
                            <tr style="height: 40px;border-bottom:1px solid rgb(222, 219, 219)">
                                <td style="text-align: center">{{ $coupon->code }}</td>
                                <td style="text-align: center">{{ $coupon->start_at }}</td>
                                <td style="text-align: center">{{ $coupon->end_at }}</td>
                                <td style="text-align: center">{{ $coupon->max_uses }}</td>
                                <td style="text-align: center">{{ $coupon->used_count }}</td>
                                <td style="text-align: center">{{ $coupon->discount_value }} {{ ($coupon->discount_type == 'percentage') ? " %" : "جنيه"}}</td>
                                <td style="text-align: center">{{ $coupon->status }}</td>
                                <td style="text-align: center">

                                @can('update' , 'App\\Models\Coupon')
                                <button
                                    class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded editBtn"
                                    data-id="{{ $coupon->id }}"
                                    data-code="{{ $coupon->code }}"
                                    data-max_uses="{{ $coupon->max_uses }}"
                                    data-start_at="{{ $coupon->start_at }}"
                                    data-end_at="{{ $coupon->end_at }}"
                                    data-discount_type="{{ $coupon->discount_type }}"
                                    data-discount_value="{{ $coupon->discount_value }}"
                                    data-min_order_amount="{{ $coupon->min_order_amount }}"
                                >
                                    تعديل
                                </button>
                                @endcan    
                                @can('delete' , 'App\\Models\Coupon')
                                 <form action="{{ route('coupons.destroy' , $coupon->id) }}" method="post">
                                        @method('DELETE')
                                        @csrf
                                    <button type="submit"  class="delete-product-btn bg-red-500 text-white px-3 py-1 rounded-md text-sm hover:bg-red-600 transition-colors duration-200">حذف</button>
                                    </form>
                                {{-- <button 
                                    class="openDeleteModal px-4 py-2 bg-red-600 text-white rounded-md"
                                    data-id="{{ $coupon->id }}"
                                >
                                    حذف
                                </button> --}}
                                @endcan

                                </td>
                            </tr>
                        @empty
                            <tr id="no-products-message">
                                <td colspan="4" class="text-center py-4 text-gray-500">لا توجد كوبونات حالياً.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $coupons->links() }}
            </div>
        </section>
        @include('dashboard.coupons.edit')
        @include('dashboard.coupons.delete')

        <div id="myModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
            <div class="bg-white rounded-lg shadow-xl w-11/12 md:w-1/2 lg:w-1/3 p-6 relative">
                <button id="closeModalBtn" class="absolute top-3 left-3 text-gray-500 hover:text-gray-700 text-2xl font-bold">
                    &times;
                </button>

                <h2 class="text-2xl font-semibold mb-4 text-gray-800">إضافة كوبون جديد</h2>

                <form action="{{ route('coupons.store') }}" method="post">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm text-gray-700 dark:text-gray-300">كود الكوبون</label>
                            <input type="text" name="code"
                                class="w-full mt-1 p-2 border rounded-md dark:bg-gray-700 dark:text-white">
                        </div>

                        <div>
                            <label class="block text-sm text-gray-700 dark:text-gray-300">اقصي عدد للإستخدام</label>
                            <input type="number" name="max_uses"
                                class="w-full mt-1 p-2 border rounded-md dark:bg-gray-700 dark:text-white">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <div>
                            <label class="block text-sm text-gray-700 dark:text-gray-300">تاريخ البداية</label>
                            <input type="date" name="start_at"
                                class="w-full mt-1 p-2 border rounded-md dark:bg-gray-700 dark:text-white">
                        </div>
                        <div>
                            <label class="block text-sm text-gray-700 dark:text-gray-300">تاريخ النهاية</label>
                            <input type="date" name="end_at"
                                class="w-full mt-1 p-2 border rounded-md dark:bg-gray-700 dark:text-white">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="w-full mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                نوع الكوبون
                            </label>
                            <select name="discount_type"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:text-gray-200">
                                <option value="" disabled selected>اختار قيمة الكوبون</option>
                                <option value="fixed">قيمة ثابتة</option>
                                <option value="percentage">نسبة مئوية</option>
                            </select>
                        </div>
                        <div>
                        <label class="block text-sm text-gray-700 dark:text-gray-300">قيمة الخصم</label>
                            <input type="number" name="discount_value"
                                class="w-full mt-1 p-2 border rounded-md dark:bg-gray-700 dark:text-white">
                        </div>

                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm text-gray-700 dark:text-gray-300">اقل قيمة لا يمكن ان يطبق عليه</label>
                            <input type="number" name="min_order_amount"
                                class="w-full mt-1 p-2 border rounded-md dark:bg-gray-700 dark:text-white">
                        </div>
                    </div>

                    <br>
                    <div class="flex items-center justify-between">
                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            إنشاء الكوبون
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
<script>
document.addEventListener("DOMContentLoaded", function () {
    const editModal = document.getElementById('editModal');
    const closeModal = document.getElementById('closeEditModal');
    const cancelEditBtn = document.getElementById('cancelEditBtn');
    const editForm = document.getElementById('editCouponForm');

    // عند الضغط على زر تعديل
    document.querySelectorAll('.editBtn').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.dataset.id;

            // تعبئة القيم داخل الحقول
            document.getElementById('coupon_id').value = id ;
            document.getElementById('edit_code').value = this.dataset.code;
            document.getElementById('edit_max_uses').value = this.dataset.max_uses;
            document.getElementById('edit_start_at').value = this.dataset.start_at;
            document.getElementById('edit_end_at').value = this.dataset.end_at;
            document.getElementById('edit_discount_type').value = this.dataset.discount_type;
            document.getElementById('edit_discount_value').value = this.dataset.discount_value;
            document.getElementById('edit_min_order_amount').value = this.dataset.min_order_amount;

            // إظهار المودال
            editModal.classList.remove('hidden');
            editModal.classList.add('flex');
        });
    });

    // إغلاق المودال
    [closeModal, cancelEditBtn].forEach(btn => {
        btn.addEventListener('click', () => {
            editModal.classList.add('hidden');
            editModal.classList.remove('flex');
        });
    });

    // delete modal
    const deleteModal = document.getElementById('deleteModal') ;
    document.querySelectorAll('.openDeleteModal').forEach(btn=>{
        btn.addEventListener('click' , ()=>{
            deleteModal.classList.remove('hidden') ;
            deleteModal.classList.add('flex') ;
            deleteId = btn.dataset.id  ;
            document.getElementById('deleteCouponId').value = deleteId ;
        });
    })
});
</script>


@endsection

