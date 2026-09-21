<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissionNames = [
            'view dashboard',

            'view products',
            'create products',
            'edit products',
            'delete products',

            'view orders',
            'manage orders',

            'view users',
            'manage users',

            'view roles',
            'manage roles',
        ];

        foreach ($permissionNames as $name) {
            Permission::firstOrCreate([
                'name' => $name,
            ]);
        }

        $admin = Role::firstOrCreate([
            'name' => 'Admin',
        ]);

        $manager = Role::firstOrCreate([
            'name' => 'Manager',
        ]);

        $customer = Role::firstOrCreate([
            'name' => 'Customer',
        ]);

        $allPermissions = Permission::whereIn('name', $permissionNames)->get();

        
        $admin->syncPermissions($allPermissions);

        
        $manager->syncPermissions(
            $allPermissions->where('name', '!=', 'manage users')
        );

       
        $customer->syncPermissions([]);

        
        $jana = User::where(
           'email',
           env('ADMIN_EMAIL', 'janamuhammad.ai@gmail.com')
        )->first();

        if ($jana) {
             $jana->syncRoles(['Admin']);
        }

        $adminUser = User::where(
         'email',
         'admin@gmail.com'
        )->first();

         if ($adminUser) {
               $adminUser->syncRoles(['Admin']);
        }

         $managerUser = User::where(
            'email',
            'manager@gmail.com'
         )->first();

         if ($managerUser) {
            $managerUser->syncRoles(['Manager']);
         }

         $customerUser = User::where(
            'email',
            'costomer@gmail.com'
         )->first();

         if ($customerUser) {
              $customerUser->syncRoles(['Customer']);
         }

    }
}

