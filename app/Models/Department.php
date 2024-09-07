<?php

namespace App\Models;

use App\Models\Course;
use App\Models\College;
use App\Models\Faculty;
use App\Models\Program;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'college_id',
        'faculty_id',
        'location',
    ];

    // RELATIONSHIPS
    public function college()
    {
        return $this->belongsTo(College::class);
    }

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    public function programs()
    {
        return $this->hasMany(Program::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
