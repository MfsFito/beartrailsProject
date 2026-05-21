<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\TourguideProfile;

class HomeController extends Controller
{
    public function index()
    {
        $destinations = Destination::latest()->take(8)->get();
        $tourguides = TourguideProfile::with('user')
            ->where('status', 'active')
            ->take(4)
            ->get();

        $stats = [
            'destinations' => Destination::count(),
            'tourguides'   => TourguideProfile::count(),
        ];

        return view('home', compact('destinations', 'tourguides', 'stats'));
    }
}