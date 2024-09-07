<?php

namespace App\Models;

use App\Models\AcademicYear;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Semester extends Model
{
    use HasFactory;

    protected $fillable = [
        'value',
        'start_date',
        'end_date',
        'is_active',
        'academic_year_id',
    ];

    // RELATIONSHIPS

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }


    // PUBLIC STATIC FUNCTION

    public static function getActiveSemester()
    {
        return self::where('is_active', 1)->first();
    }

}
