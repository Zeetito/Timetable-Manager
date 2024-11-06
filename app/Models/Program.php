<?php

namespace App\Models;

use App\Models\User;
use App\Models\College;
use App\Models\Faculty;
use App\Models\Program;
use App\Models\ClassGroup;
use App\Models\Department;
use App\Models\ProgramStream;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        // 'college_id',
        // 'faculty_id',
        'department_id',
        'graduate_type',
        // 'span',
    ];

    // RELATIONSHIPS
    public function college()
    {
        return $this->belongsTo(College::class);
    }

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }


    // Get related program streams
    public function program_streams()
    {
        return $this->hasMany(ProgramStream::class);
    }



    // Users

    // public function students()
    // {
    //     return $this->hasManyThrough(User::class,ProgramStream::class);
    // }




    // PUBLIC STATIC FUNCTIONS
     // Get postGraduate programs
     public static function pg(){
        return self::where('graduate_type','pg')->get();
    }

    // Get undergraduage programs
    public static function ug(){
        return self::where('graduate_type','ug')->get();
    }

    // INSTITUTE OF DISTANCE LEARNING
    public static function idl_programs(){
        return Program::whereBelongsTo(Department::where('name','INSTITUTE OF DISTANCE LEARNING')->first())->get();
    }
}
