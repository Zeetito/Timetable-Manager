<?php

namespace App\Models;

use App\Models\Faculty;
use App\Models\Program;
use App\Models\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class College extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
    ];

    // RELATIONSHIPS

    public function departments()
    {
        return $this->hasMany(Department::class);
    }

    public function factulies()
    {
        return $this->hasMany(Faculty::class);
    }

    public function programs()
    {
        return $this->hasMany(Program::class);
    }

    

}
