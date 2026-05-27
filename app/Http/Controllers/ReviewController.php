<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Destination;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    // Simpan review baru
    public function store(Request $request, Destination $destination)
    {
        $request->validate([
            'rating'  => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        Review::create([
            'user_id'        => auth()->id(),
            'destination_id' => $destination->id,
            'rating'         => $request->rating,
            'comment'        => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Review berhasil ditambahkan!');
    }

    // Hapus review
    public function destroy(Review $review)
    {
        // Hanya pemilik review yang boleh hapus
        if ($review->user_id !== auth()->id()) {
            abort(403);
        }

        $review->delete();
        return redirect()->back()->with('success', 'Review berhasil dihapus!');
    }
}