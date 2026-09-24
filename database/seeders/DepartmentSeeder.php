<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            'Top Management',
            'Call Centre',
            'Sales',
            'Finance',
            'Marketing',
            'Quality',
            'Designers',
        ];

         foreach ($departments as $department) {
            Department::updateOrCreate([
                'name' => $department,
                ['status' => false]
            ]);
        }
    }
}
