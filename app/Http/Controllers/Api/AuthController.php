<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ApiLoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Services\api_response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(RegisterRequest $request){
      

        
        $data=$request->validated();


        $user=User::create([
            "firstname"=>$data["firstname"],
            "lastname"=>$data["lastname"],
            "email"=>$data["email"],
            "password"=>Hash::make($data["password"])
        ]);

        $token=$user->createToken("auth_user")->plainTextToken;

        $returned_data=[
            "user"=>[
                "firstname"=>$data["firstname"],
                "lastname"=>$data["lastname"],
                "email"=>$data["email"],
            ],
            "token"=>$token
        ];


       return  api_response::Response(201,"user created successfully",$returned_data);


       

    }

    
    public function login(ApiLoginRequest $request){

            $request->authenticate();
            $user=$request->user();

             $token = $user->createToken('auth_user')->plainTextToken;


             $response=[
                "user"=>[
                   "firstname"=> $user->firstname,
                   "lastname"=> $user->lastname,
                   "email"=> $user->email,
                ],
                "token"=>$token
                
             ];


              
       return  api_response::Response(200,"user loged in successfully",$response);


        
    
      

        
  

    }


}
