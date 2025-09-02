<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plant extends Model
{
    use HasFactory;

    // Allow these fields to be mass assigned
    protected $fillable = [
        'name',
        'watering_threshold',
    ];
}
