<?php

namespace App\Models;

use App\Models\User;
use App\Models\Course;
use App\Models\Program;
use App\Models\ClassGroupCourse;
use App\Models\ClassGroupDivision;
use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\ClassGroupResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClassGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'program_id',
        'year',
        // 'is_divided',
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

    // RELATIONSHIPS
    public function program()
    {
        return $this->belongsTo(Program::class);
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
        return self::whereIn('program_id',Program::pg()->pluck('id'))->get();
    }

    // Get all undergraduage Classgroup
    public static function ug_classgroups(){
        return self::whereIn('program_id',Program::ug()->pluck('id'))->get();
    }

    // idl ClassGroups
    public static function idl_class_groups(){
        return self::whereIn('program_id',Program::idl_programs()->pluck('id'))->get();
    }

}
