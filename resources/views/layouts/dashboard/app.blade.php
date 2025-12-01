<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

      <!-- Bootstrap 3.3.6 -->
  {{-- <link rel="stylesheet" href="{{ asset('dashboard/bootstrap/css/bootstrap.css') }}"> --}}
  {{-- <link rel="stylesheet" href="{{ asset('dashboard/bootstrap/css/bootstrap.min.css') }}"> --}}

    <link rel="stylesheet" href="{{ asset('dashboard/index.css') }}">
    @yield('css')
</head>
    <body class="bg-gray-100 text-gray-800 transition-colors duration-300">

        @include('layouts.dashboard.header')


    <!-- Main Content - Admin Dashboard Section -->
    <main class="container mx-auto py-12 px-6 md:px-10">
        {{-- <h1 class="text-3xl md:text-4xl font-bold text-center mb-8 text-gray-900 dark:text-gray-100" data-lang-ar="لوحة التحكم" data-lang-en="Admin Dashboard">لوحة التحكم</h1> --}}

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Admin Sidebar Navigation -->
            @include('layouts.dashboard.sidebar')
            <!-- Admin Content Area -->
            @yield('content')
        </div>
    </main>


        @include('layouts.dashboard.footer')


        <script src="{{ asset('dashboard/index.js') }}"></script>
        <script src="{{ asset('dashboard/modal.js') }}"></script>
        <script src="https://js.pusher.com/8.0/pusher.min.js"></script>
        {{-- @vite(['resources/js/app.js']) --}}

        <!-- Bootstrap 3.3.6 -->
        {{-- <script src="{{ asset('dashboard/bootstrap/js/bootstrap.min.js') }}"></script> --}}
        @yield('js')
    </body>
</html>
