<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WishlistItem extends Model
{

    protected $guarded = ["id"];
        public function product()
{
    return $this->belongsTo(Product::class);
}

    public function wishlist(){
        return $this->belongsTo(Wishlist::class);
    }

}
