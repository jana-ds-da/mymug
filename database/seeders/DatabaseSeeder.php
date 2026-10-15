<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\CategorySeeder;
use Database\seeders\ProductSeeder;
use Database\Seeders\RolePermissionSeeder;


class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
{

    $this->call([
        DepartmentSeeder::class,
        UserSeeder::class,
        RolePermissionSeeder::class,
        CategorySeeder::class,
        CategoryTranslationSeeder::class,
        ProductSeeder::class,
        ProductTranslationSeeder::class,

    ]);


}
}