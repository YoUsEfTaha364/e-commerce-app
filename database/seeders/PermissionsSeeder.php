<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions=[
            //product
            "products.view",
            "products.create",
            "products.edit",
            "products.delete",
           // admin
            "admins.view",
            "admins.create",
            "admins.edit",
            "admins.delete",
            // category
            "categories.view",
            "categories.create",
            "categories.edit",
            "categories.delete",
            // orders
            "orders.view",
            "orders.cancel",
            "orders.update_status",
            // roles
            "roles.create",
            "roles.view",
            "roles.update",
            "roles.delete",
            "settings.manage"

        ];

        foreach($permissions as $permission){

           Permission::updateOrCreate(["name"=>$permission],[
            "name"=>$permission,
            "guard_name"=>"admin"
           ]);

        }
    }
}
