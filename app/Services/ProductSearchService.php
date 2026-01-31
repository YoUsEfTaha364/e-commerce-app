<?php
namespace App\Services;
use App\Models\Product;

class ProductSearchService{
public function baseSearchQuery($word)
{
    return Product::query()
        ->where('name', 'like', "%{$word}%")
        ->orWhere('description', 'like', "%{$word}%")
        ->orWhereHas('category', function($q) use ($word) {
            $q->where('name', 'like', "%{$word}%");
        });
}


}

?>