<!doctype html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>إعادة تعيين كلمة المرور</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body { background: linear-gradient(180deg,#0f172a 0%, #071145 100%); }
    .glass { background: rgba(255,255,255,0.06); backdrop-filter: blur(6px); }
  </style>
</head>
<body class="min-h-screen flex items-center justify-center p-6">
  <div class="w-full max-w-lg mx-auto">
    <div class="text-center mb-6">
      <div class="inline-flex items-center gap-3">
        <div class="bg-white/10 rounded-full p-3 shadow-lg">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 11c1.657 0 3-1.343 3-3S13.657 5 12 5 9 6.343 9 8s1.343 3 3 3zM5 20a7 7 0 0114 0" />
          </svg>
        </div>
        <div class="text-left">
          <h1 class="text-white text-2xl font-extrabold">إعادة تعيين كلمة المرور</h1>
          <p class="text-gray-300 text-sm">أدخل كلمة مرور جديدة لحسابك.</p>
        </div>
      </div>
    </div>

    <div class="glass rounded-2xl shadow-xl overflow-hidden">
      <div class="p-8 md:p-10">

        @if ($errors->any())
          <div class="mb-4 p-3 rounded-md bg-red-600/10 text-red-200">
            <ul class="list-disc pr-5">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form method="POST" action="{{ route('admin.password.update') }}">
          @csrf

          <input type="hidden" name="token" value="{{ $token }}">

          <div class="mb-4">
            <label for="email" class="block text-sm text-gray-200 mb-2">البريد الإلكتروني</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required
                   class="w-full bg-white/5 py-3 px-4 rounded-lg text-white placeholder-gray-400 outline-none">
          </div>

          <div class="mb-4">
            <label for="password" class="block text-sm text-gray-200 mb-2">كلمة المرور الجديدة</label>
            <input id="password" name="password" type="password" required
                   class="w-full bg-white/5 py-3 px-4 rounded-lg text-white placeholder-gray-400 outline-none">
          </div>

          <div class="mb-6">
            <label for="password_confirmation" class="block text-sm text-gray-200 mb-2">تأكيد كلمة المرور</label>
            <input id="password_confirmation" name="password_confirmation" type="password" required
                   class="w-full bg-white/5 py-3 px-4 rounded-lg text-white placeholder-gray-400 outline-none">
          </div>

          <button type="submit" class="w-full py-3 rounded-lg font-semibold text-white bg-gradient-to-r from-indigo-600 to-blue-500 hover:from-indigo-500 hover:to-blue-600 shadow-md">
            تحديث كلمة المرور
          </button>
        </form>
      </div>
    </div>

    <div class="mt-6 text-center text-gray-400 text-sm">
      <a href="{{ route('admin.login') }}" class="text-indigo-300 hover:underline">العودة لتسجيل الدخول</a>
    </div>
  </div>
</body>
</html>
