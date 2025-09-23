<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property \App\Models\Room $room
 */
class Plant extends Model
{
    use HasFactory;

    // Allow these fields to be mass assigned
    protected $fillable = [
        'name',
        'watering_threshold',
        'room_id',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
    public function measurements()
    {
        return $this->hasMany(Measurements::class);
    }
}
