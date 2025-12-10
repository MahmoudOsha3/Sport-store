<!-- Delete Modal -->
<div id="deleteModal" 
     class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">

    <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-3">
            هل أنت متأكد من الحذف؟
        </h3>

        <p class="text-gray-600 mb-5">
            لن يمكنك استرجاع هذا العنصر بعد الحذف.
        </p>

        <!-- Form -->
        <form action="{{ route('admin.user.destroy') }}" method="POST">
            @csrf
            {{-- @method('DELETE') --}}
            <input type="hidden" name="id" id="deleteUserId">

            <div class="flex justify-end gap-3">
                <button type="button" id="closeDeleteModal"
                        class="px-4 py-2 border rounded-md text-gray-700">
                    إلغاء
                </button>

                <button type="submit"
                        class="px-4 py-2 bg-red-600 text-white rounded-md">
                    نعم احذف
                </button>
            </div>
        </form>
    </div>
</div>
