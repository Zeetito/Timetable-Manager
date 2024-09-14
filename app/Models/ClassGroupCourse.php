<?php

namespace App\Models;

use App\Models\Course;
use App\Models\ClassGroup;
use App\Models\Scopes\SemesterScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;

#[ScopedBy([SemesterScope::class])]
class ClassGroupCourse extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_group_id',
        'course_id',
        'is_elective',
        'semester_id',
    ];


    public function class_group()
    {
        return $this->belongsTo(ClassGroup::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }



}
