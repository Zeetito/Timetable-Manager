<?php

namespace App\Models;

use App\Models\User;
use App\Models\Course;
use App\Models\College;
use App\Models\Faculty;
use App\Models\Program;
use App\Models\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'college_id',
        'faculty_id',
        'location',
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

    public function programs()
    {
        return $this->hasMany(Program::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }


 // Get PostGraduate programs
    public function pg_programs(){
        return Program::pg()->get()->intersect($this->programs);
    }

    // Get Undergraduate programs
    public function ug_programs(){
        return $this->programs->diff($this->pg_programs());
    }

    // Get idl programs
    public function idl_programs(){
        // return $this->programs->intersect(Program::idl_programs());
        return Program::idl_programs()->intersect($this->programs);
    }

    // Get Regular programs
    public function regular_programs(){
        return $this->programs->diff($this->idl_programs());
    }

    // Return Students of this faculty
    public function students(){
        return User::whereBelongsTo($this->programs)->get();
    }

    // Return PostGraduate Students
    public function pg_students(){
        return $this->students()->whereIn('program_id',$this->pg_programs()->pluck('id'));
    }

    // Get Undergraduate Students
    public function ug_students(){
        return $this->students()->diff($this->pg_students());
    }

}
