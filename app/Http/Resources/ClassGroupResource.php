<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClassGroupResource extends JsonResource
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
            'name' => $this->program->name.'-('. $this->program_stream->type.')',
            // slug
            // 'students_count' => $this->students_count, 
            'is_divided' => $this->is_divided == 1?true:false,
            'year' => $this->year,
            'start_year' => $this->start_year,
            'end_year' => $this->end_year,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
