<?php

namespace App\Models;

use App\Models\Course;
use App\Models\ClassGroup;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClassGroupCourse extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_group_id',
        'course_id',
        'duration',
        'semester_id',
    ];

    public function classGroup()
    {
        return $this->belongsTo(ClassGroup::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }



}
