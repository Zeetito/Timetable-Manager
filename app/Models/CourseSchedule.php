<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Course;
use App\Models\CourseSchedule;
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
        'stream',
        'room_id',
        'day',
        'class_codes',
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

    // ATTTRIBUTES
    // Get the duration attribute
    public function getDurationAttribute()
    {
        $timeA = $this->start_time;
        $timeB = $this->end_time;

        // Convert the strings to Carbon instances
        $carbonA = Carbon::createFromFormat('H:i:s', $timeA);
        $carbonB = Carbon::createFromFormat('H:i:s', $timeB);

        // Get the difference in hours and minutes
        $hours = $carbonA->diffInHours($carbonB);
        $minutes = $carbonA->diffInMinutes($carbonB) % 60;

        // Format the result
        $result = $hours . ' Hour' . ($hours > 1 ? 's' : '') . ' and ' . $minutes . ' Minute' . ($minutes > 1 ? 's' : '');

        return $result;
    }

    // Get ApproxDurationAttribute
    public function getApproxDurationAttribute()
    {
        $timeA = $this->start_time;
        $timeB = $this->end_time;

        // Convert the strings to Carbon instances
        $carbonA = Carbon::createFromFormat('H:i:s', $timeA);
        $carbonB = Carbon::createFromFormat('H:i:s', $timeB);

        // Get the difference in minutes
        $diffInMinutes = $carbonA->diffInMinutes($carbonB);

        // Convert the difference to hours and round to the nearest hour
        $diffInHours = round($diffInMinutes / 60);

        return $diffInHours;
    }

    // RELATIONSSHIPS

    // Course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Classgroup
    public function class_groups(String $stream){
        return ClassGroup::whereIn('id',$this->course->class_groups_of_stream($stream)->pluck('id'))->get();
    }



    // STATIC FUNCTION
    // Course Schedule instances for Stream
    public static function course_schedules_for_stream(String $stream){
        return CourseSchedule::where('stream',$stream)->get();
    }
    
}

