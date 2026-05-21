<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Destination;
use App\Models\TourguideProfile;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_destinations' => Destination::count(),
            'total_users'        => User::where('role', 'user')->count(),
            'total_tourguides'   => TourguideProfile::where('status', 'active')->count(),
            'total_reviews'      => Review::count(),
        ];

        $destinations  = Destination::latest()->take(8)->get();
        $tourguides    = TourguideProfile::with('user')->latest()->take(6)->get();
        $recentReviews = Review::with(['user', 'destination'])->latest()->take(6)->get();

        return view('admin.dashboard', compact('stats', 'destinations', 'tourguides', 'recentReviews'));
    }

    public function users()
    {
        $users = User::where('role', 'user')->latest()->get();
        return view('admin.users', compact('users'));
    }

    public function destroyUser(User $user)
    {
        if ($user->role === 'admin') {
            return redirect()->back()->with('error', 'Tidak bisa hapus akun admin!');
        }
        $user->delete();
        return redirect()->back()->with('success', 'Akun user berhasil dihapus.');
    }

    public function storeTourguide(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:users,email',
            'password'      => 'required|min:8',
            'location'      => 'required|string',
            'price_per_day' => 'required|numeric|min:0',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'tourguide',
        ]);

        TourguideProfile::create([
            'user_id'       => $user->id,
            'location'      => $request->location,
            'price_per_day' => $request->price_per_day,
            'status'        => 'active',
            'rating'        => 0,
        ]);

        return redirect()->back()->with('success', 'Akun Tour Guide berhasil dibuat!');
    }

    public function toggleTourguide(User $user)
    {
        $profile = $user->tourguideProfile;
        if (!$profile) {
            return redirect()->back()->with('error', 'Profil tour guide tidak ditemukan.');
        }

        $profile->status = $profile->status === 'active' ? 'inactive' : 'active';
        $profile->save();

        $status = $profile->status === 'active' ? 'diaktifkan' : 'dinonaktifkan';
        return redirect()->back()->with('success', "Tour Guide berhasil {$status}.");
    }

    public function destroyTourguide(User $user)
    {
        $user->delete();
        return redirect()->back()->with('success', 'Akun Tour Guide berhasil dihapus.');
    }
}