<?php

namespace App\Http\Controllers;

use App\Models\TourguideProfile;
use App\Models\TourguideAvailability;
use App\Models\TourguidePortfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TourguideProfileController extends Controller
{
    // PUBLIC: Daftar Tour Guide
    public function index(Request $request)
    {
        $query = TourguideProfile::with('user')->where('status', 'active');

        if ($request->lokasi) {
            $query->where('location', 'like', '%'.$request->lokasi.'%');
        }

        $tourguides = $query->get();

        return view('tourguides.index', compact('tourguides'));
    }

    // PUBLIC: Detail Tour Guide
    public function show(TourguideProfile $tourguideProfile)
    {
        $availabilities = $tourguideProfile->availabilities()
            ->where('status', 'available')
            ->orderBy('available_date')
            ->get();

        $portfolios = $tourguideProfile->portfolios()->latest()->get();

        return view('tourguides.show', compact('tourguideProfile', 'availabilities', 'portfolios'));
    }

    // TOURGUIDE: Dashboard
    public function dashboard()
    {
        $profile = auth()->user()->tourguideProfile;

        if (!$profile) {
            return view('tourguide.dashboard', ['profile' => null]);
        }

        $availabilities = $profile->availabilities()->orderBy('available_date')->get();
        $portfolios     = $profile->portfolios()->latest()->get();

        $stats = [
            'jadwal_aktif'    => $availabilities->where('status', 'available')->count(),
            'post_portofolio' => $portfolios->count(),
        ];

        return view('tourguide.dashboard', compact('profile', 'availabilities', 'portfolios', 'stats'));
    }

    // TOURGUIDE: Edit Profil
    public function edit()
    {
        $profile = auth()->user()->tourguideProfile;
        return view('tourguide.profile', compact('profile'));
    }

    // TOURGUIDE: Update Profil
    public function update(Request $request)
    {
        $request->validate([
            'phone'         => 'nullable|string',
            'bio'           => 'nullable|string',
            'location'      => 'required|string',
            'price_per_day' => 'required|numeric|min:0',
            'photo'         => 'nullable|image|max:2048',
        ]);

        $profile = auth()->user()->tourguideProfile;
        $data = $request->except(['photo', '_token']);

        if ($request->hasFile('photo')) {
            if ($profile && $profile->photo) {
                Storage::disk('public')->delete($profile->photo);
            }
            $data['photo'] = $request->file('photo')->store('tourguides', 'public');
        }

        if (!$profile) {
            $data['user_id'] = auth()->id();
            $data['status']  = 'active';
            $data['rating']  = 0;
            TourguideProfile::create($data);
        } else {
            $profile->update($data);
        }

        return redirect()->back()->with('success', 'Profil berhasil diupdate!');
    }
}