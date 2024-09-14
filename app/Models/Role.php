<?php

namespace App\Models;

use App\Models\User;
use App\Models\RoleUser;
use Illuminate\Support\Str;
use App\Http\Resources\RoleResource;
use App\Http\Resources\UserResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'level',
        'subject_type',
    ];

    // Attributes
    // Get subjectname attribute if laravel_through_key is provided
    public function getSubjectNameAttribute()
    {
        if ($this->laravel_through_key) {
            $instance =  RoleUser::find($this->laravel_through_key);

            if($instance->subjectable_id == null){
                return "All ".Str::plural($this->subject_type);
            }else{
                return $instance->subjectable->name;
            }

        }
        return null;
    }

     // Override the toArray method
     public function toArray()
     {
         // Use UserResource to transform the model's array
         return (new RoleResource($this))->resolve();
     }
 
     // Override the toJson method
     public function toJson($options = 0)
     {
         // Use RoleRe to transform the model's JSON representation
         return (new RoleResource($this))->toJson($options);
     }

    // RELATIONSHIPS
    // Users
        // Relationship with users through the RoleUser pivot table
       public function users()
       {
        return $this->hasManyThrough(User::class, RoleUser::class, 'role_id', 'id', 'id', 'user_id');
       }
}
