<?php

use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\{AdminController , AuthAdminController, CouponsController, OptionController, OrderController, ProductController , ProductVariantController, RolesController, UserController , HomeController};
use App\Http\Controllers\ProfileController;
use App\Models\OptionValue;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



    Route::middleware('auth:admin')->prefix('admin')->group(function()
    {
            // Route::get('option-values/{option_id}' , [OptionController::class , 'getOptionValue'])->name('api.option-values');

            Route::get('dashboard' , [HomeController::class , 'index'])->name('admin.dashboard');

            Route::resource('categories' , CategoryController::class);

            Route::resource('products' , ProductController::class) ;
            Route::resource('orders' , OrderController::class ) ;


            Route::get('products/archived/all' , [ProductController::class , 'showArchived'])->name('product.show.archived') ;
            Route::get('products/archived/{product}' , [ProductController::class , 'archived'])->name('product.archived') ;
            Route::get('products/archived/restore/{product}' , [ProductController::class , 'restore'])->name('product.restore') ;

            Route::resource('product_variant' , ProductVariantController::class );

            Route::resource('coupons' , CouponsController::class ) ;

            Route::get('users' , [UserController::class , 'index'])->name('admin.users');

            // owner , admin
            Route::get('admins' , [AdminController::class , 'index'])->name('admins.action') ;
            Route::resource('roles' , RolesController::class);

            Route::get('register' , [AdminController::class , 'create'])
                ->name('admin.register');

            Route::post('register' , [AdminController::class , 'store'])
                    ->name('admin.register.store');

        });

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');





require __DIR__.'/auth.php';
