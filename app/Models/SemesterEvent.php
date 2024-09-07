<?php

namespace App\Models;

use App\Models\Semester;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SemesterEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'contact_info',
        'is_active',
        'semester_id',
    ];


    // RELATIONSHIPS

    // Related Semester
    public function semester(){
        return $this->belongsTo(Semester::class);
    }



}
