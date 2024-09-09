<?php

namespace App\Models;

use App\Models\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
         'name',
         'code',
         'credit_hour',
         'lecturers_id',
         'department_id ',
    ];

    // RELATIONSHIPS
    public function department()
    {
        return $this->belongsTo(Department::class);
    }


    // PUBLIC STATIC FUNCTION
    // Get idl courses
    public static function idl_courses(){
        return Course::whereBelongsTo(Department::where('name','INSTITUTE OF DISTANCE LEARNING')->first())->get();

    }
}
