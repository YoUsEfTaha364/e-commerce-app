<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Http\Requests\AdminUpdateRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminController extends Controller implements HasMiddleware
{

      public static function middleware(): array
    {
       
        return [
            "c-auth",
            new Middleware("authorize-admin:admins.create,admins.edit,admins.view,admins.delete"),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins=Admin::get();

                 return view("admin.admins.index",compact("admins"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles=Role::get();

     return view("admin.admins.create",compact("roles"));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminRequest $request)
    {
        $validated=$request->validated();

        
       
        $admin=Admin::create([
         "name"=> $validated["name"],
         "email"=> $validated["email"],
         "password"=> Hash::make($validated["password"]),

        ]);

        $admin->assignRole($validated["role"]);

        return redirect()->back()->with("create-admin","admin created successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        $permissions=Permission::where("guard_name","admin")->get()->toArray();

        // dd($permissions);
       
     return view("admin.admins.view",compact("admin","permissions"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        $roles=Role::where("guard_name","admin")->get();


     return view("admin.admins.edit",compact("roles","admin"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminUpdateRequest $request, Admin $admin)
    {
        $validated=$request->validated();
        $admin->update([
            "name"=>$validated["name"],
            "email"=>$validated["email"],
        ]);

        $admin->syncRoles($validated["role"]);

      
        return redirect()->back()->with("update-admin","admin updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
