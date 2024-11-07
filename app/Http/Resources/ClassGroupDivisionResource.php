<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClassGroupDivisionResource extends JsonResource
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
            'code' => $this->code,
            'class_group_id' => $this->class_group_id,
            'users_id' => $this->users_id,
            'class_group' => new ClassGroupResource($this->whenLoaded('class_group')),
        ];
    }
}
