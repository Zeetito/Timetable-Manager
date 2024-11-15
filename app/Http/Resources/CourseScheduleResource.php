<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseScheduleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'course_id' => $this->course_id,
            'course_credit_hour' => $this->course->credit_hour,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'stream' => $this->stream,
            'approx_duration' => $this->approx_duration,
            'duration_in_words' => $this->duration,
            'room_id' => $this->room_id,
            'class_codes' => $this->class_codes,
            'day' => $this->day,
            'semester_id' => $this->semester_id,
        ];
    }
}
