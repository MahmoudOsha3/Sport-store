<?php

use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\{ProductController , ProductVariantController};
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Website\{HomeController , CartController , OrderController , PaymentController};
use App\Models\Order;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;

    Route::get('user/create' , function(){
        return view('website.users.register') ;
    });


    Route::get('/home',[HomeController::class , 'index'])->name('home');

Route::middleware('auth:web')->group(function(){

    Route::controller(HomeController::class)->group(function(){
        Route::get('home/category/{category_id}' , 'category')->name('home.category');
        Route::get('product/show/{id}' , 'show')->name('product.show');

    });




    Route::resource('carts' , CartController::class );
    Route::post('cart/delete' , [CartController::class , 'delete'])->name('cart.delete') ;



    Route::prefix('orders')->controller(OrderController::class)->group(function(){
        Route::get('/' , 'index')->name('order.index');
        Route::post('store' , 'store')->name('order.store');
        Route::post('cancelled/{order_id}' , 'delete' )->name('order.cancelled');

    });

    Route::controller(PaymentController::class)->group(function(){
        Route::post('payment/{order_id}' , 'paymentProcess')->name('payment') ;
        Route::get('payment/callback/' , 'callback' )->name('payment.callback');
        Route::get('payment/success' , 'success')->name('payment.success');
        Route::get('payment/failed' ,'failed')->name('payment.failed');
    });





    Route::get('/', function () {
        return view('welcome');
    });
});


require __DIR__.'/auth.php';
