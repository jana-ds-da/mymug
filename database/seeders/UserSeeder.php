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
        User::create([
            'name' => 'jana muhammad',
            'email' => env( 'ADMIN_EMAIL' ,'janamuhammad.ai@gmail.com'),
            'password' => Hash::make(env('ADMIN_PASSWORD', 'password123')),
        ]);
    }
}
