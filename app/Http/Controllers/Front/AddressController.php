<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddressRequest;
use App\Models\Address;
use App\Models\State;
use App\Services\AddressService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
                $addresses=Address::where("user_id",Auth::user()->id)->get();
        return view("customer.address.profile.index",compact("addresses"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
            $states=State::all();
     

         return view("customer.address.profile.create",compact("states"));

    }

    /**
     * Store a newly created resource in storage.
     */
        public function store(AddressRequest $request,AddressService $addressService){

          // dd($request->all());
               $address=$request->validated();
       

          $addressService->storeAddress($address);
       
     
        
        
         return redirect()->route("profile.address.index");

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Address $address)
    {
        // dd($address);
            $states=State::all();

         return view("customer.address.profile.edit",compact("states","address"));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AddressRequest $request,Address $address)
    {
      $updatedAddress= $request->validated();

      $address->fill($updatedAddress);

      if($address->isDirty()){
        $address->save();
        return redirect()->route("profile.address.index")->with(["address-update"=>"address updated successfully"]);
      }

       return redirect()->back()->with(["address-update"=>" fields are not changed  "]);



    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Address $address)
    {
        $address->delete();

        return redirect()->route("profile.address.index")->with(["address-delete"=>"address deleted successfully"]);
    }


    public function SetDefault(Address $address){
        // if($address->is_default==1){
        //     return;
        // }
        Address::where('user_id', Auth::user()->id)
         ->update(['is_default' => false]);
         

         $address->update([
            "is_default"=>true
         ]);

         return redirect()->route("profile.address.index");
    }
}
