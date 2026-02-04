<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Services\ProductSearchService;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    
      public function index(Request $request,ProductSearchService $search){
        

        $products=$search->baseSearchQuery($request->search)->get();

        return view("customer.search.index",compact("products"));
    }
      public function getSuggestions(Request $request,ProductSearchService $search){
        

        return $search->baseSearchQuery($request->q)->limit(10)->get();

    }

       public function getSearchedProducts(Request $request){

         return redirect()->route("search.index",["search"=>$request->search]);

       }
}
