<?php

namespace App\Http\Controllers;

use App\Models\Destination;

class ExploreController extends Controller
{
    public function index()
    {
        $destinations = Destination::whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get(['id', 'name', 'location', 'latitude', 'longitude', 'category']);

        return view('explore', compact('destinations'));
    }
}