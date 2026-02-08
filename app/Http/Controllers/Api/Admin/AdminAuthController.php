<?php


// 9|YLfeRtYRySCmDhKNp7SiGsiXomLpdi7VErxRRtTacb6c22f6
namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ApiAdminLoginRequest;
use App\Services\api_response;
use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    public function login(ApiAdminLoginRequest $request)
    {

        $request->authenticate();

        $user = $request->user();

        $token = $user->createToken('auth_user')->plainTextToken;

        $data = [
            "user" => [
                "firstname" => $user->firstname,
                "lastname" => $user->lastname,
                "email" => $user->email,
                "is_admin" => true,
            ],
            "token" => $token

        ];



        return  api_response::Response(200, "user loged in successfully", $data);
    }
}
