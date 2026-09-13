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
         User::updateOrCreate(
            ['email' => env('ADMIN_EMAIL', 'janamuhammad.ai@gmail.com')],
            [
                'name' => 'jana muhammad',
                'password' => Hash::make(env('ADMIN_PASSWORD', 'password123')),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => env('ADMIN_EMAIL_2', 'salmahamdy1220@gmail.com')],
            [
                'name' => 'salma hamdy',
                'password' => Hash::make(env('ADMIN_PASSWORD_2', 'password123')),
                'role' => 'admin',
            ]
        );
    }
}
