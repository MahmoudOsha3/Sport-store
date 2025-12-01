<!-- Edit Coupon Modal -->
<div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl w-11/12 md:w-1/2 lg:w-1/3 p-6 relative">
        <button id="closeEditModal" class="absolute top-3 left-3 text-gray-500 hover:text-gray-700 text-2xl font-bold">
            &times;
        </button>

        <h2 class="text-2xl font-semibold mb-4 text-gray-800 text-center">تعديل الكوبون</h2>
        @php $id = 1 ; @endphp
        <form id="editCouponForm" action="{{ route('coupons.update' , $id ) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-gray-700">كود الكوبون</label>
                    <input type="hidden" name="coupon_id" id="coupon_id"
                        class="w-full mt-1 p-2 border rounded-md">
                    <input type="text" name="code" id="edit_code"
                        class="w-full mt-1 p-2 border rounded-md">
                </div>

                <div>
                    <label class="block text-sm text-gray-700">أقصى عدد للاستخدام</label>
                    <input type="number" name="max_uses" id="edit_max_uses"
                        class="w-full mt-1 p-2 border rounded-md">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                    <label class="block text-sm text-gray-700">تاريخ البداية</label>
                    <input type="date" name="start_at" id="edit_start_at"
                        class="w-full mt-1 p-2 border rounded-md">
                </div>
                <div>
                    <label class="block text-sm text-gray-700">تاريخ النهاية</label>
                    <input type="date" name="end_at" id="edit_end_at"
                        class="w-full mt-1 p-2 border rounded-md">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        نوع الكوبون
                    </label>
                    <select name="discount_type" id="edit_discount_type"
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none">
                        <option value="fixed">قيمة ثابتة</option>
                        <option value="percentage">نسبة مئوية</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm text-gray-700">قيمة الخصم</label>
                    <input type="number" name="discount_value" id="edit_discount_value"
                        class="w-full mt-1 p-2 border rounded-md">
                </div>
            </div>

            <div class="mt-4">
                <label class="block text-sm text-gray-700">أقل قيمة للطلب لتطبيق الكوبون</label>
                <input type="number" name="min_order_amount" id="edit_min_order_amount"
                    class="w-full mt-1 p-2 border rounded-md">
            </div>

            <br>
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    تحديث الكوبون
                </button>
                <button type="button" id="cancelEditBtn" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                    إلغاء
                </button>
            </div>
        </form>
    </div>
</div>
