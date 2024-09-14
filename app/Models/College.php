<?php

namespace App\Models;

use App\Models\User;
use App\Models\Course;
use App\Models\Faculty;
use App\Models\Program;
use App\Models\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class College extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
    ];

    // RELATIONSHIPS

    public function departments()
    {
        return $this->hasMany(Department::class);
    }

    public function factulies()
    {
        return $this->hasMany(Faculty::class);
    }

    public function programs()
    {
        return $this->hasMany(Program::class);
    }

    public function users(){
        return User::whereBelongsTo($this->programs)->get();
    }

    // Get Students
    public function students(){
        return $this->users()->where('is_staff',0);
    }

    // Get PostGraduate Students
    public function pg_students(){
        return $this->students()->whereIn('program_id',$this->pg_programs()->pluck('id'));
    }
    // Get Undergraduate Students
    public function ug_students(){
        return $this->students()->diff($this->pg_students());
    }

    // Get Staff
    public function staff(){
        return $this->users()->where('is_staff',1);
    }

    // Get courses
    public function courses(){
        return Course::whereBelongsTo($this->departments)->get();
    }

    // Get Idl Courses
    public function idl_courses(){
        return $this->courses()->intersect(Course::idl_courses());
    }

    // Get Regular Courses
    public function regular_courses(){
        return $this->courses()->diff($this->idl_courses());
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

    // PolyMorphs
    public function user_roles()
    {
        return $this->morphMany(RoleUser::class, 'subjectable');
    }

    
    

}
