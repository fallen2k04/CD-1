<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\Course;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Add sample data for Students
        Student::create(['student_code' => 'SV001', 'name' => 'Nguyễn Văn A']);
        Student::create(['student_code' => 'SV002', 'name' => 'Trần Thị B']);
        Student::create(['student_code' => 'SV003', 'name' => 'Lê Văn C']);

        // Add sample data for Courses
        Course::create(['name' => 'Lập trình PHP', 'credits' => 3]);
        Course::create(['name' => 'Cơ sở dữ liệu', 'credits' => 4]);
        Course::create(['name' => 'Thiết kế Web', 'credits' => 2]);
    }
}
