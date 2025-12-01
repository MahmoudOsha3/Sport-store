<!doctype html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>استعادة كلمة المرور - لوحة التحكم</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body { background: linear-gradient(180deg,#071145 0%, #031032 100%); }
    .glass { background: rgba(255,255,255,0.04); backdrop-filter: blur(6px); }
  </style>
</head>
<body class="min-h-screen flex items-center justify-center p-6">
  <div class="w-full max-w-xl mx-auto">
    <div class="text-center mb-6">
      <div class="inline-flex items-center gap-3">
        <div class="bg-white/10 rounded-full p-3 shadow-lg">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 11c1.657 0 3-1.343 3-3S13.657 5 12 5 9 6.343 9 8s1.343 3 3 3zM5 20a7 7 0 0114 0" />
          </svg>
        </div>
        <div class="text-left">
          <h1 class="text-white text-2xl font-extrabold">نسيت كلمة المرور؟</h1>
          <p class="text-gray-300 text-sm">أدخل بريدك الإلكتروني وسنرسل رابط إعادة التعيين.</p>
        </div>
      </div>
    </div>

    <div class="glass rounded-2xl shadow-xl overflow-hidden">
      <div class="p-8 md:p-10">

        @if (session('status'))
          <div class="mb-4 p-3 rounded-md bg-green-600/20 text-green-100">{{ session('status') }}</div>
        @endif

        @if ($errors->any())
          <div class="mb-4 p-3 rounded-md bg-red-600/10 text-red-200">
            <ul class="list-disc pr-5">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form method="POST" action="{{ route('admin.forgot-password') }}" novalidate>
          @csrf

          <div class="mb-4">
            <label for="email" class="block text-sm text-gray-200 mb-2">البريد الإلكتروني المسجل</label>
            <div class="flex items-center bg-white/5 rounded-lg shadow-inner">
              <span class="px-3 text-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path d="M2.94 6.94A2 2 0 014.4 6h11.2a2 2 0 011.46.94L10 11.586 2.94 6.94z"/></svg>
              </span>
              <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                     class="w-full bg-transparent py-3 pr-2 pl-0 placeholder-gray-400 text-white outline-none" placeholder="name@example.com">
            </div>
          </div>

          <div class="mb-4">
            <button type="submit" class="w-full py-3 rounded-lg font-semibold text-white bg-gradient-to-r from-indigo-600 to-blue-500 hover:from-indigo-500 hover:to-blue-600 transition-shadow shadow-md">
              إرسال رابط إعادة التعيين
            </button>
          </div>

          <div class="text-center text-xs text-gray-400">
            ستتلقى رسالة تحتوي على رابط لإعادة تعيين كلمة المرور إذا كان البريد مسجلاً في النظام.
          </div>
        </form>

      </div>
    </div>

    <div class="mt-6 text-center text-gray-400 text-sm">تذكرت كلمة المرور؟ <a href="{{ route('admin.login') }}" class="text-indigo-300 hover:underline">العودة لتسجيل الدخول</a></div>
  </div>

  <script>
    // تحقق بسيط قبل الإرسال
    document.querySelector('form').addEventListener('submit', function (e) {
      const email = document.getElementById('email');
      if (!email.value.trim()) {
        e.preventDefault();
        alert('يرجى إدخال البريد الإلكتروني.');
        email.focus();
      }
    });
  </script>
</body>
</html>
