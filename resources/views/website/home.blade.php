@extends('layouts.website.app')

@section('title' , 'ميلانو ستور')
@section('content')
    <!-- Hero Section -->
    <section class="relative h-96 md:h-[500px] bg-cover bg-center flex items-center justify-center text-white text-center rounded-lg mx-auto mt-6" style="background-image: url('https://placehold.co/1200x500/1e3a8a/ffffff?text=Sports+Apparel+Hero')" aria-label="Hero Section">
        <div class="absolute inset-0 bg-black opacity-50 rounded-lg"></div>
        <div class="relative z-10 p-4">
            <h1 class="text-4xl md:text-6xl font-bold mb-4" data-lang-ar="أفضل الملابس الرياضية" data-lang-en="Best Sports Apparel">أفضل الملابس الرياضية</h1>
            <p class="text-lg md:text-xl mb-8" data-lang-ar="اكتشف مجموعتنا الواسعة من الملابس الرياضية عالية الجودة." data-lang-en="Discover our wide range of high-quality sports apparel.">اكتشف مجموعتنا الواسعة من الملابس الرياضية عالية الجودة.</p>
            <a href="#products-section" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-full transition-colors duration-300 transform hover:scale-105 inline-block" data-lang-ar="تسوق الآن" data-lang-en="Shop Now">تسوق الآن</a>
        </div>
    </section>

        <!-- Categories Section -->
    <section class="container mx-auto py-12 px-6 md:px-10">
        <h2 class="text-3xl font-bold text-center mb-8" data-lang-ar="تصفح حسب الفئة" data-lang-en="Browse by Category">تصفح حسب الفئة</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Category Card 1 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden transform hover:scale-105 transition-transform duration-300 dark:bg-gray-800">
                <img src="https://placehold.co/400x250/3b82f6/ffffff?text=T-Shirts" alt="T-Shirts Category" class="w-full h-48 object-cover">
                <div class="p-4 text-center">
                    <h3 class="text-xl font-semibold mb-2" data-lang-ar="تي شيرتات" data-lang-en="T-Shirts">تي شيرتات</h3>
                    <p class="text-gray-600 text-sm dark:text-gray-400" data-lang-ar="مجموعة واسعة من التي شيرتات الرياضية." data-lang-en="A wide range of sports t-shirts.">مجموعة واسعة من التي شيرتات الرياضية.</p>
                    <a href="#" class="mt-4 inline-block text-indigo-600 hover:underline font-medium" data-lang-ar="تسوق الآن" data-lang-en="Shop Now">تسوق الآن</a>
                </div>
            </div>
            <!-- Category Card 2 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden transform hover:scale-105 transition-transform duration-300 dark:bg-gray-800">
                <img src="https://placehold.co/400x250/22c55e/ffffff?text=Shoes" alt="Shoes Category" class="w-full h-48 object-cover">
                <div class="p-4 text-center">
                    <h3 class="text-xl font-semibold mb-2" data-lang-ar="أحذية رياضية" data-lang-en="Sport Shoes">أحذية رياضية</h3>
                    <p class="text-gray-600 text-sm dark:text-gray-400" data-lang-ar="أحذية مريحة وعالية الأداء لكل رياضة." data-lang-en="Comfortable and high-performance shoes for every sport.">أحذية مريحة وعالية الأداء لكل رياضة.</p>
                    <a href="#" class="mt-4 inline-block text-indigo-600 hover:underline font-medium" data-lang-ar="تسوق الآن" data-lang-en="Shop Now">تسوق الآن</a>
                </div>
            </div>
            <!-- Category Card 3 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden transform hover:scale-105 transition-transform duration-300 dark:bg-gray-800">
                <img src="https://placehold.co/400x250/ef4444/ffffff?text=Shorts" alt="Shorts Category" class="w-full h-48 object-cover">
                <div class="p-4 text-center">
                    <h3 class="text-xl font-semibold mb-2" data-lang-ar="شورتات" data-lang-en="Shorts">شورتات</h3>
                    <p class="text-gray-600 text-sm dark:text-gray-400" data-lang-ar="شورتات خفيفة ومريحة للتدريب." data-lang-en="Light and comfortable shorts for training.">شورتات خفيفة ومريحة للتدريب.</p>
                    <a href="#" class="mt-4 inline-block text-indigo-600 hover:underline font-medium" data-lang-ar="تسوق الآن" data-lang-en="Shop Now">تسوق الآن</a>
                </div>
            </div>
            <!-- Category Card 4 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden transform hover:scale-105 transition-transform duration-300 dark:bg-gray-800">
                <img src="https://placehold.co/400x250/f97316/ffffff?text=Jackets" alt="Jackets Category" class="w-full h-48 object-cover">
                <div class="p-4 text-center">
                    <h3 class="text-xl font-semibold mb-2" data-lang-ar="جاكيتات" data-lang-en="Jackets">جاكيتات</h3>
                    <p class="text-gray-600 text-sm dark:text-gray-400" data-lang-ar="جاكيتات عصرية وعملية لجميع الأجواء." data-lang-en="Stylish and practical jackets for all weather.">جاكيتات عصرية وعملية لجميع الأجواء.</p>
                    <a href="#" class="mt-4 inline-block text-indigo-600 hover:underline font-medium" data-lang-ar="تسوق الآن" data-lang-en="Shop Now">تسوق الآن</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products Section (Now a Slider) -->
    <section id="products-section" class="container mx-auto py-12 px-6 md:px-10">
        <h2 class="text-3xl font-bold text-center mb-8" data-lang-ar="منتجات مميزة" data-lang-en="Featured Products">منتجات مميزة</h2>
        <div class="relative">
            <div id="product-slider" class="flex overflow-x-scroll no-scrollbar snap-x snap-mandatory space-x-6 pb-4">
                @foreach ($products as $product)
                    <x-cart-product :title="$product->title"
                                    :price="$product->price"
                                    :image="$product->image"
                                    :description="$product->description"
                                    :id="$product->id" />
                @endforeach
            </div>
            <!-- Slider Navigation Buttons -->
            <button id="prev-button" class="absolute top-1/2 -translate-y-1/2 left-0 bg-white rounded-full p-2 shadow-md hover:bg-gray-200 transition-colors duration-200 z-10 dark:bg-gray-700 dark:hover:bg-gray-600">
                <svg class="w-6 h-6 text-gray-800 dark:text-gray-200 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            </button>
            <button id="next-button" class="absolute top-1/2 -translate-y-1/2 right-0 bg-white rounded-full p-2 shadow-md hover:bg-gray-200 transition-colors duration-200 z-10 dark:bg-gray-700 dark:hover:bg-gray-600">
                <svg class="w-6 h-6 text-gray-800 dark:text-gray-200 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </button>
        </div>
    </section>

    <!-- About Us / Brand Details Section -->
    <section class="container mx-auto py-12 px-4">
        <h2 class="text-3xl md:text-4xl font-bold text-center mb-10 text-gray-800 dark:text-gray-100" data-lang-ar="من نحن" data-lang-en="About Us">من نحن</h2>
        <div class="flex flex-col md:flex-row items-center gap-8 bg-white dark:bg-gray-800 rounded-lg shadow-md p-8">
            <!-- Image Section -->
            <div class="md:w-1/2 w-full">
                <img src="https://placehold.co/600x400/6b7280/ffffff?text=Our+Brand" alt="Our Brand" class="rounded-lg shadow-lg w-full h-auto">
            </div>
            <!-- Text Content Section -->
            <div class="md:w-1/2 w-full">
                <div class="flex border-b border-gray-200 dark:border-gray-700 mb-4">
                    <button class="tab-title px-4 py-2 text-lg font-medium text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors duration-200 active" data-tab="mission" data-lang-ar="مهمتنا" data-lang-en="Our Mission">مهمتنا</button>
                    <button class="tab-title px-4 py-2 text-lg font-medium text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors duration-200" data-tab="vision" data-lang-ar="رؤيتنا" data-lang-en="Our Vision">رؤيتنا</button>
                    <button class="tab-title px-4 py-2 text-lg font-medium text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors duration-200" data-tab="values" data-lang-ar="قيمنا" data-lang-en="Our Values">قيمنا</button>
                </div>
                <div id="tab-content-mission" class="tab-content text-gray-700 dark:text-gray-300">
                    <p class="mb-4" data-lang-ar="مهمتنا هي تمكين الرياضيين من جميع المستويات من خلال توفير ملابس رياضية عالية الجودة ومبتكرة تعزز الأداء والراحة. نحن نؤمن بأن كل شخص يستحق الشعور بالثقة والتميز أثناء ممارسة الرياضة." data-lang-en="Our mission is to empower athletes of all levels by providing high-quality, innovative sportswear that enhances performance and comfort. We believe everyone deserves to feel confident and excel in their athletic pursuits.">مهمتنا هي تمكين الرياضيين من جميع المستويات من خلال توفير ملابس رياضية عالية الجودة ومبتكرة تعزز الأداء والراحة. نحن نؤمن بأن كل شخص يستحق الشعور بالثقة والتميز أثناء ممارسة الرياضة.</p>
                </div>
                <div id="tab-content-vision" class="tab-content text-gray-700 dark:text-gray-300 hidden">
                    <p class="mb-4" data-lang-ar="رؤيتنا هي أن نصبح العلامة التجارية الرائدة للملابس الرياضية في المنطقة، وأن نلهم مجتمعًا صحيًا ونشطًا من خلال منتجاتنا وقيمنا." data-lang-en="Our vision is to become the leading sportswear brand in the region, inspiring a healthy and active community through our products and values.">رؤيتنا هي أن نصبح العلامة التجارية الرائدة للملابس الرياضية في المنطقة، وأن نلهم مجتمعًا صحيًا ونشطًا من خلال منتجاتنا وقيمنا.</p>
                </div>
                <div id="tab-content-values" class="tab-content text-gray-700 dark:text-gray-300 hidden">
                    <ul class="list-disc list-inside space-y-2">
                        <li data-lang-ar="الجودة: الالتزام بتقديم منتجات متينة ومصممة بعناية." data-lang-en="Quality: Commitment to delivering durable and thoughtfully designed products.">الجودة: الالتزام بتقديم منتجات متينة ومصممة بعناية.</li>
                        <li data-lang-ar="الابتكار: البحث المستمر عن أحدث التقنيات والمواد." data-lang-en="Innovation: Continuous pursuit of the latest technologies and materials.">الابتكار: البحث المستمر عن أحدث التقنيات والمواد.</li>
                        <li data-lang-ar="المجتمع: بناء علاقات قوية مع عملائنا ودعم الأنشطة الرياضية." data-lang-en="Community: Building strong relationships with our customers and supporting sports activities.">المجتمع: بناء علاقات قوية مع عملائنا ودعم الأنشطة الرياضية.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="bg-indigo-700 text-white py-16 text-center rounded-lg mx-auto mt-6">
        <h2 class="text-3xl md:text-4xl font-bold mb-4" data-lang-ar="انضم إلى مجتمعنا الرياضي" data-lang-en="Join Our Sports Community">انضم إلى مجتمعنا الرياضي</h2>
        <p class="text-lg mb-8" data-lang-ar="اشترك في قائمتنا البريدية للحصول على آخر العروض والتحديثات." data-lang-en="Subscribe to our mailing list for the latest offers and updates.">اشترك في قائمتنا البريدية للحصول على آخر العروض والتحديثات.</p>
        <form class="flex flex-col sm:flex-row justify-center items-center gap-4 px-4">
            <input type="email" placeholder="أدخل بريدك الإلكتروني" class="p-3 rounded-md w-full sm:w-80 text-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500" data-lang-ar-placeholder="أدخل بريدك الإلكتروني" data-lang-en-placeholder="Enter your email">
            <button type="submit" class="bg-white text-indigo-700 font-bold py-3 px-6 rounded-md hover:bg-gray-100 transition-colors duration-200 w-full sm:w-auto" data-lang-ar="اشترك" data-lang-en="Subscribe">اشترك</button>
        </form>
    </section>
@endsection


