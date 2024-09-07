<?php

namespace App\Models;

use App\Models\User;
use App\Models\Program;
use App\Models\ClassGroupDivision;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClassGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'program_id',
        'year',
        'is_divided',
        'start_year',
        'end_year',
    ];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function divisions()
    {
        return $this->hasMany(ClassGroupDivision::class);
    }

}
