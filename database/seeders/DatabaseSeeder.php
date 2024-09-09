<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
            $this->call(AcademicYearSeeder::class);
            $this->call(SemesterSeeder::class);

          $this->call(CollegeSeeder::class);
          $this->call(FacultySeeder::class);
          $this->call(DepartmentSeeder::class);
          $this->call(ProgramSeeder::class);
    }
}
