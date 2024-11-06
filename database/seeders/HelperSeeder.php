<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Course;
use App\Models\Program;
use App\Models\Semester;
use App\Models\ClassGroup;
use App\Models\Department;
use Illuminate\Database\Seeder;
use App\Models\ClassGroupCourse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class HelperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        // Create course instances for undergraduate classgroups
            // Foreach(ClassGroup::ug_classgroups() as $classgroup){
            //     // Set Credit hour limit
            //     $credit_hour_limit = rand(17,21);
            //     $assigned_credit_hour = 0;

            //     while($assigned_credit_hour < $credit_hour_limit){
            //         // Create a new course 
            //         $course = new Course;
            //         $course->name = ucwords(fake()->sentence());
            //         $course->code = fake()->word();
            //         // The Code must be 3 or 4 letters
            //         if(strlen($course->code) < 3 || strlen($course->code) > 4) {
            //             // if not, Repeat the step
            //             continue;
            //         }else{
            //             $course->code = strtoupper($course->code).' '.rand(100, 999);
            //         }
            //         $course->credit_hour = rand(1,3);
            //         $course->department_id = $classgroup->department->id;
            //         $course->graduate_type = 'ug';
            //         // $lecturers_id = [];
            //         $course->save();


            //         // Create a new ClassGroupCourse Instance
            //         $cgc = new ClassGroupCourse;
            //         $cgc->class_group_id = $classgroup->id; 
            //         $cgc->course_id = $course->id; 
            //         $cgc->semester_id = Semester::getActiveSemester()->id;
            //         $cgc->save();


            //         $assigned_credit_hour += $course->credit_hour;

            //     }

            // }
        


        // Create course instances for postgraduate classgroups
            // Foreach(ClassGroup::pg_classgroups() as $classgroup){
            //     // Set Credit hour limit
            //     $credit_hour_limit = rand(10,15);
            //     $assigned_credit_hour = 0;
    
            //     while($assigned_credit_hour < $credit_hour_limit){
            //         // Create a new course 
            //         $course = new Course;
            //         $course->name = ucwords(fake()->sentence());
            //         $course->code = fake()->word();
            //         // The Code must be 3 or 4 letters
            //         if(strlen($course->code) < 3 || strlen($course->code) > 4) {
            //             // if not, Repeat the step
            //             continue;
            //         }else{
            //             $course->code = strtoupper($course->code).' '.rand(100, 999);
            //         }
            //         $course->credit_hour = rand(1,3);
            //         $course->department_id = $classgroup->department->id;
            //         $course->graduate_type = 'pg';
            //         // $lecturers_id = [];
            //         $course->save();

            //         // Create a new ClassGroupCourse Instance
            //         $cgc = new ClassGroupCourse;
            //         $cgc->class_group_id = $classgroup->id; 
            //         $cgc->course_id = $course->id; 
            //         $cgc->semester_id = Semester::getActiveSemester()->id;
            //         $cgc->save();

            //         $assigned_credit_hour += $course->credit_hour;
    
            //     }

            // }

        
        // Create Borrowed Courses for 50 both ug and pg classgroups
        // $count = 0;
        // while($count < 50){
        //     $classgroup = ClassGroup::pg_classgroups()->random();

        //     // Check if the classgroup has courses over 21 credit hour for the sem
        //     if($classgroup->courses()->sum('credit_hour') > 14){
        //         continue;
        //     }

        //     $cgc = new ClassGroupCourse;
        //     $cgc->class_group_id = $classgroup->id; 
        //     $cgc->course_id = $classgroup->possibleElectiveCourses()->random()->id; 
        //     $cgc->semester_id = Semester::getActiveSemester()->id;
        //     $cgc->save();
        //     $count++;
        // }

        // Create Elective Course for 50 both ug and pg classgroups
        // $count = 0;
        // while($count < 50){

        //     $classgroup = ClassGroup::pg_classgroups()->random();
        //     $assigned_credit_hour = $classgroup->courses()->sum('credit_hour');

        //     // Check if the classgroup has courses over 21 credit hour for the sem
        //     if($assigned_credit_hour > 11){
        //         continue;
        //     }

        //     $credit_hour_limit = 15;


        //     while($assigned_credit_hour <= $credit_hour_limit){

        //         // Create a new course 
        //         $course = new Course;
        //         $course->name = ucwords(fake()->sentence());
        //         $course->code = fake()->word();
        //         // The Code must be 3 or 4 letters
        //         if(strlen($course->code) < 3 || strlen($course->code) > 4) {
        //             // if not, Repeat the step
        //             continue;
        //         }else{
        //             $course->code = strtoupper($course->code).' '.rand(100, 999);
        //         }
        //         $course->credit_hour = rand(1,3);
        //         $course->department_id = $classgroup->department->id;
        //         $course->graduate_type = 'pg';
        //         // $lecturers_id = [];
        //         $course->save();



        //         $cgc = new ClassGroupCourse;
        //         $cgc->class_group_id = $classgroup->id; 
        //         $cgc->course_id = $classgroup->possibleElectiveCourses()->random()->id; 
        //         $cgc->is_elective = 1; 
        //         $cgc->semester_id = Semester::getActiveSemester()->id;
        //         $cgc->save();
        //         //increments..
        //         $count++;
        //         $assigned_credit_hour += $course->credit_hour;

        //     }



                    


           
        // }

        // Get the Elective per student attribute for the classgroups with electives
        $classgroups = ClassGroup::whereHas('courses', function($q){
            $q->where('is_elective', 1);
        })->get();

        foreach($classgroups as $classgroup){

            $classgroup->current_elective_per_student = intval($classgroup->elective_courses->count()/2);
            $classgroup->save();
        }

    }

}
