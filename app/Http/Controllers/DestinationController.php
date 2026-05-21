<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    // Tampilkan semua destinasi
    public function index(Request $request)
    {
        $query = Destination::query();

        // Filter kategori
        if ($request->kategori) {
            $query->where('category', $request->kategori);
        }

        // Search
        if ($request->q) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%'.$request->q.'%')
                ->orWhere('location', 'like', '%'.$request->q.'%')
                ->orWhere('description', 'like', '%'.$request->q.'%');
            });
        }

        $destinations = $query->paginate(12);

        return view('destinations.index', compact('destinations'));
    }

    // Tampilkan detail satu destinasi
    public function show(Destination $destination)
    {
        $reviews = $destination->reviews()->with('user')->latest()->get();
        $destination->load('images'); // ← tambah ini
        return view('destinations.show', compact('destination', 'reviews'));
    }

    // Form tambah destinasi (admin)
    public function create()
    {
        return view('destinations.create');
    }

    // Simpan destinasi baru (admin)
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required',
            'location'    => 'required',
            'category'    => 'required',
            'entry_fee'   => 'required|numeric',
            'image'       => 'nullable|image|max:2048',
            'images.*'    => 'nullable|image|max:2048',
        ]);

        $data = $request->except(['image', 'images', '_token']);

        // Foto utama
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('destinations', 'public');
        }

        $destination = Destination::create($data);

        // Foto tambahan
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $img) {
                $path = $img->store('destinations', 'public');
                \App\Models\DestinationImage::create([
                    'destination_id' => $destination->id,
                    'image'          => $path,
                    'order'          => $index,
                ]);
            }
        }

        return redirect()->route('admin.dashboard')->with('success', 'Destinasi berhasil ditambahkan!');
    }

    // Hapus destinasi (admin)
    public function destroy(Destination $destination)
    {
        $destination->delete();
        return redirect()->route('destinations.index')->with('success', 'Destinasi berhasil dihapus!');
    }
    
    // Form edit destinasi (admin)
    public function edit(Destination $destination)
    {
        $destination->load('images');
        return view('destinations.edit', compact('destination'));
    }

    // Update destinasi (admin)
    public function update(Request $request, Destination $destination)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required',
            'location'    => 'required',
            'category'    => 'required',
            'entry_fee'   => 'required|numeric',
            'image'       => 'nullable|image|max:2048',
            'images.*'    => 'nullable|image|max:2048',
        ]);

        $data = $request->except(['image', 'images', '_token', '_method']);

        // Update foto utama
        if ($request->hasFile('image')) {
            if ($destination->image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($destination->image);
            }
            $data['image'] = $request->file('image')->store('destinations', 'public');
        }

        $destination->update($data);

        // Tambah foto galeri baru
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $img) {
                $path = $img->store('destinations', 'public');
                \App\Models\DestinationImage::create([
                    'destination_id' => $destination->id,
                    'image'          => $path,
                    'order'          => $destination->images()->count() + $index,
                ]);
            }
        }

        return redirect()->route('admin.dashboard')->with('success', 'Destinasi berhasil diupdate!');
    }

    // Hapus foto galeri
    public function destroyImage(Destination $destination, \App\Models\DestinationImage $image)
    {
        \Illuminate\Support\Facades\Storage::disk('public')->delete($image->image);
        $image->delete();
        return redirect()->back()->with('success', 'Foto berhasil dihapus.');
    }
}