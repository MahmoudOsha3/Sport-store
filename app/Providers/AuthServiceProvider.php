<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Admin;
use App\Models\Product;
use App\Models\RoleAbility;
use App\Policies\AdminPolicy;
use App\Policies\ProductPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Admin::class => AdminPolicy::class ,
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // foreach (config('abilities') as $permission => $value) {
        //     Gate::define($permission , function ($admin) use ($permission){
        //         return $admin->hasPermission($permission) ;
        //     });
        // }
    }
}
