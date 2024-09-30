<?php

namespace App\Models;

use App\Models\User;
use App\Models\Program;
use App\Models\ClassGroup;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProgramStream extends Model
{
    use HasFactory;

    protected $fillable = [
        'program_id',
        'type',
        'duration',
        'graduate',
    ];

    // RELATIONSHIPS

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    // Get related class groups
    public function class_groups()
    {
        return $this->hasMany(ClassGroup::class);
    }

    // Get related Users
    public function users()
    {
        return User::whereBelongsTo($this->class_groups)->get();
    }


    // STATIC FUNCTIONS
    // Get regular stream


}
