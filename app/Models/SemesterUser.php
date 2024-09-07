<?php

namespace App\Models;

use App\Models\Semester;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SemesterUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'semester_id',
    ];

    // RELATIONSHIPS

    // User
    public function user(){
        return $this->belongsTo(User::class);
    }

    // Semester
    public function semester(){
        return $this->belongsTo(Semester::class);
    }
}
