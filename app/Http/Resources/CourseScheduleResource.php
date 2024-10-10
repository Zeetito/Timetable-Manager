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
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'stream' => $this->stream,
            'duration' => $this->duration,
            'room_id' => $this->room_id,
            'day' => $this->day,
            'semester_id' => $this->semester_id,
        ];
    }
}
