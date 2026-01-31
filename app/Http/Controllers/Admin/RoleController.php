<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller implements HasMiddleware
{
     
      public static function middleware(): array
    {
        return [
            "c-auth",
            new Middleware("authorize-admin:roles.create,roles.update,roles.view,roles.delete"),
        ];
    }

     public function index()
    {

        
        $roles=Role::get();
     
        return view("admin.roles.index",compact("roles"));
    }

     public function create()
    {

          $permissions=Permission::where("guard_name","admin")->get();
        
        
         return view("admin.roles.create",compact("permissions"));
    }

    public function store(Request $request)
    {
   
        $role=Role::create([
            "name"=>$request->name,
            "guard_name"=>"admin"
        ]);

            if(isset($request->permissions)){
             foreach($request->permissions as $permission  ){
                $role->givePermissionTo($permission);
             }
        }

            return redirect()->route("admin.roles.index");
    }
    public function view(Role $role)
    {

        $Rolepermissions=$role->getPermissionNames()->toArray();
        $Allpermissions=Permission::get("name")->toArray();

        // dd([$Allpermissions,$Rolepermissions]);
        


        return view("admin.roles.view",compact("Rolepermissions","role","Allpermissions"));

        
    }
    public function edit(Role $role)
    {
        

        $Rolepermissions=$role->getPermissionNames()->toArray();
        $Allpermissions=Permission::get("name")->toArray();

        // dd([$Allpermissions,$Rolepermissions]);
        


        return view("admin.roles.edit",compact("Rolepermissions","role","Allpermissions"));

        
    }


      public function update(Request $request,Role $role)
    {
        

     
   
        $role->update([
            "name"=>$request->name
        ]);

         $role->syncPermissions();

         if(isset($request->permissions)){
            foreach($request->permissions as $permission){
                $role->givePermissionTo($permission);
            }
          }

            return redirect()->back()->with("update-role","role update successfully");
    }
}
