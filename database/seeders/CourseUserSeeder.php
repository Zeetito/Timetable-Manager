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
        // Staff
        // foreach(Course::all() as $course){
        //     $instance = new CourseUser;
        //     $instance->course_id = $course->id;
        //     $instance->user_id = User::staff()->get()->random()->id;
        //     $instance->semester_id = Semester::getActiveSemester()->id;
        //     $instance->save();
        // }

        // Students
        foreach(User::students()->where('id','>',63840)->get() as $student){
            foreach($student->class_group->courses as $course){

                $instance = new CourseUser;
                $instance->user_id = $student->id;
                $instance->course_id = $course->id;
                $instance->semester_id = Semester::getActiveSemester()->id;
                $instance->save();

            }
        }
    }
}
