<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class AssignApiAdminRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

         Role::updateOrCreate([
            'name' => 'super-admin',
            'guard_name' => 'web',
        ]);
        $admin=User::where("id",4)->first();

        $admin->assignRole("super-admin");
    }
}
