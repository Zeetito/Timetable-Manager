<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassGroupDivision extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_group_id',
        'division_number',
        'users_id',
    ];

    public function class_group()
    {
        return $this->belongsTo(ClassGroup::class);
    }

}
