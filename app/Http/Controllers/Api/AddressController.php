<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AddressRequest;
use App\Http\Requests\Api\UpdateAddressRequest;
use App\Models\Address;
use App\Services\api_response;
use Illuminate\Http\Request;

class AddressController extends Controller
{

    public function index(Request $request)
    {
        $user = $request->user();

        $addresses = $user->addresses;
        if (!$addresses) {
            return api_response::Response(404, "no adresses found", []);
        }

        return api_response::Response(200, "get addresses", $addresses);
    }
    public function store(AddressRequest $request)
    {
        $user = $request->user();

        if ($request->boolean("is_default")) {
            $user->addresses()->update([
                "is_default" => 0
            ]);
        }

        $address = Address::create([
            "full_name" => $request->full_name,
            "phone" => $request->phone,
            "address" => $request->address,
            "state" => $request->state,
            "city" => $request->city,
            "is_default" => $request->boolean("is_default"),
            "user_id" => $user->id,
        ]);


        return api_response::Response(201, "address created successfully", $address);
    }
    public function update(UpdateAddressRequest $request, $id)
    {
        $user = $request->user();



        $address = $user->addresses()->where("id", $id)->first();

        if (!$address) {
            return api_response::Response(404, "address not found", null);
        }

        if ($request->boolean("is_default")) {
            $user->addresses()->where('id', '!=', $address->id)->update([
                "is_default" => 0
            ]);
        }

        $address->fill($request->validated());

        if ($address->isDirty()) {
            $address->save();
        }


        return api_response::Response(200, "address updated successfully", $address);
    }

    public function destroy(Request $request, $id)
    {
        $user = $request->user();

        $address = $user->addresses()->where("id", $id)->first();
        if (!$address) {
            return api_response::Response(404, "address not found", null);
        }

        $address->delete();


        return api_response::Response(200, "address deleted successfully", []);
    }
}
