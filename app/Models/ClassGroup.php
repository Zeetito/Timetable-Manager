<?php

namespace App\Models;

use App\Models\User;
use App\Models\Course;
use App\Models\Program;
use App\Models\ClassGroup;
use App\Models\ProgramStream;
use App\Models\CourseSchedule;
use App\Models\ClassGroupCourse;
use App\Models\ClassGroupDivision;
use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\ClassGroupResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClassGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'program_stream_id',
        'year',
        'is_divided',
        'current_elective_per_student',
        'start_year',
        'end_year',
    ];

     // Override the toArray method
     public function toArray()
     {
         // Use ClassGroupResource to transform the model's array
         return (new ClassGroupResource($this))->resolve();
     }
 
     // Override the toJson method
     public function toJson($options = 0)
     {
         // Use ClassGroupResource to transform the model's JSON representation
         return (new ClassGroupResource($this))->toJson($options);
     }
 

    // Attributes
    // Get courses attribute
    public function getCoursesAttribute()
    {
        $courses = Course::whereIn('id', ClassGroupCourse::where('class_group_id', $this->id)->pluck('course_id'))->get();
        return $courses;
    }

    // Get courseScheuldes attribute
    public function getCourseSchedulesAttribute()
    {
        return CourseSchedule::whereBelongsTo($this->courses)->get();
    }


    // get stream attribute
    public function getStreamAttribute()
    {
        return $this->program_stream->type;
    }

    // Get Elective Courses Attribute
    public function getElectiveCoursesAttribute()
    {
        $courses = Course::whereIn('id', ClassGroupCourse::where('class_group_id', $this->id)->where('is_elective',1)->pluck('course_id'))->get();
        return $courses;
    }

    // Get Core Courses Attribute
    public function getCoreCoursesAttribute()
    {
        $courses = Course::whereIn('id', ClassGroupCourse::where('class_group_id', $this->id)->where('is_elective',0)->pluck('course_id'))->get();
        return $courses;
    }


    // Get Student Count Attribute
    public function getStudentsCountAttribute()
    {
        return $this->users()->count();
    }

    // Get department attribute
    public function getDepartmentAttribute()
    {
        return $this->program->department;
    }

    // Get graduate type attribute
    public function getGraduateTypeAttribute()
    {
        return $this->program->graduate_type;        
    }



    // RELATIONSHIPS
    // COURSES
    // Get all ppssible elective courses
    public function possibleElectiveCourses(){
        return Course::all()->diff($this->department->courses);
    }

    // ProgramStream
    public function program_stream()
    {
        return $this->belongsTo(ProgramStream::class,'program_stream_id');
    }


    public function getProgramAttribute()
    {
        return $this->program_stream->program;
    }

    // get college
    public function college(){
        return $this->program->college;
    }

    public function users()
    {
        return $this->hasMany(User::class);
}

    public function divisions()
    {
        return $this->hasMany(ClassGroupDivision::class);
    }

    public function courses(){
        return $this->belongsToMany(Course::class, ClassGroupCourse::class);
    }

    // PUBLIC STATIC FUNCTION
    // Get all postGraduate classgroups
    public static function pg_classgroups(){
        return self::whereHas('program_stream', function ($query) {
            $query->whereBelongsTo(Program::pg());
        })->get();
    }

    // Get all undergraduage Classgroup
    public static function ug_classgroups(){
        return self::whereHas('program_stream', function ($query) {
            $query->whereBelongsTo(Program::ug());
        })->get();
    }

    // Get all regular ClassGroups
    public static function regular_classgroups(){
        return ClassGroup::all()->filter(function ($classgroup) {
            return $classgroup->stream == 'regular';
        })->values();
    }

    // Get all idl ClassGroups
    public static function idl_classgroups(){
        return ClassGroup::all()->filter(function ($classgroup) {
            return $classgroup->stream == 'idl';
        })->values();
    }

    // Get all parallel ClassGroups
    public static function parallel_classgroups(){
        return ClassGroup::all()->filter(function ($classgroup) {
            return $classgroup->stream == 'parallel';
        })->values();
    }

    // Get all classgroups for a particular stream
    public static function classgroups_of_stream($string){

        $allowedStrings = ['idl', 'regular', 'parallel'];

        // Check if the passed string is one of the allowed values
        if (!in_array($string, $allowedStrings)) {
            // Throw an exception or return an error message if the string is not allowed
            throw new InvalidArgumentException("Invalid stream type. Allowed types are: " . implode(", ", $allowedStrings));
        }

        return ClassGroup::all()->filter(function ($classgroup) use($string) {
            return $classgroup->stream == $string;
        })->values();
    }

    // ClassGroups with courses less than a speicfic credithour
    public static function classgroups_with_less_than($credithour){
        return ClassGroup::all()->filter(function ($classgroup) use($credithour) {
            return $classgroup->courses->sum('credit_hour') < $credithour;
        })->values();
    }

}
