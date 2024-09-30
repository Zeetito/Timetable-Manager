<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'username' => $this->username,
            'firstname' => $this->firstname,
            'othername' => $this->othername,
            'lastname' => $this->lastname,
            'gender' => $this->gender,
            'identity_number' => $this->identity_number,
            'index_number' => $this->index_number,
            'is_staff' => $this->is_staff,
            'department_id' => $this->department_id,
            'class_group_id' => $this->class_group_id,
            'email' => $this->email,
            'email_verified_at' => $this->email_verified_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'semester_id' => $this->semester_id,
            'stream' => $this->stream,
            'class_name' => $this->class_name,
            'role_level' => $this->role_level,
            // 'subject_name' => $this->when(isset($this->laravel_through_key), fn() => $this->role->name.' - '.$this->role->subject_name),
            'role' => $this->role 
            ? $this->role->name . (isset($this->role->subject_name) ? ' - ' . $this->role->subject_name : '') 
            : ($this->is_staff ? "staff" : "student"),

        ];
    }
}
