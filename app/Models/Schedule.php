<?php

namespace App\Models;

use App\Models\Room;
use App\Models\Semester;
use App\Models\Scopes\SemesterScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;

#[ScopedBy([SemesterScope::class])]
class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'scheduleable_id',
        'scheduleable_type',
        'start_time',
        'end_time',
        'duration',
        'room_id',
        'date',
        'semester_id',
    ];
    /**
     * Get the schedulable entity that the Schedule belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Relations\MorphTo
     */

    public function schedulable()
    {
        return $this->morphTo();
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

}
