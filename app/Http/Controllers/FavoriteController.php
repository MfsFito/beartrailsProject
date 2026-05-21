<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Destination;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function toggle(Destination $destination)
    {
        $existing = Favorite::where('user_id', auth()->id())
                            ->where('destination_id', $destination->id)
                            ->first();

        if ($existing) {
            $existing->delete();
            $message = 'Destinasi dihapus dari favorit!';
        } else {
            Favorite::create([
                'user_id'        => auth()->id(),
                'destination_id' => $destination->id,
            ]);
            $message = 'Destinasi ditambahkan ke favorit!';
        }

        return redirect()->back()->with('success', $message);
    }

    public function index()
    {
        $favorites = Favorite::where('user_id', auth()->id())
                             ->with('destination')
                             ->latest()
                             ->get();

        return view('favorites.index', compact('favorites'));
    }
}