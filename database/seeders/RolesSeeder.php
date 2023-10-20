<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::updateOrCreate(['name' => 'admin'],['name' => 'admin']);

        $permissionIDs = Permission::get('id')->toArray();

        $role = Role::where('name','admin')->first();
        $role->syncPermissions($permissionIDs);
    }
}
