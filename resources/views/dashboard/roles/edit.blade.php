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
        <ul>
            {{-- @foreach ( as $success) --}}
                <li>{{ session()->get('success') }}</li>
            {{-- @endforeach --}}
        </ul>
    @endif
        <form action="{{ route('roles.update' , $role->id ) }}" method="post">
            @method('PUT')
            @csrf
            <div>
                <label for="product-name-ar" class="block text-sm font-medium text-gray-700 dark:text-gray-300">الدور</label>
                <input type="text" name="role_name" value="{{ $role->name }}" id="product-name-ar" class="mt-1 block w-full p-2 border border-gray-300 rounded-md dark:bg-gray-600 dark:border-gray-500 dark:text-gray-100">
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
                            @foreach (config('abilities') as $ability => $abilityView)
                                {{-- <tr style="height: 40px;border-bottom:1px solid rgb(222, 219, 219)"> --}}
                                {{-- </tr> --}}
                                <tr style="height: 40px;border-bottom:1px solid rgb(222, 219, 219)">
                                    <td style="text-align: center">{{ ++ $index }}</td>

                                    <td style="text-align: center">
                                        {{ $abilityView }}
                                    </td>
                                    <td style="text-align: center">
                                        <label for="check_{{ $index }}">Allow</label>
                                        <input type="radio" name="permissions[{{ $ability }}]" value="allow" id="check_{{ $index }}" @checked($role_abilities['ability'] ?? '' == 'allow')>
                                    </td>
                                    <td style="text-align: center">
                                        <label for="check_{{ $index }}">Deny</label>
                                        <input type="radio" name="permissions[{{ $ability }}]" value="deny" id="check_{{ $index }}" @checked($role_abilities['ability'] ?? '' == 'deny')>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table><br>
                    <button type="submit" style="background-color: blue">confirm</button>
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

