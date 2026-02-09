<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Admin\AssignRoleRequest;
use App\Http\Resources\PermissionsResource;
use App\Http\Resources\RoleResource;
use App\Models\User;
use App\Services\api_response;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;

use Illuminate\Routing\Controllers\HasMiddleware;
class UserController extends Controller
{

        public static function middleware(): array
    {
        return [
            "c-sanctum:sanctum",
            "is-admin",

            new Middleware("authorize-api:admins.create,admins.view,admins.edit,admins.delete"),
        ];
    }
    public function index()
    {
        $users = User::select(
                'id',
                'firstname',
                'lastname',
                'email',
                'is_admin',
                'created_at'
            )
            ->latest()
            ->paginate(15);

        return api_response::Response(
            200,
            'Users fetched successfully',
            $users
        );
    }


    public function show($id)
{
    $user = User::with([
            'orders' => function ($q) {
                $q->latest();
            }
        ])
        ->select(
            'id',
            'firstname',
            'lastname',
            'email',
            'is_admin',
            'created_at'
        )
        ->find($id);

    if (! $user) {
        return api_response::Response(
            404,
            'User not found',
            null
        );
    }

    return api_response::Response(
        200,
        'User details fetched successfully',
        $user
    );
}

public function assignRole(AssignRoleRequest $request,$id){
    
      $user=User::where("is_admin",1)->find($id);

      if(!$user){
           return api_response::Response(
        404,
        'invalid user',
        null
    );
      }

      


      $user->syncRoles($request->validated()["role"]);

      $data=[
        "user"=>$user,
        "role"=> $user->getRoleNames()->values()->first(),
        "permissions"=>PermissionsResource::collection($user->getAllPermissions()->values())
      ];


               return api_response::Response(
        200,
        'role assign to a user',
        $data
    );




}

}
