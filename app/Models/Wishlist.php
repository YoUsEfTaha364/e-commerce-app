<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    //

 protected $guarded = ["id"];
        public function wishlist_items(){
        return $this->HasMany(WishlistItem::class);
    }


      public function user(){
        return $this->belongsTo(User::class);
    }
}
