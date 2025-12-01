<!-- resources/views/auth/admin-login.blade.php -->
<!doctype html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>تسجيل دخول </title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    /* لمسات صغيرة */
    body { background: linear-gradient(180deg,#0f172a 0%, #071145 100%); }
    .glass { background: rgba(255,255,255,0.06); backdrop-filter: blur(6px); }
  </style>
</head>
<body class="min-h-screen flex items-center justify-center p-6">
  <div class="w-full max-w-lg mx-auto">
    <div class="text-center mb-6">
      <!-- شعار صغير -->
      <div class="inline-flex items-center gap-3">
        <div class="bg-white/10 rounded-full p-3 shadow-lg">
          <!-- simple shield icon -->
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 3v5l7 3v4a2 2 0 01-2 2H7a2 2 0 01-2-2v-4l7-3V3z" />
          </svg>
        </div>
        <div class="text-left">
          {{-- <h1 class="text-white text-2xl font-extrabold">لوحة التحكم</h1> --}}
          <p class="text-gray-300 text-sm">تسجيل الدخول </p>
        </div>
      </div>
    </div>

    <div class="glass rounded-2xl shadow-xl overflow-hidden">
      <div class="p-8 md:p-10">
        <!-- Errors (Laravel session) -->
        @if(session('error'))
          <div class="mb-4 p-3 rounded-md bg-red-600/20 text-red-100">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{route('login')}}" novalidate>
          @csrf

          <div class="mb-4">
            <label for="email" class="block text-sm text-gray-200 mb-2">البريد الإلكتروني</label>
            <div class="flex items-center bg-white/5 rounded-lg shadow-inner">
              <span class="px-3 text-gray-300">
                <!-- mail icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path d="M2.94 6.94A2 2 0 014.4 6h11.2a2 2 0 011.46.94L10 11.586 2.94 6.94z"/></svg>
              </span>
              <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                     class="w-full bg-transparent py-3 pr-2 pl-0 placeholder-gray-400 text-white outline-none" placeholder="name@example.com">
            </div>
            @error('email')
              <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
            @enderror
          </div>

          <div class="mb-4">
            <label for="password" class="block text-sm text-gray-200 mb-2">كلمة المرور</label>
            <div class="flex items-center bg-white/5 rounded-lg shadow-inner">
              <span class="px-3 text-gray-300">
                <!-- lock icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5 8V6a5 5 0 1110 0v2h1a1 1 0 011 1v7a1 1 0 01-1 1H4a1 1 0 01-1-1V9a1 1 0 011-1h1zm2-2a3 3 0 116 0v2H7V6z" clip-rule="evenodd"/></svg>
              </span>
              <input id="password" name="password" type="password" required
                     class="w-full bg-transparent py-3 pr-2 pl-0 placeholder-gray-400 text-white outline-none" placeholder="كلمة المرور">
              <button type="button" id="togglePwd" class="px-3 text-gray-300" aria-label="إظهار/إخفاء كلمة المرور">
                <!-- eye icon -->
                <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path d="M2.94 10.94C4.72 14.02 8.06 16 10 16s5.28-1.98 7.06-5.06A1 1 0 0016.86 9H3.14a1 1 0 00-.2 1.94z"/></svg>
                <svg id="eyeClosed" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-2.94 0-5.28-1.98-7.06-5.06M15 12a3 3 0 10-6 0 3 3 0 006 0z"/></svg>
              </button>
            </div>
            @error('password')
              <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
            @enderror
          </div>

          <div class="flex items-center justify-between mb-6">
            <label class="inline-flex items-center gap-2 text-sm text-gray-300">
              <input type="checkbox"  name="remember" class="h-4 w-4 rounded text-indigo-500 bg-white/5">
              تذكرني
            </label>
            <a class="text-sm text-indigo-300 hover:underline" href="{{route('admin.forgot-password')}}">نسيت كلمة المرور؟</a>
          </div>

          <div class="mb-4">
            <button type="submit" class="w-full py-3 rounded-lg font-semibold text-white bg-gradient-to-r from-indigo-600 to-blue-500 hover:from-indigo-500 hover:to-blue-600 transition-shadow shadow-md">
              تسجيل الدخول
            </button>
          </div>

          <div class="text-center text-xs text-gray-400">
            دخولك يؤكد موافقتك على سياسة الخصوصية واستخدام النظام.
          </div>
        </form>
      </div>
    </div>

    <div class="mt-6 text-center text-gray-400 text-sm">هل تريد تسجيل الدخول كمستخدم آخر؟ <a href="#" class="text-indigo-300 hover:underline">تبديل إلى واجهة المستخدم</a></div>
  </div>

  <script>
    // إظهار/إخفاء كلمة المرور
    const pwd = document.getElementById('password');
    const toggle = document.getElementById('togglePwd');
    const eyeOpen = document.getElementById('eyeOpen');
    const eyeClosed = document.getElementById('eyeClosed');

    toggle.addEventListener('click', () => {
      if (pwd.type === 'password') { pwd.type = 'text'; eyeOpen.classList.add('hidden'); eyeClosed.classList.remove('hidden'); }
      else { pwd.type = 'password'; eyeOpen.classList.remove('hidden'); eyeClosed.classList.add('hidden'); }
    });

    // خيار: تعزيز بسيط للتحقق قبل الإرسال
    document.querySelector('form').addEventListener('submit', (e) => {
      const emailVal = document.getElementById('email').value.trim();
      const passVal = pwd.value.trim();
      if (!emailVal || !passVal) {
        e.preventDefault();
        alert('يرجى ملء البريد الإلكتروني وكلمة المرور.');
      }
    });
  </script>
</body>
</html>
