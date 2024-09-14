<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
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
            'name' => $this->name,
            'slug' => $this->slug,
            'level' => $this->level,
            'subject_type' => $this->subject_type,
            // Include subject name if the 'laravel_through_key' exists on the model instance
            'subject_name' => $this->when(isset($this->laravel_through_key), fn() => $this->subject_name),
        ];
        
    }
}
