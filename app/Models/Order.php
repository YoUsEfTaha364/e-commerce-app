<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\OrderStatus;
use App\OrderStatus as AppOrderStatus;

class Order extends Model
{
     protected $guarded = ["id"];

   public function order_items(){
        return $this->HasMany(OrderItem::class);
    }
   public function order_address(){
        return $this->hasOne(OrderAddress::class);
    }

       public function user(){
        return $this->belongsTo(User::class);
    }



    
protected $casts = [
    'status' => AppOrderStatus::class,
];

}
