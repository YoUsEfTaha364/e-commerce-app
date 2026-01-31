<?php

namespace App\Services;

use App\Http\Requests\AddressRequest;
use App\Models\Address;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class AddressService
{


   public function storeAddress($address){

      // dd($address);
           
           
           $creatAddress= Address::create([
                "user_id"=>Auth::user()->id,
                "full_name"=>$address["full_name"],
                "phone"=>$address["phone"],
                "address"=>$address["address"],
                "state"=>$address["state"],
                "city"=>$address["city"],

            ]);

            return $creatAddress;

   }


}