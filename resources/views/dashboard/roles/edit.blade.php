@extends('layouts.dashboard.app')
@section('title' , 'الادوار')
@section('css')

@endsection

@section('content')


    <!-- Admin Content Area -->
    <div class="lg:w-2/3 w-full bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
@if (session()->has('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <svg class="fill-current h-6 w-6 text-green-500" role="button" onclick="this.parentElement.parentElement.remove()" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <title>Close</title>
                <path d="M14.348 5.652a1 1 0 0 0-1.414 0L10 8.586 7.066 5.652A1 1 0 1 0 5.652 7.066L8.586 10l-2.934 2.934a1 1 0 1 0 1.414 1.414L10 11.414l2.934 2.934a1 1 0 0 0 1.414-1.414L11.414 10l2.934-2.934a1 1 0 0 0 0-1.414z"/>
            </svg>
        </span>
    </div>
@endif

        <form action="{{ route('roles.update' , $role->id ) }}" method="post">
            @method('PUT')
            @csrf
            <div>
                <label for="product-name-ar" class="block text-sm font-medium text-gray-700 dark:text-gray-300">الدور</label>
                <input type="text" name="name" value="{{ $role->name }}" id="product-name-ar" class="mt-1 block w-full p-2 border border-gray-300 rounded-md dark:bg-gray-600 dark:border-gray-500 dark:text-gray-100">
            </div>
            <section id="products-all" class="admin-section">
                {{-- tabel --}}
                <div class="overflow-x-auto" style="padding:10px">
                    <table class="min-w-full bg-white dark:bg-gray-800 rounded-lg shadow-sm">
                        <thead>
                            <tr class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 text-right">
                                <th class="py-2 px-4 border-b border-gray-300 dark:border-gray-600"  style="text-align: center">#</th>
                                <th class="py-2 px-4 border-b border-gray-300 dark:border-gray-600"  style="text-align: center">العرض</th>
                                <th class="py-2 px-4 border-b border-gray-300 dark:border-gray-600"  style="text-align: center">مصرح</th>
                                <th class="py-2 px-4 border-b border-gray-300 dark:border-gray-600"  style="text-align: center"> غير مصرح</th>
                                <th class="py-2 px-4 border-b border-gray-300 dark:border-gray-600"  style="text-align: center">الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody id="products-table-body" >
                            {{-- <input type="hidden" name="name"> --}}
                            @php $index = 0 ; @endphp
                            @foreach ($permissions as $permission)
                                {{-- <tr style="height: 40px;border-bottom:1px solid rgb(222, 219, 219)"> --}}
                                {{-- </tr> --}}
                                <tr style="height: 40px;border-bottom:1px solid rgb(222, 219, 219)">
                                    <td style="text-align: center">{{ ++ $index }}</td>

                                    <td style="text-align: center">
                                        {{ $permission->ability }}
                                    </td>
                                    <td style="text-align: center">
                                        <label for="check_{{ $index }}">Allow</label>
                                        <input type="radio" name="permissions[{{ $permission->ability }}]" value="allow"  @checked($permission['type'] == 'allow')>
                                    </td>
                                    <td style="text-align: center">
                                        <label for="check_{{ $index }}">Deny</label>
                                        <input type="radio" name="permissions[{{ $permission->ability }}]" value="deny"  @checked($permission['type'] == 'deny')>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table><br>
                    <button type="submit" class="edit-product-btn bg-green-500 text-white px-3 py-1 rounded-md text-sm hover:bg-green-600 transition-colors duration-200 ml-2 rtl:mr-2">تعديل</button>
                </div>
            </section>
        </form>

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

