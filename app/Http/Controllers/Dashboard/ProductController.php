<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Option;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use App\Traits\ManageFileTrait ;
use Illuminate\Support\Str ;

class ProductController extends Controller
{
    use ManageFileTrait ;

    public function index(Request $request)
    {
        $products = Product::latest()->search($request)->paginate(10);
        $categories = Category::get() ;
        return view('dashboard.products.index' ,  get_defined_vars()) ;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get() ;
        return view('dashboard.products.create' , compact('categories')) ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $this->uploadFile($request , $folder = 'products' , $disk = 'products');
            $product = Product::create([
                'title' => $request->title ,
                'slug' => Str::slug($request->title) ,
                'description' => $request->description ,
                'price' => $request->price ,
                'compare_price' => $request->compare_price ,
                'image' => $request->file('image')->getClientOriginalName() ,
                'status' => 'active' ,
                'category_id' => $request->category_id
            ]);
            return redirect()->back()->with('success' , 'تم إنشاء المنتج بنجاح');
        }catch(\Exception $e){
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
    //     $variants = ProductVariant::where('product_id', $productId)
    // ->leftJoin('order_items', 'product_variants.sku', '=', 'order_items.sku')
    // ->select(
    //     'product_variants.*',
    //     DB::raw('COUNT(order_items.id) as sold_times'),
    //     DB::raw('SUM(order_items.quantity) as total_sold_quantity')
    // )
    // ->groupBy('product_variants.id')
    // ->get();
        $product = Product::with('variants')->findorfail($id) ;
        return view('dashboard.product_variant.index' , compact('product')) ;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // try{
        //     $this->uploadFile($request , $folder = 'products' , $disk = 'products');
        //     $product = Product::create([
        //         'title' => $request->title ,
        //         'slug' => Str::slug($request->title) ,
        //         'description' => $request->description ,
        //         'price' => $request->price ,
        //         'compare_price' => $request->compare_price ,
        //         'image' => $request->file('image')->getClientOriginalName() ,
        //         'status' => 'active' ,
        //         'category_id' => $request->category_id
        //     ]);
        //     return redirect()->back()->with(['success' ,'تم إنشاء المنتج بنجاح' ]);
        // }catch(\Exception $e){
        //     return redirect()->back()->with(['error' , $e->getMessage()]);
        // }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        try{
            $product = Product::onlyTrashed()->find($id);
            $product->forceDelete();
            return redirect()->back()->with('success' , 'تم حذف المنتج بشكل دائما ') ;
        }
        catch(\Exception $e){
            return redirect()->back()->with('error' , $e->getMessage() ) ;
        }
    }

    public function showArchived()
    {
        $products = Product::onlyTrashed()->paginate(10) ;
        return view('dashboard.products.archived' , compact('products'));
    }

    public function archived(Product $product)
    {
        try{
            $product->status = 'archived' ;
            $product->save() ;
            $product->delete() ;
            return redirect()->back()->with('success' , 'تم أرشفت المنتج بنجاح') ;
        }
        catch(\Exception $e){
            return redirect()->back()->with('error' , $e->getMessage() ) ;
        }
    }

    public function restore($id)
    {
        try{
            $product = Product::onlyTrashed()->find($id);
            $product->restore() ;
            $product->status = 'active' ;
            $product->save() ;
            return redirect()->back()->with('success' , 'تم إسترجاع المنتج الي الموقع') ;
        }
        catch(\Exception $e){
            return redirect()->back()->with('error' , $e->getMessage() ) ;
        }
    }



}
