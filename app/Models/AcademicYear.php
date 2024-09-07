<?php

namespace App\Models;

use App\Models\Semester;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AcademicYear extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_date',
        'end_date'
    ];

    // RELATIONSHIPS
    public function semesters()
    {
        return $this->hasMany(Semester::class);
    }


    

}
