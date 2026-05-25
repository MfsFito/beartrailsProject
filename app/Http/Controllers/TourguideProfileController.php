<?php

namespace App\Http\Controllers;

use App\Models\TourguideProfile;
use App\Models\TourguideAvailability;
use App\Models\TourguidePortfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TourguideProfileController extends Controller
{
    // ─── PUBLIC: Tampilkan semua tour guide ───────────────────────────────────
    public function index(Request $request)
    {
        $query = TourguideProfile::with('user')->where('status', 'active');

        if ($request->lokasi) {
            $query->where('location', 'like', '%'.$request->lokasi.'%');
        }

        $tourguides = $query->get();

        return view('tourguides.index', compact('tourguides'));
    }

    // ─── PUBLIC: Tampilkan detail tour guide ──────────────────────────────────
    public function show(TourguideProfile $tourguideProfile)
    {
        $availabilities = $tourguideProfile->availabilities()
            ->where('status', 'available')
            ->orderBy('available_date')
            ->get();

        $portfolios = $tourguideProfile->portfolios()->get();

        return view('tourguides.show', compact('tourguideProfile', 'availabilities', 'portfolios'));
    }

    // ─── TOURGUIDE: Dashboard ─────────────────────────────────────────────────
    public function dashboard()
    {
        $profile = auth()->user()->tourguideProfile;

        if (!$profile) {
            return view('tourguide.dashboard', ['profile' => null]);
        }

        $availabilities = $profile->availabilities()->orderBy('available_date')->get();
        $portfolios     = $profile->portfolios()->latest()->get();

        $stats = [
            'jadwal_aktif'   => $availabilities->where('status', 'available')->count(),
            'post_portofolio' => $portfolios->count(),
        ];

        return view('tourguide.dashboard', compact('profile', 'availabilities', 'portfolios', 'stats'));
    }

    // ─── TOURGUIDE: Form edit profil ──────────────────────────────────────────
    public function edit()
    {
        $profile = auth()->user()->tourguideProfile;
        return view('tourguide.profile', compact('profile'));
    }

    // ─── TOURGUIDE: Update profil ─────────────────────────────────────────────
    public function update(Request $request)
    {
        $request->validate([
            'phone'         => 'nullable|string',
            'bio'           => 'nullable|string',
            'location'      => 'required|string',
            'price_per_day' => 'required|numeric',
            'photo'         => 'nullable|image|max:2048',
        ]);

        $profile = auth()->user()->tourguideProfile;
        $data = $request->except(['photo', '_token']);

        // Handle upload foto
        if ($request->hasFile('photo')) {
            // Hapus foto lama
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

    // ─── TOURGUIDE: Tambah Availability ──────────────────────────────────────
    public function storeAvailability(Request $request)
    {
        $request->validate([
            'available_date' => 'required|date|after_or_equal:today',
        ]);

        $profile = auth()->user()->tourguideProfile;

        // Cek duplikat
        $exists = $profile->availabilities()
            ->where('available_date', $request->available_date)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'Tanggal tersebut sudah ada dalam jadwal.');
        }

        TourguideAvailability::create([
            'tourguide_profile_id' => $profile->id,
            'available_date'       => $request->available_date,
            'status'               => 'available',
        ]);

        return redirect()->back()->with('success', 'Jadwal berhasil ditambahkan!');
    }

    // ─── TOURGUIDE: Hapus Availability ───────────────────────────────────────
    public function destroyAvailability(TourguideAvailability $availability)
    {
        // Pastikan milik tourguide yang login
        $profile = auth()->user()->tourguideProfile;
        if ($availability->tourguide_profile_id !== $profile->id) {
            abort(403);
        }

        $availability->delete();
        return redirect()->back()->with('success', 'Jadwal berhasil dihapus.');
    }

    // ─── TOURGUIDE: Tambah Portfolio ──────────────────────────────────────────
    public function storePortfolio(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:200',
            'images.*'    => 'required|image|max:2048',
            'description' => 'nullable|string',
        ]);

        $profile = auth()->user()->tourguideProfile;

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('portfolios', 'public');
                TourguidePortfolio::create([
                    'tourguide_profile_id' => $profile->id,
                    'title'       => $request->title,
                    'image'       => $path,
                    'description' => $request->description,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Portofolio berhasil diupload!');
    }

    // ─── TOURGUIDE: Hapus Portfolio ───────────────────────────────────────────
    public function destroyPortfolio(TourguidePortfolio $portfolio)
    {
        $profile = auth()->user()->tourguideProfile;
        if ($portfolio->tourguide_profile_id !== $profile->id) {
            abort(403);
        }

        // Hapus file gambar dari storage
        if ($portfolio->image) {
            Storage::disk('public')->delete($portfolio->image);
        }

        $portfolio->delete();
        return redirect()->back()->with('success', 'Portofolio berhasil dihapus.');
    }
}