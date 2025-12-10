<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str ;

class CategoryController extends Controller
{
    public function __construct() {
        // $this->authorizeResource(Category::class , 'category') ;
    }
    public function index()
    {
        $this->authorize('viewAny' , Category::class ) ;
        $categories = Category::get() ;
        return view('dashboard.categories.index' , compact('categories')) ;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('update' , Category::class) ;
        Category::create(['name' => $request->name  , 'slug' => Str::slug($request->name)]);
        return redirect()->back()->with(['success' => 'تم إدخال القسم بنجاح']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->authorize('update' , Category::class) ;
        return "update category" ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->authorize('category.update' , Category::class) ;
        return "update category" ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
