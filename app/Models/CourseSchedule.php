<?php

namespace App\Models;

use App\Models\Course;
use App\Models\Scopes\SemesterScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;

#[ScopedBy([SemesterScope::class])]
class CourseSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'start_time',
        'end_time',
        'room_id',
        'day',
        'semester_id',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    
}
