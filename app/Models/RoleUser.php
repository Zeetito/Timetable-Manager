<?php

namespace App\Models;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoleUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'role_id',
        'subjectable_id',
        'subjectable_type',
    ];

    // RELATIONSHIPS
    
    // User
    public function user(){
        return $this->belongsTo(User::class);
    }

    // Role
    public function role(){
        return $this->belongsTo(Role::class);
    }

    // Get the subject
    public function subjectable()
    {
        return $this->morphTo();
    }
}
