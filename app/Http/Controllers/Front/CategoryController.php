<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
  
     public function show($id)
    {
      
        $category=Category::find($id);
        $products=$category->products;
        return view("customer.categories.show",compact("products","category"));
    }
}
