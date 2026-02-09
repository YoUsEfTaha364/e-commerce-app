<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Admin\RolePermisssionsRequest;
use App\Http\Requests\Api\Admin\UpdateRolePermisssionsRequest;
use App\Http\Resources\PermissionsResource;
use App\Http\Resources\RoleResource;
use App\Services\api_response;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Spatie\Permission\Models\Role;
use Illuminate\Routing\Controllers\HasMiddleware;
class RoleController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            "c-sanctum:sanctum",
            "is-admin",

            new Middleware("authorize-api:roles.create,roles.update,roles.view,roles.delete"),
        ];
    }
    public function index(Request $request)
    {

        $roles = Role::where("guard_name", "web")->get();

        $data = $roles->map(function ($role) {

            return [
                "role" => new RoleResource($role),
                "permissions" => PermissionsResource::collection($role->getAllPermissions()->values())
            ];
        });



        return api_response::Response(200, "get roles", $data);
    }
    public function store(RolePermisssionsRequest $request)
    {



        $data = $request->validated();
        $role = Role::create([
            "name" => $data["name"],
            "guard_name" => "web",
        ]);

        $role->syncPermissions($data["permissions"]);

        $role_data = [
            "role" => new RoleResource($role),
            "permissions" => PermissionsResource::collection($role->getAllPermissions()->values())

        ];


        return api_response::Response(200, "role created successfully", $role_data);
    }
    public function update(UpdateRolePermisssionsRequest $request, $id)
    {



        $role = Role::where("guard_name", "web")->find($id);
        $data = $request->validated();
        $role->update([
            "name" => $data["name"],

        ]);

        if (isset($data["permissions"])) {
            $role->syncPermissions($data["permissions"]);
        }



        $role_data = [
            "role" => new RoleResource($role),
            "permissions" => PermissionsResource::collection($role->getAllPermissions()->values())

        ];


        return api_response::Response(200, "role updated successfully", $role_data);
    }
}
