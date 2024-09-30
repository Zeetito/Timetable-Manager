<?php

namespace App\Models;

use App\Models\User;
use App\Models\Course;
use App\Models\Semester;
use App\Models\Scopes\SemesterScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;

#[ScopedBy([SemesterScope::class])]
class CourseUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'course_id',
        'midsem_score',
        'assessment_score',
        'exam_score',
        'total_score',
        'semester_id',
    ];

    // RELATIONSHIPS
    // Get user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Get course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Get Semester
    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }
}
