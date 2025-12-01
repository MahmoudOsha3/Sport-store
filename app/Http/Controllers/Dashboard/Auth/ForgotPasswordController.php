<?php

namespace App\Http\Controllers\Dashboard\Auth ;

use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{

    public function createNewPassword()
    {
        return view('auth.admin.forgot-password') ;
    }


    // forgot password
    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:admins,email',
        ], [
            'email.exists' => 'هذا البريد غير مسجل في النظام.',
        ]);

        $status = Password::broker('admins')->sendResetLink($request->only('email')) ;

        return $status === Password::RESET_LINK_SENT ?
            back()->with('success' , 'تم الارسال الرابط الي الايميل بنجاح')
            : back()->withErrors(['email' => __($status)]) ;
    }

    // عرض صفحة إعادة كلمة المرور (تُفتح من البريد)
    public function showResetForm()
    {
        return view('auth.admin.reset');
    }

    // تنفيذ إعادة كلمة المرور
    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:admins,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $status = Password::broker('admins')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($admin, $password) {
                $admin->forceFill(['password' => Hash::make($password)])->save();
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            return redirect()->route('admin.login')->with('status', __('تم تعيين كلمة المرور الجديدة بنجاح.'));
        }

        throw ValidationException::withMessages([
            'email' => [__($status)],
        ]);
    }
}
