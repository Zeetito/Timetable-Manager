<?php

namespace App\Models;

use App\Models\User;
use App\Models\Course;
use App\Models\RoleUser;
use App\Models\ClassGroup;
use App\Models\CourseUser;
use App\Models\Department;
use InvalidArgumentException;
use App\Models\CourseSchedule;
use App\Models\ClassGroupCourse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
         'name',
         'code',
         'credit_hour',
         'lecturers_id',
         'department_id ',
         'year',
         'graduate_type',
    ];

    // ATTRIBUTES
    // Get Scheduled Streams Attribute
    public function getScheduledStreamsAttribute()
    {
        $streams = [];
        foreach(['idl', 'regular', 'parallel'] as $stream) {
            if ($this->course_schedules){
                foreach ($this->course_schedules as $course_schedule) {
                    if ($course_schedule->stream == $stream) {
                        $streams[] = $stream;
                    }
                }
            }else{
                return $streams;
            }
        }
        return $streams;

    }


    // Get registered Streams
    public function getRegisteredStreamsAttribute()
    {
        return $this->class_groups()->pluck('stream')->unique()->toArray();
    }


    // RELATIONSHIPS
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    // College
    public function college()
    {
        return $this->department->college;
    }

    // COURSE SCHEDULE
    // Index scoped by semester
    public function course_schedules()
    {
        return $this->hasMany(CourseSchedule::class);
    }

    public function course_schedules_for_stream($string)
    {
        return $this->course_schedules()->where('stream', $string)->get();
    }


    // All users related to the course for that particular course
    public function users(){
        return User::whereIn('id',CourseUser::where('course_id',$this->id)->pluck('user_id'))->get();
    }


    // Get Students
    public function students()
    {
        return $this->users()->where('is_staff', 0);

    }

    // Get Staff for a particular course at a sem
    public function staff()
    {
        return $this->users()->where('is_staff', 1);
    }

    // Get ClassGroups
    public function class_groups()
    {
        return ClassGroup::whereIn('id', ClassGroupCourse::where('course_id', $this->id)->pluck('class_group_id'))->get();
        // return $this->belongsToMany(ClassGroup::class, 'class_group_courses', 'course_id', 'class_group_id');

    }

    // Get Regular ClassGroups
    public function class_groups_of_stream($string){

        $allowedStrings = ['idl', 'regular', 'parallel'];

        // Check if the passed string is one of the allowed values
        if (!in_array($string, $allowedStrings)) {
            // Throw an exception or return an error message if the string is not allowed
            throw new InvalidArgumentException("Invalid stream type. Allowed types are: " . implode(", ", $allowedStrings));
        }

        $class_groups = $this->class_groups();
        $target = collect();
        foreach($class_groups as $group){
            if($group->stream == $string){
                $target->push($group);
            }

        }
        return $target;
    }



    // PolyMorphs
    public function user_roles()
    {
        return $this->morphMany(RoleUser::class, 'subjectable');
    }

    // Get Related Rooms


    // FUNCTIONS
    // check if a course is registered for a particular stream
    public function isRegisteredForStream($string)
    {
        return in_array($string,$this->registered_streams);
    }

    // check if a course is scheduled for stream
    public function isScheduledForStream($string)
    {
        return in_array($string,$this->scheduled_streams);
    }

    // Check if a course is yet to be scheduled for stream
    public function isYetToBeScheduledForStream($string)
    {
        return in_array($string, $this->registered_streams) 
        && 
        !in_array($string, $this->scheduled_streams);
    }

    // Check if course is fully scheduled for a Stream
    public function isFullyScheduledForStream($string)
    {
        return $this->course_schedules_for_stream($string)->sum('approx_duration') == ($this->credit_hour * $this->schedule_set_for_stream($string));
    }

    // Check if a course should have a divided set of schedule for the given stream
    public function shouldHaveDividedScheduleSets($stream){

        $class_groups = $this->class_groups_of_stream($stream);

        if($class_groups->count() > 1){
            return false;
        }elseif($class_groups->count() == 1 && $class_groups->first()->is_divided == true ){
            return true;
        }else{
            return false;
        }

    }

    /* 
    Get the Schedule set for a course
    This set is the number of sets of the course we can have for a particular stream
    it mostly applies when just one classgroups takes the course and the classgroup is divided
    */

    public function schedule_set_for_stream($string){

        if(!$this->shouldHaveDividedScheduleSets($string)){
            return 1;
        }

        return $this->class_groups_of_stream($string)->first()->divisions->count();
    }

    // Get the class codes for the division sets of the course
    public function class_codes_for_stream($string){
        // check if the course should have a divided sets of schedules
     if($this->shouldHaveDividedScheduleSets($string)){
        $class_groups = $this->class_groups_of_stream($string);
        $target = [];
        foreach($class_groups->first()->divisions as $division){
            $target[] = $division->code;
        }
        return $target;
        // if not
     }else{
        $target = [];
        foreach($this->class_groups_of_stream($string) as $classgroup){
            $target[] = "$classgroup->code";
        }
        return $target;
     }
    }

    // Get the courseSchedules for a particular class_code of a course for a stream
    public function course_schedules_for_class_code($class_code, $string){
        return $this->course_schedules_for_stream($string)
        ->filter(function ($schedule) use ($class_code) {
            return str_contains($schedule->class_codes, $class_code);
            // return in_array([$class_code], $schedule->class_codes); // Check if class_code is in class_codes array
        });
    }

    
    // Check if a class_code is fully scheduled for a particular stream for the related course
    public function is_class_code_fully_scheduled_for_stream($class_code, $string){
        // Filter schedules by checking if $class_code is in the class_codes array for each schedule
        $totalDuration = $this->course_schedules_for_class_code($class_code, $string)->sum('approx_duration');

        return $totalDuration >= $this->credit_hour;
    }

    // Get the next class_code to be scheduled for a particular stream
    public function next_class_code_for_stream($string){

        // if the course should have divided sets
        if($this->shouldHaveDividedScheduleSets($string)){
            $class_codes = $this->class_codes_for_stream($string);
            foreach($class_codes as $class_code){
                if(!$this->is_class_code_fully_scheduled_for_stream($class_code, $string)){
                    return $class_code;
                }
            }
        }else{
            // return the array implode to text

            return  implode(", ", $this->class_codes_for_stream($string));
        }

        
    }

    // Get the remaining duration for a class_code to be scheduled next
    public function remaining_duration_for_class_code($class_code, $string){
        $totalDuration = $this->course_schedules_for_class_code($class_code, $string)->sum('approx_duration');

        return $this->credit_hour - $totalDuration <= 0 ? 0 : $this->credit_hour - $totalDuration ;
    }


    // STATIC FUNCTIONS
    // Get all courses yet to be scheduled for a particular stream
    public static function courses_to_be_scheduled_for_stream(String $string){
        $courses = Course::all()->filter(function ($course) use($string) {
            return $course->isYetToBeScheduledForStream($string);
        });

        return $courses;
    }


    // Get Treshhold for course allocation for a stream
    public static function allocation_treshold_for_stream(String $string){
        $days_count = 0;
        if($string == 'regular'){
            $days_count = 4;
        }//else if($string == 'parallel'){
            // $days_count == 2;
        // }

        return ceil(Course::all()->count() / $days_count);

    }

    // Get the remaining duration to be scheduled for a course
    public function remaining_duration_for_stream(String $string){

        $raw = $this->credit_hour - $this->course_schedules_for_stream($string)->sum('approx_duration');

        return $raw * $this->schedule_set_for_stream($string);
    }

}
