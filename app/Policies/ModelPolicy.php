<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Support\Str;

class ModelPolicy
{
    public function __construct()
    {
        //
    }

    public function __call($name, $arguments)
    {
        $class_name = str_replace('Policy' , '' , class_basename($this)); //Ex : ProductPolicy => Product
        if($name == 'view'){
            $name = 'show' ;
        }
        if ($name == 'viewAny') {
            $name = 'view' ;
        }

        $permission = Str::lower($class_name . '.' . $name) ; //Ex => product.view
        $admin = $arguments[0] ;
        return $admin->hasPermission($permission) ;
    }
}

