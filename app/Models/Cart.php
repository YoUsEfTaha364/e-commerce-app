<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Cart extends Model
{
     protected $fillable = [
        'user_id'
       
    ];
    public function getSubtotalAttribute(): float {

        return $this->cart_items->sum(fn($item)=> $item->quantity * $item->product->sale_price);

    }

       public  function getItemsCountAttribute(){
          return $this->cart_items->count();

       }

    
    public function cart_items(){
        return $this->HasMany(CartItem::class);
    }


      public function user(){
        return $this->belongsTo(User::class);
    }
}
