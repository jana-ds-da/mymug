<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'view dashboard']);

        Permission::create(['name' => 'view products']);
        Permission::create(['name' => 'create products']);
        Permission::create(['name' => 'edit products']);
        Permission::create(['name' => 'delete products']);

        Permission::create(['name' => 'view orders']);
        Permission::create(['name' => 'manage orders']);

        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'manage users']);

        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'manage roles']);

        
        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'Manager']);
        Role::create(['name' => 'Customer']);

        $admin = Role::findByName('Admin');
        $manager = Role::findByName('Manager');

        $admin->givePermissionTo(Permission::all());

        $manager->givePermissionTo(
            Permission::where('name', '!=', 'manage users')->get()
        );
    }
}
