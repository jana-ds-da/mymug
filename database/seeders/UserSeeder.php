<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         User::updateOrCreate( ['email' => env('ADMIN_EMAIL', 'janamuhammad.ai@gmail.com')],
          [ 'name' => 'jana muhammad',
           'password' => Hash::make(env('ADMIN_PASSWORD', '12345678')),
            'role' => 'admin', ]
        );

       User::updateOrCreate( ['email' => 'admin@gmail.com'],
        [ 'name' => 'Admin', 'password' => Hash::make('12345678'), 
        'role' => 'admin', ]
        );

        User::updateOrCreate( ['email' => 'manager@gmail.com'],
         [ 'name' => 'Manager', 'password' => Hash::make('12345678'),
          'role' => 'manager', ]);

        User::updateOrCreate( ['email' => 'Customer@gmail.com'],
         [ 'name' => 'Customer', 'password' => Hash::make('12345678'), 
         'role' => 'customer', ] );  
    }
}
