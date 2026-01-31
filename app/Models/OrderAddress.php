<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderAddress extends Model
{
     protected $guarded = ["id"];

     protected $table="order_addresses";


        public function order(){
        return $this->belongsTo(Order::class);
    }
}
