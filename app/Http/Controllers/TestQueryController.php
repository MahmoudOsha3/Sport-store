<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TestQueryController extends Controller
{
    public function index()
    {
        $value = 1500 ;
        $status = 'completed' ;
        $id = 77 ;
        // $orders = DB::select("SELECT id ,user_id , total_price , status FROM orders WHERE (total_price < ? ) AND (status = ? )" , [$value , $status]) ;
        $orders = DB::select('
            SELECT  orders.*, order_items.product_name , order_items.price as priceForQuantity , order_items.quantity
                from orders
            JOIN order_items ON order_items.order_id = orders.id  WHERE orders.id = ?' , [$id] ) ;
        return $orders ;
    }
    public function create()
    {
        $id = 11 ;
        $name = 'Ahmed Alaa' ;
        $email = 'ahmed.alaa@gmail.com' ;
        $password = Hash::make('123456786') ;
        $phone = '01201955377' ;
        $address = 'Cairo' ;

        // $user = DB::statement('INSERT INTO users (name , email , password , phone , address) VALUES (? , ? , ? , ? , ? )' ,
        //     [$name , $email , $password , $phone , $address]) ;
        // DB::statement('UPDATE users SET name = ? , email = ? , phone = ? WHERE id = ?' , [$name , $email , $phone , $id ]) ;
        DB::statement('DELETE From users where id = ? ' , [$id]) ;
        return response('Deleted user', 202 );
    }

    public function store(Request $request)
    {

    }
    public function show($id)
    {
        // 
    }

    public function edit($id)
    {

    }
    public function update(Request $request , $id)
    {

    }
    public function delete($id)
    {

    }
    public function getColors()
    {

    }
}

