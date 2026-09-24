<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Department;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $topManagement = Department::where('name', 'Top Management')->first();
        $callCentre = Department::where('name', 'Call Centre')->first();
        $sales = Department::where('name', 'Sales')->first();
        $finance = Department::where('name', 'Finance')->first();
        $marketing = Department::where('name', 'Marketing')->first();
        $quality = Department::where('name', 'Quality')->first();
        $designers = Department::where('name', 'Designers')->first();


       User::updateOrCreate( ['email' => env('ADMIN_EMAIL', 'janamuhammad.ai@gmail.com')],
          [ 'name' => 'jana muhammad',
           'password' => Hash::make(env('ADMIN_PASSWORD', '12345678')),
            'role' => 'admin', 
            'department_id' => $topManagement?->id,]
        );

       User::updateOrCreate( ['email' => 'admin@gmail.com'],
        [ 'name' => 'Admin', 'password' => Hash::make('12345678'), 
        'role' => 'admin',
        'department_id' => $topManagement?->id, ]
        );

        User::updateOrCreate( ['email' => 'callcentre@gmail.com'],
         [ 'name' => 'Call Centre', 'password' => Hash::make('12345678'),
          'role' => 'manager',
          'department_id' => $topManagement?->id, ]);

          User::updateOrCreate( ['email' => 'manager@gmail.com'],
         [ 'name' => 'Manager', 'password' => Hash::make('12345678'),
          'role' => 'manager',
          'department_id' => $callCentre?->id, ]);

          User::updateOrCreate( ['email' => 'sales@gmail.com'],
         [ 'name' => 'Sales', 'password' => Hash::make('12345678'),
          'role' => 'manager',
          'department_id' => $sales?->id, ]);

          User::updateOrCreate( ['email' => 'finance@gmail.com'],
         [ 'name' => 'Finance', 'password' => Hash::make('12345678'),
          'role' => 'manager',
          'department_id' => $finance?->id, ]);

           User::updateOrCreate( ['email' => 'marketing@gmail.com'],
         [ 'name' => 'Marketing', 'password' => Hash::make('12345678'),
          'role' => 'manager',
          'department_id' => $marketing?->id, ]);

           User::updateOrCreate( ['email' => 'quality@gmail.com'],
         [ 'name' => 'Quality', 'password' => Hash::make('12345678'),
          'role' => 'manager',
          'department_id' => $quality?->id, ]);

           User::updateOrCreate( ['email' => 'designers@gmail.com'],
         [ 'name' => 'Designers', 'password' => Hash::make('12345678'),
          'role' => 'manager',
          'department_id' => $designers?->id, ]);

          

        User::updateOrCreate( ['email' => 'Customer@gmail.com'],
         [ 'name' => 'Customer', 'password' => Hash::make('12345678'), 
         'role' => 'customer',
         'department_id' => null, ] );  
    }
}
