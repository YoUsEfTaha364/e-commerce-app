<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\api_response;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $products=Product::get();

        return $products;
    }
    public function show(string $id){
        $product=Product::find($id);

       if (! $product) {
        return api_response::Response(
            404,
            'Product not found',
            null
        );
    }

    return api_response::Response(
        200,
        'Product details',
        $product
    );
        
    }
}
