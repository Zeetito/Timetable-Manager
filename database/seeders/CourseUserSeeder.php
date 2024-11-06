<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Course;
use App\Models\Semester;
use App\Models\CourseUser;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CourseUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $count = 0;
        // foreach(User::staff()->get() as $user){
        //     if($user->courses){
        //         $count++;
        //     }
        // }
        // echo $count;
        // Staff
        // foreach(Course::all() as $course){
        //     $instance = new CourseUser;
        //     $instance->course_id = $course->id;
        //     $instance->user_id = User::staff()->get()->random()->id;
        //     $instance->semester_id = Semester::getActiveSemester()->id;
        //     $instance->save();
        // }

        // Students
        foreach(User::students()->get() as $student){
            $classgroup = $student->class_group;
            // Register Core Courses
            foreach($classgroup->core_courses as $course){

                $instance = new CourseUser;
                $instance->user_id = $student->id;
                $instance->course_id = $course->id;
                $instance->semester_id = Semester::getActiveSemester()->id;
                $instance->save();

            }

            // Register Elective courses if any exist and the elective per student is greater than 0
            if($classgroup->elective_courses->count() > 0 ){

                $elective_per_student = $classgroup->current_elective_per_student;
                $elective_per_student === 0 ? $elective_per_student = 1 : $elective_per_student = $elective_per_student;

                $elective_courses_id =  $classgroup->elective_courses->pluck('id')->toArray();

                // Get random elective for the current user based on the number of electives per student for the classgroup
                $randomKeys = array_rand($elective_courses_id, $elective_per_student);
                if (!is_array($randomKeys)) {
                    $randomKeys = [$randomKeys];
                }

                foreach($randomKeys as $key){

                    $instance = new CourseUser;
                    $instance->user_id = $student->id;
                    $instance->course_id = $elective_courses_id[$key];
                    $instance->semester_id = Semester::getActiveSemester()->id;
                    $instance->save();

                }
            }
        }
    }
}
