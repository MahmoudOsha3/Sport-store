<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('website/productdetails.css') }}">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- @yield('css') --}}
    @include('layouts.website.style')
</head>
<body class="bg-gray-100 text-gray-800 transition-colors duration-300">

    <!-- Header Section -->
    {{-- @include('layouts.website.nav') --}}
    <x-nav-site  name="ali"/>


    @yield('content')

    @include('layouts.website.footer')

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const html = document.documentElement;
            const themeToggle = document.getElementById('theme-toggle');
            const sunIcon = document.getElementById('sun-icon');
            const moonIcon = document.getElementById('moon-icon');
            const searchToggle = document.getElementById('search-toggle');
            const searchContainer = document.getElementById('search-container');
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            const usernameDisplay = document.getElementById('username-display');
            const mobileUsernameDisplay = document.getElementById('mobile-username-display');

            // Language elements
            const langDropdownBtn = document.getElementById('lang-dropdown-btn');
            const langDropdown = document.querySelector('.language-dropdown');
            const langOptions = document.querySelectorAll('.language-dropdown-content a');
            const currentLangDisplay = document.querySelector('.current-lang-display');

            // Cart elements
            const cartItemsContainer = document.getElementById('cart-items');
            const cartCountSpan = document.getElementById('cart-count');
            const cartTotalSpan = document.getElementById('cart-total');
            const emptyCartMessage = document.querySelector('.empty-cart-message');
            const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');

            // About Us tabs
            const tabTitles = document.querySelectorAll('.tab-title');
            const tabContents = document.querySelectorAll('.tab-content');

            // Product Slider elements
            const productSlider = document.getElementById('product-slider');
            const prevButton = document.getElementById('prev-button');
            const nextButton = document.getElementById('next-button');


            // Initialize cart from localStorage or empty array
            let cart = JSON.parse(localStorage.getItem('cart')) || [];

            // --- Theme Toggle Functionality ---
            const currentTheme = localStorage.getItem('theme');
            if (currentTheme === 'dark') {
                html.classList.add('dark');
                moonIcon.classList.remove('hidden');
                sunIcon.classList.add('hidden');
            } else {
                html.classList.remove('dark');
                sunIcon.classList.remove('hidden');
                moonIcon.classList.add('hidden');
            }

            themeToggle.addEventListener('click', () => {
                html.classList.toggle('dark');
                if (html.classList.contains('dark')) {
                    localStorage.setItem('theme', 'dark');
                    moonIcon.classList.remove('hidden');
                    sunIcon.classList.add('hidden');
                } else {
                    localStorage.setItem('theme', 'light');
                    sunIcon.classList.remove('hidden');
                    moonIcon.classList.add('hidden');
                }
            });

            // --- Search Toggle Functionality ---
            searchToggle.addEventListener('click', () => {
                searchContainer.classList.toggle('hidden');
                if (!searchContainer.classList.contains('hidden')) {
                    document.getElementById('search-input').focus();
                }
            });

            // --- Mobile Menu Toggle Functionality ---
            mobileMenuButton.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });

            // --- User Login Simulation (Placeholder) ---
            // In a real app, this would come from authentication
            const isLoggedIn = true; // Simulate logged-in user
            const userName = "أحمد"; // Example user name

            if (isLoggedIn) {
                usernameDisplay.textContent = `مرحباً، ${userName}`;
                usernameDisplay.classList.remove('hidden');
                mobileUsernameDisplay.textContent = `مرحباً، ${userName}`;
                mobileUsernameDisplay.classList.remove('hidden');
            }

            // --- Language Switcher Functionality ---
            let currentLang = localStorage.getItem('lang') || 'ar'; // Default to Arabic

            // Function to apply language to all elements
            function setLanguage(lang) {
                currentLang = lang;
                html.lang = lang;
                html.dir = (lang === 'ar') ? 'rtl' : 'ltr';

                // Update text content for elements with data-lang attributes
                document.querySelectorAll('[data-lang-ar], [data-lang-en]').forEach(element => {
                    if (lang === 'ar' && element.dataset.langAr) {
                        if (element.tagName === 'INPUT' && element.hasAttribute('placeholder')) {
                            element.placeholder = element.dataset.langAr;
                        } else {
                            element.textContent = element.dataset.langAr;
                        }
                    } else if (lang === 'en' && element.dataset.langEn) {
                        if (element.tagName === 'INPUT' && element.hasAttribute('placeholder')) {
                            element.placeholder = element.dataset.langEn;
                        } else {
                            element.textContent = element.dataset.langEn;
                        }
                    }
                });

                // Update current language display in dropdown button
                currentLangDisplay.textContent = lang === 'ar' ? currentLangDisplay.dataset.langAr : currentLangDisplay.dataset.langEn;

                // Adjust dropdown content alignment based on direction
                const dropdownContent = document.querySelector('.language-dropdown-content');
                if (lang === 'ar') {
                    dropdownContent.style.right = '0';
                    dropdownContent.style.left = 'auto';
                } else {
                    dropdownContent.style.left = '0';
                    dropdownContent.style.right = 'auto';
                }

                // Save selected language to localStorage
                localStorage.setItem('lang', lang);
                // Re-render cart to update language of cart items
                renderCart();
            }

            // Toggle language dropdown visibility
            langDropdownBtn.addEventListener('click', (event) => {
                langDropdown.classList.toggle('show');
                event.stopPropagation(); // Prevent document click from closing immediately
            });

            // Handle language selection
            langOptions.forEach(option => {
                option.addEventListener('click', (event) => {
                    event.preventDefault();
                    const selectedLang = event.target.dataset.langOption;
                    setLanguage(selectedLang);
                    langDropdown.classList.remove('show'); // Hide dropdown after selection
                });
            });

            // Close language dropdown if clicked outside
            document.addEventListener('click', (event) => {
                if (!langDropdown.contains(event.target)) {
                    langDropdown.classList.remove('show');
                }
            });

            // Apply initial language setting
            setLanguage(currentLang);


            // --- Shopping Cart Functionality ---

            // Function to render cart items in the dropdown
            function renderCart() {
                cartItemsContainer.innerHTML = ''; // Clear existing items
                let total = 0;
                let itemCount = 0;

                if (cart.length === 0) {
                    emptyCartMessage.classList.remove('hidden');
                } else {
                    emptyCartMessage.classList.add('hidden');
                    cart.forEach(item => {
                        const itemElement = document.createElement('div');
                        itemElement.classList.add('flex', 'justify-between', 'items-center', 'py-2', 'border-b', 'border-gray-200', 'dark:border-gray-700');
                        itemElement.innerHTML = `
                            <div>
                                <p class="font-semibold text-gray-800 dark:text-gray-100">${currentLang === 'ar' ? item.name_ar : item.name_en}</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    <span data-lang-ar="الكمية:" data-lang-en="Qty:">الكمية:</span> ${item.quantity} | SAR ${(item.price * item.quantity).toFixed(2)}
                                </p>
                            </div>
                            <div class="flex items-center space-x-2 rtl:space-x-reverse">
                                <button class="qty-decrease-btn text-gray-700 dark:text-gray-200 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 rounded-full w-6 h-6 flex items-center justify-center text-lg font-bold" data-product-id="${item.id}">-</button>
                                <span class="text-gray-800 dark:text-gray-100 font-semibold">${item.quantity}</span>
                                <button class="qty-increase-btn text-gray-700 dark:text-gray-200 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 rounded-full w-6 h-6 flex items-center justify-center text-lg font-bold" data-product-id="${item.id}">+</button>
                            </div>
                        `;
                        cartItemsContainer.appendChild(itemElement);
                        total += item.price * item.quantity;
                        itemCount += item.quantity;
                    });
                }

                cartCountSpan.textContent = itemCount;
                cartTotalSpan.textContent = `SAR ${total.toFixed(2)}`;

                // Save cart to localStorage
                localStorage.setItem('cart', JSON.stringify(cart));
            }

            // Add to cart event listener
            addToCartButtons.forEach(button => {
                button.addEventListener('click', (event) => {
                    const productId = event.target.dataset.productId;
                    const productNameAr = event.target.dataset.productNameAr;
                    const productNameEn = event.target.dataset.productNameEn;
                    const productPrice = parseFloat(event.target.dataset.productPrice);

                    const existingItem = cart.find(item => item.id === productId);

                    if (existingItem) {
                        existingItem.quantity++;
                    } else {
                        cart.push({
                            id: productId,
                            name_ar: productNameAr,
                            name_en: productNameEn,
                            price: productPrice,
                            quantity: 1
                        });
                    }
                    renderCart();
                });
            });

            // Quantity change event listeners (delegated for dynamically added elements)
            cartItemsContainer.addEventListener('click', (event) => {
                const target = event.target;
                if (target.classList.contains('qty-decrease-btn')) {
                    const productId = target.dataset.productId;
                    const itemIndex = cart.findIndex(item => item.id === productId);
                    if (itemIndex > -1 && cart[itemIndex].quantity > 1) {
                        cart[itemIndex].quantity--;
                        renderCart();
                    } else if (itemIndex > -1 && cart[itemIndex].quantity === 1) {
                        // Optionally remove item if quantity becomes 0
                        cart.splice(itemIndex, 1);
                        renderCart();
                    }
                } else if (target.classList.contains('qty-increase-btn')) {
                    const productId = target.dataset.productId;
                    const itemIndex = cart.findIndex(item => item.id === productId);
                    if (itemIndex > -1) {
                        cart[itemIndex].quantity++;
                        renderCart();
                    }
                }
            });

            // Initial render of the cart when the page loads
            renderCart();

            // --- About Us Tab Functionality ---
            tabTitles.forEach(title => {
                title.addEventListener('click', (event) => {
                    // Remove active class from all titles and hide all contents
                    tabTitles.forEach(t => t.classList.remove('active'));
                    tabContents.forEach(c => c.classList.add('hidden'));

                    // Add active class to clicked title
                    event.target.classList.add('active');

                    // Show corresponding content
                    const tabId = event.target.dataset.tab;
                    document.getElementById(`tab-content-${tabId}`).classList.remove('hidden');
                });
            });

            // Ensure initial active tab is set on load
            const initialActiveTab = document.querySelector('.tab-title.active');
            if (initialActiveTab) {
                const tabId = initialActiveTab.dataset.tab;
                document.getElementById(`tab-content-${tabId}`).classList.remove('hidden');
            }

            // --- Product Slider Navigation Functionality ---
            const scrollAmount = 300; // Adjust scroll amount as needed

            prevButton.addEventListener('click', () => {
                // Scroll left by the scrollAmount
                productSlider.scrollBy({
                    left: -scrollAmount,
                    behavior: 'smooth'
                });
            });

            nextButton.addEventListener('click', () => {
                // Scroll right by the scrollAmount
                productSlider.scrollBy({
                    left: scrollAmount,
                    behavior: 'smooth'
                });
            });
        });
    </script>
    @yield('js')
</body>
</html>
