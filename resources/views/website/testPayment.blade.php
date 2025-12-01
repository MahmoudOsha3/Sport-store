<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نموذج الدفع</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-primary text-white text-center fs-4">
            💳 نموذج الدفع
        </div>
        <div class="card-body p-4">

            @if(session('success'))
                <div class="alert alert-success text-center">
                    {{ session('success') }}
                </div>
            @endif

<form action="{{ route('paymob') }}" method="POST" class="p-4 bg-light rounded shadow">
    @csrf
    <div class="mb-3">
        <label class="form-label">الاسم الكامل</label>
        <input type="text" name="name" class="form-control" placeholder="اكتب اسمك" required>
    </div>

    <div class="mb-3">
        <label class="form-label">البريد الإلكتروني</label>
        <input type="email" name="email" class="form-control" placeholder="example@email.com" required>
    </div>

    <div class="mb-3">
        <label class="form-label">رقم الهاتف</label>
        <input type="text" name="phone" class="form-control" placeholder="+201234567890" required>
    </div>

    <div class="mb-3">
        <label class="form-label">العنوان</label>
        <input type="text" name="address" class="form-control" placeholder="اكتب العنوان بالكامل" required>
    </div>

    <div class="mb-3">
        <label class="form-label">المبلغ بالجنيه المصري</label>
        <input type="number" name="amount" class="form-control" min="1" required>
    </div>

    <button type="submit" class="btn btn-primary w-100">إتمام الدفع</button>
</form>

        </div>
    </div>
</div>

</body>
</html>
