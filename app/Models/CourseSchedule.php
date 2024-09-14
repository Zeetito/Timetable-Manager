<?php

namespace App\Models;

use App\Models\Course;
use App\Models\Scopes\SemesterScope;
use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\CourseScheduleResource;
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
        'duration',
        'room_id',
        'day',
        'semester_id',
    ];

    // Override the toArray method
    public function toArray()
    {
        // Use UserResource to transform the model's array
        return (new CourseScheduleResource($this))->resolve();
    }

    // Override the toJson method
    public function toJson($options = 0)
    {
        // Use UserResource to transform the model's JSON representation
        return (new CourseScheduleResource($this))->toJson($options);
    }


    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    
}
