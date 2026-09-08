<?php

namespace Database\seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\seeder;
use Database\seeders\ProductSeeder;

class DatabaseSeeder extends seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
{   
   




    $this->call([
        UserSeeder::class,
        CategorySeeder::class,
        ProductSeeder::class,
    ]);



    

    $this->call([
         CategorySeeder::class,
         ProductSeeder::class,
    ]);


    
    
    $this->call([
        ProductSeeder::class,
    ]);

    User::factory()->create([
        'name' => 'Test User',
        'email' => 'test@example.com',
    ]);
}
}
