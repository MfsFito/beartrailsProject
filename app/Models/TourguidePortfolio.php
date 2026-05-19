<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourguidePortfolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'tourguide_profile_id',
        'image',
        'title',
        'description',
    ];

    public function tourguideProfile()
    {
        return $this->belongsTo(TourguideProfile::class);
    }
}