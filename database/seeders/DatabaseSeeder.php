<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin123'),
            'role' => 'Admin',
        ]);

        User::create([
            'name' => 'Academic Head User',
            'email' => 'academic@example.com',
            'password' => bcrypt('head123'),
            'role' => 'AcademicHead',
        ]);

        User::create([
            'name' => 'Teacher User',
            'email' => 'teacher@example.com',
            'password' => bcrypt('teacher123'),
            'role' => 'Teacher',
        ]);

        User::create([
            'name' => 'Student User',
            'email' => 'student@example.com',
            'password' => bcrypt('student123'),
            'role' => 'Student',
        ]);
    }

}
