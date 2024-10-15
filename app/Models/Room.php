<?php

namespace App\Models;

use App\Models\Department;
use App\Models\CourseSchedule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'department_id',
        'floor',
        'type ',
        'exams_cap',
        'reg_cap',
        'max_cap',
        'location',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    // return courseschedule;
    public function course_schedules(){
        return $this->hasMany(CourseSchedule::class);
    }
}
