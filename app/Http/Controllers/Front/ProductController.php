<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\ProductSearchService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
        public function index()
    {
        $products=Product::where("status","active")->get();
        return view("customer.home",compact("products"));
    }
     public function show($id)
    {
        $product=Product::find($id);
        return view("customer.products.show",compact("product"));
    }

}
