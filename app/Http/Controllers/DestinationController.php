<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function index(Request $request)
    {
        $query = Destination::query();
        // filter kategori & search sederhana
        $destinations = $query->paginate(12);
        return view('destinations.index', compact('destinations'));
    }

    public function show(Destination $destination)
    {
        return view('destinations.show', compact('destination'));
    }
}