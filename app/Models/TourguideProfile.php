<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TourguideProfile extends Model
{
    protected $fillable = [
        'user_id',
        'phone',
        'bio',
        'photo',
        'location',
        'price_per_day',
        'status',
        'rating',
    ];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke availabilities
    public function availabilities()
    {
        return $this->hasMany(TourguideAvailability::class);
    }

    // Relasi ke portfolios
    public function portfolios()
    {
        return $this->hasMany(TourguidePortfolio::class);
    }
}