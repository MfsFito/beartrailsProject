<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourguideAvailability extends Model
{
    use HasFactory;

    protected $fillable = [
        'tourguide_profile_id',
        'available_date',
        'status',
    ];

    public function tourguideProfile()
    {
        return $this->belongsTo(TourguideProfile::class);
    }
}