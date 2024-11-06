<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Semester;
use App\Models\ClassGroup;
use Illuminate\Database\Seeder;
use App\Models\ClassGroupCourse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ClassGroupCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $semesters = Semester::all();
        $classgroups = ClassGroup::all();

        // foreach($semesters as $semester){
            foreach($classgroups as $classgroup){

                // Set the core courses
                foreach($classgroup->department->coursesForYear($classgroup->year) as $course){
                    $cgc = new ClassGroupCourse;
                    $cgc->class_group_id = $classgroup->id; 
                    $cgc->course_id = $course->id; 
                    $cgc->semester_id = Semester::getActiveSemester()->id;
                    $cgc->save();

                }

                // Handle the elective courses
                for($i=1; $i<=rand(1,2); $i++){
                    $cgc = new ClassGroupCourse;
                    $cgc->class_group_id = $classgroup->id; 
                    $cgc->course_id = $classgroup->possibleElectiveCourses()->random()->id; 
                    $cgc->is_elective = 1; 
                    $cgc->semester_id = Semester::getActiveSemester()->id;
                    $cgc->save();
                }

            }
        // }
    }
}
