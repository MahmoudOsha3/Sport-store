<div>
    <header class="bg-white shadow-md py-4 px-6 md:px-10 sticky top-0 z-50 rounded-b-lg">
            <div class="container mx-auto flex justify-between items-center">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="{{ route('home') }}" class="text-2xl font-bold text-indigo-600 rounded-md p-2 hover:bg-indigo-50 transition-colors duration-200">
                        <span class="block dark:hidden" data-lang-ar="متجر الرياضة" data-lang-en="Sport Store">متجر الرياضة</span>
                        <span class="hidden dark:block" data-lang-ar="متجر الرياضة" data-lang-en="Sport Store">Sport Store</span>
                    </a>
                </div>

                <!-- Navigation Menu (Desktop) -->
                <nav class="hidden md:flex items-center space-x-6 rtl:space-x-reverse">
                    <!-- Categories Dropdown -->
                    @if ($user->name ?? null)
                        <p>مرحبًا، {{ $user->name }}</p>
                    @else
                    <button onclick="document.getElementById('auth-modal').classList.remove('hidden')">
                        تسجيل الدخول
                    </button>
                    @endif

                    <div class="relative group">
                        <button class="text-gray-600 hover:text-indigo-600 font-medium flex items-center focus:outline-none rounded-md px-3 py-2 transition-colors duration-200">
                            <span class="group-hover:text-indigo-600" data-lang-ar="الأقسام" data-lang-en="Categories">الأقسام</span>
                            <svg class="ml-1 w-4 h-4 transform group-hover:rotate-180 transition-transform duration-200 rtl:mr-1 rtl:ml-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>

                        <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform scale-95 group-hover:scale-100 origin-top-right dark:bg-gray-800">
                            @foreach ($categories as $category)
                                <a href="{{ route('home.category' , $category->id) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md dark:text-gray-200 dark:hover:bg-gray-700" data-lang-ar="تي شيرتات" data-lang-en="T-Shirts">{{ $category->name }}</a>
                            @endforeach
                        </div>
                    </div>
                    <a href="{{ route('order.index') }}" class="text-gray-600 hover:text-indigo-600 font-medium rounded-md px-3 py-2 transition-colors duration-200" data-lang-ar="طلباتي" data-lang-en="My Orders">طلباتي</a>

                    @if ($user->name ?? null)
                        <a href=""  id="logout-link" class="flex items-center gap-2 text-gray-700 hover:text-red-600 transition">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            <span>تسجيل الخروج</span>
                        </a>

                        <!-- فورم تسجيل الخروج -->
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>
                    @endif


                    {{-- <span id="username-display" class="text-gray-600 font-medium  rounded-md px-3 py-2 transition-colors duration-200"></span> --}}
                </nav>

                <!-- Icons (Desktop & Mobile) -->
                <div class="flex items-center space-x-4 rtl:space-x-reverse">
                    <!-- Language Toggle Dropdown -->
                    <div class="relative language-dropdown">
                        <button id="lang-dropdown-btn" class="p-2 rounded-full bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors duration-200 focus:outline-none text-sm font-semibold flex items-center">
                            <span class="current-lang-display" data-lang-ar="العربية" data-lang-en="English">العربية</span>
                            <svg class="ml-1 w-4 h-4 rtl:mr-1 rtl:ml-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div class="language-dropdown-content rounded-md shadow-lg py-1">
                            <a href="#" data-lang-option="ar" data-lang-ar="العربية" data-lang-en="Arabic">العربية</a>
                            <a href="#" data-lang-option="en" data-lang-ar="الإنجليزية" data-lang-en="English">الإنجليزية</a>
                        </div>
                    </div>

                    <!-- Dark/Light Mode Toggle -->
                    <button id="theme-toggle" class="p-2 rounded-full bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors duration-200 focus:outline-none">
                        <svg id="sun-icon" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h1M2 12h1m15.325-6.675l-.707-.707M6.05 18.05l-.707-.707M18.05 6.05l-.707.707M6.05 6.05l.707.707M12 7a5 5 0 100 10 5 5 0 000-10z"></path></svg>
                        <svg id="moon-icon" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                    </button>

                    <!-- Shopping Cart Icon -->
                    <div class="relative group">
                        <button class="p-2 rounded-full bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors duration-200 focus:outline-none">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            <span id="cart-count" class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full transform translate-x-1/2 -translate-y-1/2">{{ App\Models\Cart::count() }}</span>
                        </button>

                        <!-- Cart Dropdown Content -->

                    <div id="cart-dropdown"
                        class="absolute letf-0 top-full mt-3 w-80 bg-white dark:bg-gray-800 rounded-2xl shadow-2xl p-4 z-50
                        opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300
                        transform scale-95 group-hover:scale-100 origin-top-left" style="position: absolute ; right:-219px;width:350px">

                        <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-3 border-b pb-2">
                            🛒 عربة التسوق
                        </h2>

                            <div id="cart-items" class="space-y-4 max-h-72 overflow-y-auto scrollbar-thin scrollbar-thumb-gray-300 dark:scrollbar-thumb-gray-700 pr-2">

                                @forelse ($carts as $cart)
                                    <div class="flex items-center justify-between gap-3 border-b border-gray-100 dark:border-gray-700 pb-3">

                                        <!-- صورة المنتج -->
                                        <img src="products/{{ $cart->product->image }}"
                                            alt="image"
                                            class="w-16 h-16 object-cover rounded-lg shadow-sm flex-shrink-0">

                                        <!-- التفاصيل -->
                                        <div class="flex-1 min-w-0">
                                            <h3 class="font-medium text-gray-800 dark:text-gray-100 truncate">
                                                {{ $cart->product->title }}
                                            </h3>
                                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                                {{ number_format($cart->variant->price) }} EGP
                                            </p>

                                            <!-- التحكم في الكمية -->
                                            <div class="flex items-center mt-2">
                                                <button class="qty-decrease-btn bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-600 rounded-full w-7 h-7 flex items-center justify-center text-sm font-bold">−</button>
                                                <input type="number" value="{{ $cart->quantity }}" min="1" class="w-12 text-center mx-2 text-sm p-1 border border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 qty-input">
                                                <button class="qty-increase-btn bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-600 rounded-full w-7 h-7 flex items-center justify-center text-sm font-bold">+</button>
                                            </div>
                                        </div>

                                        <!-- السعر والإزالة -->
                                        <div class="flex flex-col items-end justify-between h-full">
                                            <span class="font-semibold text-gray-800 dark:text-gray-100 text-sm">
                                                {{ number_format($cart->variant->price ,2 ) }} EGP
                                            </span>
                                            <button class="remove-item-btn text-red-500 hover:text-red-700 transition-colors duration-200 mt-1">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-gray-500 text-sm text-center py-8 empty-cart-message"
                                    data-lang-ar="عربة التسوق فارغة"
                                    data-lang-en="Your cart is empty.">
                                    🛍️ عربة التسوق فارغة
                                    </p>
                                @endforelse
                            </div>

                            <!-- الإجمالي -->
                            <div class="border-t border-gray-200 dark:border-gray-700 mt-4 pt-3">
                                <div class="flex justify-between items-center mb-3">
                                    <span class="text-gray-700 dark:text-gray-300 font-medium">الإجمالي:</span>
                                    <span id="cart-total" class="font-semibold text-gray-900 dark:text-gray-100">{{ number_format($total_price_carts , 2) }} EGP</span>
                                </div>
                                <a href="{{ route('carts.index') }}"
                                class="block w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium text-center py-2 rounded-lg transition">
                                عرض العربة
                                </a>
                            </div>
                        </div>
                    </div>



                    <!-- Search Icon -->
                    <button id="search-toggle" class="p-2 rounded-full bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors duration-200 focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </button>

                    <!-- Mobile Menu Button -->
                    <button id="mobile-menu-button" class="md:hidden p-2 rounded-full bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors duration-200 focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                </div>
            </div>

            <!-- Search Input (Hidden by default) -->
            <div id="search-container" class="mt-4 hidden">
                <input type="text" id="search-input" placeholder="ابحث عن المنتجات..." class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100" data-lang-ar-placeholder="ابحث عن المنتجات..." data-lang-en-placeholder="Search for products...">
            </div>

            <!-- Mobile Menu (Hidden by default) -->
            <div id="mobile-menu" class="md:hidden mt-4 bg-white dark:bg-gray-800 rounded-md shadow-lg py-2 hidden">
                <a href="#" class="block px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md" data-lang-ar="الأقسام" data-lang-en="Categories">الأقسام</a>
                <a href="#" class="block px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md" data-lang-ar="طلباتي" data-lang-en="My Orders">طلباتي</a>
                <span id="mobile-username-display" class="block px-4 py-2 text-gray-700 dark:text-gray-200 hidden" data-lang-ar="مرحباً، [اسم المستخدم]" data-lang-en="Welcome, [Username]"></span>
            </div>
    </header>
    @include('website.users.register')
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const logoutLink = document.getElementById('logout-link') ;
        const logoutForm = document.getElementById('logout-form') ;
        logoutLink.onclick = function (e) {
            e.preventDefault();
            logoutForm.submit() ;
        };
    });

    const modal = document.getElementById('auth-modal');
    const closeModal = document.getElementById('close-auth-modal');

    const loginForm = document.getElementById('login-form');
    const registerForm = document.getElementById('register-form');

    document.getElementById('open-register').onclick = () => {
        loginForm.classList.add('hidden');
        registerForm.classList.remove('hidden');
    };

    document.getElementById('open-login').onclick = () => {
        registerForm.classList.add('hidden');
        loginForm.classList.remove('hidden');
    };

    closeModal.onclick = () => modal.classList.add('hidden');
</script>

</script>
