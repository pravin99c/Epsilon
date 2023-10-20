<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            ['name' => 'User list', 'slug' => 'user_list', 'group' => 'User'],
            ['name' => 'User create', 'slug' => 'user_create', 'group' => 'User'],
            ['name' => 'User edit', 'slug' => 'user_edit', 'group' => 'User'],
            ['name' => 'User delete', 'slug' => 'user_delete', 'group' => 'User'],

            ['name' => 'Permission list', 'slug' => 'permission_list', 'group' => 'Permission'],
            ['name' => 'Permission create', 'slug' => 'permission_create', 'group' => 'Permission'],
            ['name' => 'Permission edit', 'slug' => 'permission_edit', 'group' => 'Permission'],
            ['name' => 'Permission delete', 'slug' => 'permission_delete', 'group' => 'Permission'],

            ['name' => 'Role list', 'slug' => 'role_list', 'group' => 'Role'],
            ['name' => 'Role create', 'slug' => 'role_create', 'group' => 'Role'],
            ['name' => 'Role edit', 'slug' => 'role_edit', 'group' => 'Role'],
            ['name' => 'Role delete', 'slug' => 'role_delete', 'group' => 'Role'],
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(['slug' => $permission['slug']],$permission);
        }
    }
}
