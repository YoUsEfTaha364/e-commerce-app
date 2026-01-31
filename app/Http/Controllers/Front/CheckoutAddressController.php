<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddressRequest;
use App\Models\Address;
use App\Models\Cart;
use App\Models\State;
use App\Services\AddressService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutAddressController extends Controller
{
  public function index()
  {
    $cart = Cart::where("user_id", Auth::user()->id)->first();


    if (count($cart->cart_items) == 0) {
      abort(404);
    }

    $addresses = Address::where("user_id", Auth::user()->id)->get();
    //  dd(count($addresses));



    return view("customer.address.checkout.index", compact("addresses"));
  }
  public function create()
  {

    $states = State::all();


    return view("customer.address.checkout.create", compact("states"));
  }
  public function store(AddressRequest $request, AddressService $addressService)
  {

    // dd($request->all());
    $address = $request->validated();


    $addressService->storeAddress($address);




    return redirect()->route("checkout.address.index");
  }
}
