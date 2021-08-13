<?php

namespace App\Http\Controllers\VueAdmin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class TemporaryController extends Controller
{
    public function getProducts(){

        $products = Product::all();
        return response()->json([
            'products' => $products
        ], 200);
    }
}
