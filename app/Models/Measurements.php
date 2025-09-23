<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property \App\Models\Plant $plant
 */
class Measurements extends Model
{
    use HasFactory;

    protected $fillable = [
        'plant_id',
        'humidity',
        'temperature',
        'light',
        'water',
    ];

    public function plant()
    {
        return $this->belongsTo(Plant::class);
    }
}
