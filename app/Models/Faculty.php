<?php

namespace App\Models;

use App\Models\College;
use App\Models\Program;
use App\Models\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Faculty extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'college_id',
        'location',
    ];

    // RELATIONSHIPS
    public function college()
    {
        return $this->belongsTo(College::class);
    }

    public function departments()
    {
        return $this->hasMany(Department::class);
    }

    public function programs()
    {
        return $this->hasMany(Program::class);
    }
    
}
