<?php

namespace App\Models;

use App\Models\User;
use App\Models\ClassGroup;
use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\ClassGroupDivisionResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClassGroupDivision extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_group_id',
        'division_number',
        'users_id',
    ];

    protected $casts = [
        'users_id' => 'array',
    ];

     // Override the toArray method
     public function toArray()
     {
         // Use ClassGroupDivisionResource to transform the model's array
         return (new ClassGroupDivisionResource($this))->resolve();
     }
 
     // Override the toJson method
     public function toJson($options = 0)
     {
         // Use ClassGroupDivisionResource to transform the model's JSON representation
         return (new ClassGroupDivisionResource($this))->toJson($options);
     }
 

    public function class_group()
    {
        return $this->belongsTo(ClassGroup::class);
    }

    public function users()
    {
        return User::whereIn('id', $this->users_id)->get();
    }

}
