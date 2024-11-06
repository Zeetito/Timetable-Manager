<?php

namespace App\Models;

use App\Models\User;
use App\Models\Program;
use App\Models\ClassGroup;
use App\Models\ProgramStream;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProgramStream extends Model
{
    use HasFactory;

    protected $fillable = [
        'program_id',
        'type',
        'duration',
        'graduate_type',
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

    // PUBLIC STATIC FUNCTOINS
    // Get all postGraduate Streams
    public static function pg_streams(){
        return ProgramStream::whereBelongsTo(Program::pg())->get();
    }

    // Get all undergraduate Streams
    public static function ug_streams(){
        return ProgramStream::whereBelongsTo(Program::ug())->get();
    }

}
