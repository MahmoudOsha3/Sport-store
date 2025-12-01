@extends('layouts.dashboard.app')

@section('title' , 'إضافة مشرف')
@section('css')
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
        }
        .form-input {
            width: 100%;
            padding: 12px 16px;
            border-radius: 8px;
            border: 1px solid #d1d5db;
            background-color: #ffffff;
            color: #111827;
        }
        .form-input:focus {
            outline: none;
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.5);
        }
    </style>
@endsection
@section('content')
    <main class="w-full max-w-4xl bg-white dark:bg-gray-800 rounded-lg shadow-xl p-8 space-y-8">
        <!-- Main Content -->
        <div class="flex-1 space-y-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">إضافة مشرف جديد</h1>
            <p class="text-gray-600 dark:text-gray-400">
                قم بملء البيانات التالية لإضافة مشرف جديد إلى لوحة التحكم.
            </p>

            <form class="space-y-6" action="{{  route('admin.register') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Personal Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">الاسم الكامل</label>
                        <input type="text" id="name" name="name" class="form-input" placeholder="اسم المشرف" required>
                        @error('name')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">البريد الإلكتروني</label>
                        <input type="email" id="email" name="email" class="form-input" placeholder="البريد الإلكتروني" required>
                        @error('email')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                </div>


                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">العنوان</label>
                        <input type="text" id="address" name="address" class="form-input" placeholder="العنوان" required>
                            @error('address')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">رقم التليفون</label>
                        <input type="string" id="phone" name="phone" class="form-input" placeholder="رقم التليفون" required>
                        @error('phone')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Password and Role -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="relative">
                        <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">كلمة المرور</label>
                        <input type="password" id="password" name="password" class="form-input pr-10 rtl:pl-10 rtl:pr-4" placeholder="كلمة المرور" required>
                        @error('password')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                        <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 rtl:left-0 rtl:right-auto flex items-center px-3 text-gray-400">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path id="eye-icon" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                    <div>
                        <label for="role" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">دور المشرف</label>
                        <select id="role" name="role" class="form-input" required>
                            <option value="" selected disabled>اختر دور المشرف</option>
                            <option value="owner">مالك</option>
                            <option value="super_admin">مدير المشرف</option>
                            <option value="admin">مشرف</option>
                        </select>
                            @error('role')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Profile Picture -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">صورة شخصية</label>
                    <div class="mt-2 flex items-center space-x-4 rtl:space-x-reverse">
                        <span class="inline-block h-12 w-12 rounded-full overflow-hidden bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600">
                            <svg class="h-full w-full text-gray-400 dark:text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.766 0 8.761 1.581 11.996 5.993zM16 12A4 4 0 1016 4 4 4 0 0016 12z" />
                            </svg>
                        </span>
                        <input type="file" class="form-input" name="image" accept="image/*">
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-6">
                    <button type="submit" class="w-full py-3 px-6 rounded-md text-white font-semibold bg-indigo-600 hover:bg-indigo-700 transition-colors duration-300">
                        إضافة المشرف
                    </button>
                </div>
            </form>
        </div>
    </main>
@endsection

@section('js')
        <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eye-icon');

        togglePassword.addEventListener('click', () => {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            // تغيير أيقونة العين
            if (type === 'password') {
                eyeIcon.setAttribute('d', 'M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z');
            } else {
                eyeIcon.setAttribute('d', 'M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7zM2.458 12l17.084-5.057');
            }
        });
    </script>
@endsection
