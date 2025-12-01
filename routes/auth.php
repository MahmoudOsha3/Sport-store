<?php

use App\Http\Controllers\Website\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Dashboard\Auth\AuthAdminController;
use App\Http\Controllers\Dashboard\Auth\ForgotPasswordController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Website\Auth\RegisteredUserController ;




Route::middleware('auth:admin')->prefix('admin')->group(function (){

    Route::post('dashboard/logout' ,[AuthAdminController::class , 'logout'])
        ->name('admin.dashboard.logout');

});

// user
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login/store', [AuthenticatedSessionController::class, 'store'])
                ->name('login.check');

    Route::post('register'  , [RegisteredUserController::class  , 'store' ])->name('register') ;

});

// admin
Route::middleware('guest')->prefix('admin')->group(function () {

    Route::get('login'  , [AuthAdminController::class  , 'index' ])->name('admin.login') ;

    Route::post('login'  , [AuthAdminController::class  , 'login'])->name('admin.login') ;

    Route::get('forgot-password', [ForgotPasswordController::class  , 'createNewPassword'])
        ->name('admin.forgot-password');

    Route::post('forgot-password'  , [ForgotPasswordController::class  , 'forgotPassword'])
        ->name('admin.forgot-password') ;

    Route::get('forgot-password/reset/{token}'  , [ForgotPasswordController::class  , 'showResetForm'])
        ->name('admin.forgot-password.reset') ;

    Route::post('forgot-password/update'  , [ForgotPasswordController::class  , 'reset'])
        ->name('admin.password.update') ;

});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});
