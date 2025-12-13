    <!-- Header Section -->
    <header class="bg-white shadow-md py-4 px-6 md:px-10 sticky top-0 z-50 rounded-b-lg">
        <div class="container mx-auto flex justify-between items-center">
            <!-- Logo and Admin Info -->
            <div class="flex items-center space-x-4 rtl:space-x-reverse">
                <a href="#" class="text-2xl font-bold text-indigo-600 rounded-md p-2 hover:bg-indigo-50 transition-colors duration-200">
                    <span class="block dark:hidden" data-lang-ar="متجر الرياضة" data-lang-en="Sport Store">متجر الرياضة</span>
                    <span class="hidden dark:block" data-lang-ar="متجر الرياضة" data-lang-en="Sport Store">Sport Store</span>
                </a>
                <div class="flex items-center space-x-2 rtl:space-x-reverse">
                    <img src="https://placehold.co/40x40/6366f1/ffffff?text=Admin" alt="Admin Avatar" class="w-10 h-10 rounded-full border-2 border-indigo-500">
                    <span class="font-semibold text-gray-700 dark:text-gray-200" >hello , {{ auth()->user()->name  }} <br> {{ auth()->user()->role->name }}</span>
                </div>
            </div>

            {{-- {{ auth()->user()->id }} --}}
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

                <!-- Notifications Dropdown -->
                <div x-data="{ open: false, notifications: [], count: 0 }" class="relative">
                    <!-- Icon Button -->
                    <button @click="open = !open; count = 0" class="relative p-2 rounded-full bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors duration-200 focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                        <!-- Badge -->
                        <span x-show="count > 0" x-text="count" class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-600 rounded-full"></span>
                    </button>

                    <!-- Notifications Dropdown -->
                    <div x-show="open" @click.away="open = false"
                        class="absolute left-0 mt-2 w-80 bg-white dark:bg-gray-800 shadow-lg rounded-md overflow-hidden z-50">
                        
                        <div class="p-2 font-semibold border-b border-gray-200 dark:border-gray-700">الإشعارات</div>
                        
                        @forelse (auth()->user()->notifications()->get() as $notification)
                            <a href="{{ $notification->data['link'] }}" 
                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                            
                                <div>
                                    <span class="font-semibold">{{ $notification->data['created_by'] ?? 'مستخدم' }}</span> 
                                    قام بإنشاء طلب <span class="font-bold">{{ $notification->data['order_number'] ?? '' }}</span>
                                </div>
                                
                                <!-- الوقت أسفل الركن الأيسر -->
                                <div class="text-xs text-gray-400 dark:text-gray-400 mt-1 text-left">
                                    {{ $notification->created_at->diffForHumans() }}
                                </div>
                            </a>
                            <hr class="border-gray-200 dark:border-gray-700">
                        @empty
                            <div class="p-4 text-gray-500 dark:text-gray-400 text-center">لا توجد إشعارات</div>
                        @endforelse
                    </div>
                </div>

                <!-- Search Icon -->
                <button id="search-toggle" class="p-2 rounded-full bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors duration-200 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </button>

                <!-- Mobile Menu Button (for future mobile admin sidebar) -->
                <button id="mobile-menu-button" class="md:hidden p-2 rounded-full bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors duration-200 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
            </div>
        </div>

        <!-- Search Input (Hidden by default) -->
        <div id="search-container" class="mt-4 hidden">
            <input type="text" id="search-input" placeholder="ابحث عن المنتجات..." class="w-full p-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500" data-lang-ar-placeholder="ابحث عن المنتجات..." data-lang-en-placeholder="Search for products...">
        </div>

        <!-- Mobile Menu (Hidden by default - now for admin sidebar toggle) -->
        <div id="mobile-menu" class="md:hidden mt-4 bg-white dark:bg-gray-800 rounded-md shadow-lg py-2 hidden">
            <!-- Mobile Admin Sidebar will be injected here if needed -->
            <ul class="space-y-2 px-4">
                <li><button class="admin-sidebar-link w-full text-right px-4 py-2 rounded-md font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200" data-target-section="home-dashboard" data-lang-ar="الرئيسية" data-lang-en="Home">الرئيسية</button></li>
                <li><button class="admin-sidebar-link w-full text-right px-4 py-2 rounded-md font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200" data-target-section="products-management" data-lang-ar="المنتجات" data-lang-en="Products">المنتجات</button></li>
                <li><button class="admin-sidebar-link w-full text-right px-4 py-2 rounded-md font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200" data-target-section="orders-management" data-lang-ar="الطلبات" data-lang-en="Orders">الطلبات</button></li>
                <li><button class="admin-sidebar-link w-full text-right px-4 py-2 rounded-md font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200" data-target-section="users-management" data-lang-ar="العملاء" data-lang-en="Customers">العملاء</button></li>
                <li><button class="admin-sidebar-link w-full text-right px-4 py-2 rounded-md font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200" data-target-section="discounts-management" data-lang-ar="الخصومات" data-lang-en="Discounts">الخصومات</button></li>
                <li><button class="admin-sidebar-link w-full text-right px-4 py-2 rounded-md font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200" data-target-section="online-store-management" data-lang-ar="المتجر الإلكتروني" data-lang-en="Online Store">المتجر الإلكتروني</button></li>
                <li><button class="admin-sidebar-link w-full text-right px-4 py-2 rounded-md font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200" data-target-section="settings-management" data-lang-ar="الإعدادات" data-lang-en="Settings">الإعدادات</button></li>
            </ul>
        </div>
    </header>
