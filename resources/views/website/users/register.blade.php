<!-- Modal -->
<div id="auth-modal"
     class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">

    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg w-full max-w-md p-6 relative">

        <button id="close-auth-modal"
                class="absolute top-3 right-3 text-gray-400 hover:text-red-500 transition">
            <i class="fa-solid fa-xmark text-xl"></i>x
        </button>

        <!-- -------------------- Login Form -------------------- -->
        <div id="login-form">
            <h2 class="text-2xl font-bold text-center text-gray-800 dark:text-gray-100 mb-6">
                تسجيل الدخول
            </h2>

            <form method="POST" action="{{ route('login.check') }}" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm text-gray-700 dark:text-gray-300">البريد الإلكتروني</label>
                    <input type="email" name="email"
                           class="w-full mt-1 p-2 border rounded-md dark:bg-gray-700 dark:text-white">
                </div>

                <div>
                    <label class="block text-sm text-gray-700 dark:text-gray-300">كلمة المرور</label>
                    <input type="password" name="password"
                           class="w-full mt-1 p-2 border rounded-md dark:bg-gray-700 dark:text-white">
                </div>

                <button type="submit"
                        class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2 rounded-md transition">
                    تسجيل الدخول
                </button>
            </form>

            <p class="text-center text-sm text-gray-600 mt-4">
                ليس لديك حساب؟
                <button id="open-register" class="text-indigo-600 hover:underline">
                    إنشاء حساب
                </button>
            </p>
        </div>

        <!-- -------------------- Register Form -------------------- -->
        <div id="register-form" class="hidden">
            <h2 class="text-2xl font-bold text-center text-gray-800 dark:text-gray-100 mb-6">
                إنشاء حساب
            </h2>

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <!-- الاسم الثلاثي -->
                <div>
                    <label class="block text-sm text-gray-700 dark:text-gray-300">الاسم الثلاثي</label>
                    <input type="text" name="name"
                        class="w-full mt-1 p-2 border rounded-md dark:bg-gray-700 dark:text-white">
                </div>

                <!-- البريد الإلكتروني -->
                <div>
                    <label class="block text-sm text-gray-700 dark:text-gray-300">البريد الإلكتروني</label>
                    <input type="email" name="email"
                        class="w-full mt-1 p-2 border rounded-md dark:bg-gray-700 dark:text-white">
                </div>

                <!-- كلمة المرور + تأكيد -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm text-gray-700 dark:text-gray-300">كلمة المرور</label>
                        <input type="password" name="password"
                            class="w-full mt-1 p-2 border rounded-md dark:bg-gray-700 dark:text-white">
                    </div>

                    <div>
                        <label class="block text-sm text-gray-700 dark:text-gray-300">تأكيد كلمة المرور</label>
                        <input type="password" name="password_confirmation"
                            class="w-full mt-1 p-2 border rounded-md dark:bg-gray-700 dark:text-white">
                    </div>
                </div>

                <!-- رقم الهاتف -->
                <div>
                    <label class="block text-sm text-gray-700 dark:text-gray-300">رقم الهاتف</label>
                    <input type="text" name="phone"
                        class="w-full mt-1 p-2 border rounded-md dark:bg-gray-700 dark:text-white">
                </div>

                <!-- العنوان -->
                <div>
                    <label class="block text-sm text-gray-700 dark:text-gray-300">العنوان</label>
                    <input type="text" name="address"
                        class="w-full mt-1 p-2 border rounded-md dark:bg-gray-700 dark:text-white">
                </div>

                <button type="submit"
                        class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2 rounded-md transition">
                    إنشاء الحساب
                </button>
            </form>

            <p class="text-center text-sm text-gray-600 mt-4">
                لديك حساب بالفعل؟
                <button id="open-login" class="text-indigo-600 hover:underline">
                    تسجيل الدخول
                </button>
            </p>
        </div>

    </div>
</div>

