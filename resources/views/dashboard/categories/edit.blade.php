            <div id="ModalEdit" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
                <div class="bg-white rounded-lg shadow-xl w-11/12 md:w-1/2 lg:w-1/3 p-6 relative">
                    <button id="closeModalBtnEdit" class="absolute top-3 left-3 text-gray-500 hover:text-gray-700 text-2xl font-bold">
                        &times;
                    </button>

                    <h2 class="text-2xl font-semibold mb-4 text-gray-800">إضافة قسم جديد</h2>

                    <form action="{{ route('categories.update' , $category->id ) }}" method="post">
                        @csrf
                        <div class="mb-4">
                            <label for="sectionName" class="block text-gray-700 text-sm font-bold mb-2">اسم القسم:</label>
                            <input type="text" id="sectionName" name="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="أدخل اسم القسم">
                        </div>
                        <div class="flex items-center justify-between">
                            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                حفظ القسم
                            </button>
                            <button type="button" id="cancelFormBtnEdit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                إلغاء
                            </button>
                        </div>
                    </form>
                </div>
            </div>
