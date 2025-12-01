<?php

namespace App\Traits ;

use Illuminate\Support\Facades\Storage;

trait ManageFileTrait
{
    public function uploadFile($request ,  $folder , $disk)
    {
        if($request->hasFile('image')){
            $name_image = $request->file('image')->getClientOriginalName();
            $uploadLocal = $request->file('image')->storeAs( $folder , $name_image , $disk );
        }
    }

    public function updateFile($request , $name_image) // old image
    {
        if($request->hasFile('image')){
            if(Storage::disk('products')->exists('products/'. $name_image)){
                Storage::disk('products')->delete('products/'. $name_image) ;
            }
            // Storage::disk('products')->deleteDirectory('products/'. $name_image) ;
            $name_image = $request->file('image')->getClientOriginalName();
            $uploadLocal = $request->file('image')->storeAs('prosucts' , $name_image , $disk = 'prosucts');
        }
    }
}

