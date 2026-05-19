<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourguideProfile extends Model
{
    use HasFactory;

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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}