<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\OptionValue;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    public function getOptionValue($option_id)
    {
        $option_values = OptionValue::where('option_id' , $option_id)->get() ;
        return response()->json($option_values) ;
    }
}
