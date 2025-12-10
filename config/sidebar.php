<?php
return
[
    [
        'title' => 'الرئيسية ' ,
        'icon' => '' ,
        'link' => 'admin.dashboard',
        'active' => ['admin.dashboard' , 'admin.dashboard*'] ,
    ],
    [
        'title' => 'المنتجات' ,
        'icon' => '' ,
        'link' => 'products.index',
        'active' => 'products.*',
        'childern' => [
                [
                'title' => ' المنتجات المؤرشفة' ,
                'icon' => '' ,
                'link' => 'product.show.archived',
                'active' => ['product.archived'],
                ],
                [
                'title' => 'كل المنتجات' ,
                'icon' => '' ,
                'link' => 'products.index',
                'active' => ['product.*' , 'product.show*' , 'product.edit*'],
                ],
        ]
    ],

    [
        'title' => 'الاقسام' ,
        'icon' => '' ,
        'link' => 'categories.index',
        'active' => ['categories.index' , 'categories.show*','categories.edit*']

    ],

    [
        'title' => 'الطلبات' ,
        'icon' => '' ,
        'link' => 'orders.index',
        'active' => ['orders.index' , 'orders.show*','orders.edit*']

    ],

    [
        'title' => 'الكوبونات' ,
        'icon' => '' ,
        'link' => 'coupons.index',
        'active' => ['coupons.index' , 'coupons.show*','coupons.edit*']

    ],

    [
        'title' => 'المشرفين' ,
        'icon' => '' ,
        'link' => 'admins.action',
        'active' => 'admins.*'
    ],

    [
        'title' => 'الاداور' ,
        'icon' => '' ,
        'link' => 'roles.index',
        'active' => 'roles.*'
    ],

    [
        'title' => 'المستخدمين' ,
        'icon' => '' ,
        'link' => 'admin.users',
        'active' => 'users.*'
    ],


];



?>
