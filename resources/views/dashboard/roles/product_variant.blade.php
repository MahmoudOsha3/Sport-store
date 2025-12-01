<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>واجهة المتجر</title>
    <!-- تضمين Tailwind CSS من خلال CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
        }
        /* تصميم القائمة المنسدلة (الدروب داون) لسلة التسوق */
        #cart-dropdown {
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translateX(50%);
        }
        @media (min-width: 768px) {
            #cart-dropdown {
                left: unset;
                right: 0;
                transform: translateX(0);
            }
        }
        /* إخفاء شريط التمرير الأفقي مع الحفاظ على وظيفته */
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .hide-scrollbar {
            -ms-overflow-style: none; /* IE and Edge */
            scrollbar-width: none; /* Firefox */
        }
        .product-card {
            min-width: 288px; /* w-72 */
            max-width: 320px; /* sm:w-80 */
        }
    </style>
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 min-h-screen flex flex-col">

    <!-- شريط التنقل العلوي (Header) -->
    <header class="bg-white dark:bg-gray-800 shadow-md sticky top-0 z-50">
        <div class="container mx-auto max-w-7xl px-6 py-4 flex justify-between items-center">
            <!-- شعار الموقع -->
            <a href="#" class="text-2xl font-bold text-gray-900 dark:text-white">
                Milano
            </a>
            <!-- أيقونات المستخدم -->
            <div class="flex items-center space-x-4 rtl:space-x-reverse">
                <!-- أيقونة سلة التسوق -->
                <div class="relative">
                    <button id="cart-btn" class="relative p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 transition duration-300">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h18l-1.68 9.39a2 2 0 01-1.99 1.61H6.67a2 2 0 01-1.99-1.61L3 3zm0 0v18m3-18l1.68 9.39a2 2 0 011.99 1.61h6.66a2 2 0 011.99-1.61L21 3M9 13.5h6m-3-3v6"></path>
                        </svg>
                        <span id="cart-count" class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">3</span>
                    </button>
                    <!-- قائمة سلة التسوق المنسدلة (مخفية بشكل افتراضي) -->
                    <div id="cart-dropdown" class="hidden w-80 max-h-96 overflow-y-auto bg-white dark:bg-gray-800 rounded-md shadow-lg py-2 mt-2 z-50">
                        <div id="cart-items-container">
                            <!-- سيتم إضافة عناصر السلة هنا بواسطة JS -->
                        </div>
                        <div class="border-t border-gray-200 dark:border-gray-700 mx-4 mt-2 pt-2 flex justify-between items-center font-bold text-lg">
                            <span>الإجمالي:</span>
                            <span id="cart-total-price">0 جنيه</span>
                        </div>
                        <div class="p-4">
                            <a href="#" class="block w-full text-center bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700 transition-colors">
                                إتمام الشراء
                            </a>
                        </div>
                    </div>
                </div>
                <!-- أيقونة الحساب -->
                <a href="#" class="p-2 flex items-center space-x-2 rtl:space-x-reverse rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 transition duration-300">
                    <img src="https://placehold.co/32x32/1e40af/ffffff?text=U" class="h-8 w-8 rounded-full object-cover border-2 border-indigo-600" alt="صورة المستخدم">
                    <span class="font-medium text-sm hidden md:block">أحمد</span>
                </a>
                <!-- أيقونة تسجيل الخروج -->
                <a href="#" class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 transition duration-300" title="تسجيل الخروج">
                    <svg class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                </a>
            </div>
        </div>
    </header>

    <!-- المحتوى الرئيسي (Sidebar + Products) -->
    <main class="flex-1">
        {{-- <div class="container mx-auto max-w-7xl p-4 md:p-6 flex flex-col md:flex-row gap-6"> --}}
        <div class="container mx-auto  p-4 md:p-6 flex flex-col md:flex-row gap-6">


            <!-- الشريط الجانبي (Sidebar) -->
            <aside class="md:w-1/3 bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 hidden md:block">
                <h3 class="text-xl font-bold mb-4 border-b pb-2 border-gray-200 dark:border-gray-700">أقسام المتجر</h3>
                <ul class="space-y-4">
                    <!-- قسم الملابس -->
                    <li>
                        <a href="#" class="flex items-center justify-between text-lg font-semibold text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400">
                            ملابس
                            <svg class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                        <ul class="mt-2 space-y-2 text-sm text-gray-500 dark:text-gray-400">
                            <li>
                                <a href="#" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">
                                    تيشيرتات
                                </a>
                            </li>
                            <li>
                                <a href="#" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">
                                    بناطيل
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- قسم الأندية -->
                    <li>
                        <a href="#" class="flex items-center justify-between text-lg font-semibold text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400">
                            فرق كرة القدم
                            <svg class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                        <ul class="mt-2 space-y-2 text-sm text-gray-500 dark:text-gray-400">
                            <li>
                                <a href="#" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">
                                    مانشستر يونايتد
                                </a>
                            </li>
                            <li>
                                <a href="#" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">
                                    ريال مدريد
                                </a>
                            </li>
                            <li>
                                <a href="#" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">
                                    الأهلي
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- قسم الاكسسوارات -->
                    <li>
                        <a href="#" class="text-lg font-semibold text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400">
                            إكسسوارات رياضية
                        </a>
                    </li>
                </ul>
            </aside>

            <!-- منطقة المحتوى الرئيسية -->
            <section class="flex-1 space-y-8">

                <!-- قسم الصورة الرئيسية (Hero Section) -->
                <div class="relative w-full h-80 sm:h-96 md:h-[400px] rounded-lg overflow-hidden shadow-lg" >
                    <img src="https://placehold.co/1200x400/1e40af/ffffff?text=ملابس+رياضية" alt="صورة إبداعية للمتجر" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center p-4">
                        <div class="text-center text-white">
                            <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold mb-2">أفضل الملابس الرياضية</h1>
                            <p class="text-base sm:text-lg md:text-xl font-medium">تسوق الآن واكتشف أناقتك الرياضية</p>
                        </div>
                    </div>
                </div>

                <!-- قسم الأقسام الرئيسية -->
                <div class="space-y-4">
                    <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white">الأقسام الرئيسية</h2>
                    <div id="main-categories-container" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6" >
                        <!-- سيتم إضافة بطاقات الأقسام هنا بواسطة JS -->
                    </div>
                </div>

                <!-- قسم المنتجات -->
                <div class="space-y-4" style="width: 1200px">
                    <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white">أحدث المنتجات</h2>
                    <!-- شبكة المنتجات الأفقية (المنتجات المعروضة) -->
                    <div id="products-container" class="flex overflow-x-auto hide-scrollbar snap-x snap-mandatory pb-4 gap-6">
                        <!-- سيتم إضافة بطاقات المنتجات هنا بواسطة JS -->
                    </div>
                </div>

                <!-- قسم نبذة عن المتجر والفروع -->
                <section class="space-y-6 pt-8">
                    <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white">نبذة عن متجر ميلانو</h2>
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                        <p class="text-gray-700 dark:text-gray-300 leading-relaxed text-base md:text-lg">
                            متجر ميلانو هو وجهتك الأولى للملابس الرياضية العصرية والأنيقة. نقدم تشكيلة واسعة من أحدث التصميمات والمنتجات عالية الجودة لتناسب جميع الأذواق والرياضات. نحن نؤمن بأن الأداء يبدأ من الأناقة، ولهذا نسعى لتقديم أفضل المنتجات التي تجمع بين الجودة والراحة والتصميم المميز.
                        </p>
                    </div>
                    <h3 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white">عناوين فروعنا</h3>
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-md">
                            <p class="font-semibold text-lg">الفرع الرئيسي - القاهرة</p>
                            <p class="text-gray-600 dark:text-gray-400">شارع النصر، مدينة نصر، القاهرة</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-md">
                            <p class="font-semibold text-lg">فرع الإسكندرية</p>
                            <p class="text-gray-600 dark:text-gray-400">شارع البحر، سيدي جابر، الإسكندرية</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-md">
                            <p class="font-semibold text-lg">فرع الجيزة</p>
                            <p class="text-gray-600 dark:text-gray-400">شارع الهرم، الجيزة</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-md">
                            <p class="font-semibold text-lg">فرع المنصورة</p>
                            <p class="text-gray-600 dark:text-gray-400">شارع الجمهورية، المنصورة</p>
                        </div>
                    </div>
                </section>
            </section>
        </div>
    </main>

    <!-- فوتر (Footer) -->
    <footer class="bg-gray-900 dark:bg-gray-950 text-gray-400 py-10 mt-12">
        <div class="container mx-auto max-w-7xl px-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
            <!-- نبذة عن المتجر -->
            <div class="col-span-1 md:col-span-2">
                <h3 class="text-white text-xl font-bold mb-4">Milano</h3>
                <p>وجهتك المثالية للملابس الرياضية العصرية والعملية. نحن نسعى لتقديم أفضل جودة وتصميم يواكب أحدث صيحات الموضة العالمية.</p>
            </div>
            <!-- روابط سريعة -->
            <div>
                <h4 class="text-white text-lg font-semibold mb-4">روابط سريعة</h4>
                <ul class="space-y-2">
                    <li><a href="#" class="hover:text-white transition-colors">عنا</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">الأقسام</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">اتصل بنا</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">سياسة الخصوصية</a></li>
                </ul>
            </div>
            <!-- تواصل معنا -->
            <div>
                <h4 class="text-white text-lg font-semibold mb-4">تواصل معنا</h4>
                <p class="flex items-center space-x-2 rtl:space-x-reverse mb-2"><span class="ml-2">البريد الإلكتروني:</span> info@milano.com</p>
                <p class="flex items-center space-x-2 rtl:space-x-reverse"><span>الهاتف:</span> +20 100 123 4567</p>
            </div>
        </div>
        <!-- حقوق النشر -->
        <div class="text-center text-sm text-gray-500 mt-8 border-t border-gray-800 pt-4">
            &copy; 2024 Milano. جميع الحقوق محفوظة.
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const cartBtn = document.getElementById('cart-btn');
            const cartDropdown = document.getElementById('cart-dropdown');
            const cartItemsContainer = document.getElementById('cart-items-container');
            const cartTotalPrice = document.getElementById('cart-total-price');
            const cartCount = document.getElementById('cart-count');
            const mainCategoriesContainer = document.getElementById('main-categories-container');
            const productsContainer = document.getElementById('products-container');

            // بيانات سلة التسوق التجريبية
            const cartItems = [{
                name: 'تيشيرت رياضي رجالي',
                image: 'https://placehold.co/64x64/2563eb/ffffff?text=T-shirt',
                price: 150,
                quantity: 2
            }, {
                name: 'شورت رياضي',
                image: 'https://placehold.co/64x64/2563eb/ffffff?text=Shorts',
                price: 100,
                quantity: 1
            }, {
                name: 'كاب رياضي',
                image: 'https://placehold.co/64x64/2563eb/ffffff?text=Cap',
                price: 75,
                quantity: 1
            }, ];

            // بيانات الأقسام الرئيسية
            const mainCategories = [{
                title: 'إكسسوارات',
                image: 'https://placehold.co/400x250/d2691e/ffffff?text=Accessories',
                link: '#'
            }, {
                title: 'ملابس كرة قدم',
                image: 'https://placehold.co/400x250/2563eb/ffffff?text=Football+Apparel',
                link: '#'
            }, {
                title: 'ملابس النجوم',
                image: 'https://placehold.co/400x250/6b21a8/ffffff?text=Stars',
                link: '#'
            }, ];

            // بيانات المنتجات
            const products = [{
                name: 'تيشيرت رياضي رجالي',
                image: 'https://placehold.co/400x400/2563eb/ffffff?text=تيشيرت',
                description: 'تيشيرت بتصميم عصري ومريح.',
                price: 150,
                status: 'متوفر'
            }, {
                name: 'شورت رياضي',
                image: 'https://placehold.co/400x400/2563eb/ffffff?text=شورت',
                description: 'شورت خفيف ومناسب للتمارين.',
                price: 100,
                status: 'متوفر'
            }, {
                name: 'كاب رياضي',
                image: 'https://placehold.co/400x400/2563eb/ffffff?text=كاب',
                description: 'كاب أنيق لحماية الرأس.',
                price: 75,
                status: 'متوفر'
            }, {
                name: 'حذاء جري',
                image: 'https://placehold.co/400x400/2563eb/ffffff?text=حذاء',
                description: 'حذاء مريح وخفيف للمشي والجري.',
                price: 500,
                status: 'غير متوفر'
            }, {
                name: 'جورب رياضي',
                image: 'https://placehold.co/400x400/2563eb/ffffff?text=جورب',
                description: 'جوارب عالية الجودة.',
                price: 30,
                status: 'متوفر'
            }, {
                name: 'قميص تدريب',
                image: 'https://placehold.co/400x400/2563eb/ffffff?text=قميص',
                description: 'قميص مصمم للتدريبات الشاقة.',
                price: 220,
                status: 'متوفر'
            }, ];

            // وظيفة لعرض محتوى سلة التسوق
            function renderCart() {
                cartItemsContainer.innerHTML = '';
                let total = 0;
                cartItems.forEach(item => {
                    const itemElement = document.createElement('div');
                    itemElement.className = 'flex items-center space-x-4 rtl:space-x-reverse py-2 px-4 border-b border-gray-100 dark:border-gray-700 last:border-b-0';
                    itemElement.innerHTML = `
                        <img src="${item.image}" alt="${item.name}" class="h-12 w-12 rounded-lg object-cover">
                        <div class="flex-1">
                            <p class="text-sm font-semibold truncate">${item.name}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">الكمية: ${item.quantity}</p>
                        </div>
                        <span class="font-bold text-gray-900 dark:text-gray-100">${(item.price * item.quantity).toFixed(2)} جنيه</span>
                    `;
                    cartItemsContainer.appendChild(itemElement);
                    total += item.price * item.quantity;
                });
                cartTotalPrice.textContent = `${total.toFixed(2)} جنيه`;
                cartCount.textContent = cartItems.length;
            }

            // وظيفة لإظهار/إخفاء سلة التسوق
            function toggleCartDropdown() {
                cartDropdown.classList.toggle('hidden');
                if (!cartDropdown.classList.contains('hidden')) {
                    renderCart();
                }
            }

            // وظيفة لعرض بطاقات الأقسام الرئيسية
            function renderMainCategories() {
                mainCategoriesContainer.innerHTML = '';
                mainCategories.forEach(category => {
                    const cardElement = document.createElement('div');
                    cardElement.className = 'bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden transition-transform transform hover:scale-105 duration-300';
                    cardElement.innerHTML = `
                        <a href="${category.link}">
                            <img src="${category.image}" alt="${category.title}" class="w-full h-40 object-cover">
                            <div class="p-4 text-center">
                                <h4 class="text-xl font-bold">${category.title}</h4>
                            </div>
                        </a>
                    `;
                    mainCategoriesContainer.appendChild(cardElement);
                });
            }

            // وظيفة لعرض بطاقات المنتجات
            function renderProducts() {
                productsContainer.innerHTML = '';
                products.forEach(product => {
                    const cardElement = document.createElement('div');
                    const isAvailable = product.status === 'متوفر';
                    const buttonClasses = isAvailable ? 'bg-indigo-600 text-white hover:bg-indigo-700' : 'bg-gray-400 text-white cursor-not-allowed';
                    const statusClasses = isAvailable ? 'text-green-600' : 'text-red-600';

                    cardElement.className = 'flex-none product-card bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden transition-transform transform hover:scale-105 duration-300 snap-center';
                    cardElement.innerHTML = `
                        <a href="#">
                            <img src="${product.image}" alt="${product.name}" class="w-full h-48 object-cover">
                        </a>
                        <div class="p-4">
                            <h4 class="text-lg font-semibold mb-2 truncate">${product.name}</h4>
                            <p class="text-gray-600 dark:text-gray-400 text-sm mb-2">${product.description}</p>
                            <div class="flex justify-between items-center mb-4">
                                <span class="text-xl font-bold text-gray-900 dark:text-white">${product.price} جنيه</span>
                                <span class="text-sm font-medium ${statusClasses}">${product.status}</span>
                            </div>
                            <button class="w-full py-2 rounded-md transition-colors ${buttonClasses}" ${!isAvailable ? 'disabled' : ''}>
                                أضف إلى السلة
                            </button>
                        </div>
                    `;
                    productsContainer.appendChild(cardElement);
                });
            }

            // حدث عند النقر على أيقونة السلة
            cartBtn.addEventListener('click', toggleCartDropdown);

            // إخفاء سلة التسوق عند النقر خارجها
            document.addEventListener('click', (event) => {
                if (!cartBtn.contains(event.target) && !cartDropdown.contains(event.target)) {
                    cartDropdown.classList.add('hidden');
                }
            });

            // عرض محتوى السلة والأقسام والمنتجات عند تحميل الصفحة
            renderCart();
            renderMainCategories();
            renderProducts();
        });
    </script>
</body>
</html>
