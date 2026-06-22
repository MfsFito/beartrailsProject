<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Destinasi: {{ $destination->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow p-6">

                @if($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-xl">
                    @foreach($errors->all() as $error)
                    <p class="text-sm">• {{ $error }}</p>
                    @endforeach
                </div>
                @endif

                <form action="{{ route('destinations.update', $destination) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Nama --}}
                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700">Nama Destinasi</label>
                        <input type="text" name="name" value="{{ old('name', $destination->name) }}"
                               class="mt-1 block w-full border rounded-xl px-3 py-2 text-sm" required>
                    </div>

                    {{-- Deskripsi --}}
                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700">Deskripsi</label>
                        <textarea name="description" rows="4"
                                  class="mt-1 block w-full border rounded-xl px-3 py-2 text-sm" required>{{ old('description', $destination->description) }}</textarea>
                    </div>

                    {{-- Lokasi --}}
                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700">Lokasi</label>
                        <input type="text" name="location" value="{{ old('location', $destination->location) }}"
                               class="mt-1 block w-full border rounded-xl px-3 py-2 text-sm" required>
                    </div>

                    {{-- Koordinat --}}
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700">Latitude</label>
                            <input type="text" name="latitude" value="{{ old('latitude', $destination->latitude) }}"
                                   class="mt-1 block w-full border rounded-xl px-3 py-2 text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700">Longitude</label>
                            <input type="text" name="longitude" value="{{ old('longitude', $destination->longitude) }}"
                                   class="mt-1 block w-full border rounded-xl px-3 py-2 text-sm">
                        </div>
                    </div>

                    {{-- Kategori --}}
                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700">Kategori</label>
                        <select name="category" class="mt-1 block w-full border rounded-xl px-3 py-2 text-sm" required>
                            @foreach(['Pantai', 'Gunung', 'Budaya', 'Kuliner', 'Alam'] as $kat)
                            <option value="{{ $kat }}" {{ $destination->category === $kat ? 'selected' : '' }}>{{ $kat }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Harga --}}
                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700">Harga Tiket (Rp)</label>
                        <input type="number" name="entry_fee" value="{{ old('entry_fee', $destination->entry_fee) }}"
                               class="mt-1 block w-full border rounded-xl px-3 py-2 text-sm" required>
                    </div>

                    {{-- Foto Utama --}}
                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700">Foto Utama</label>
                        @if($destination->image)
                        <div class="mt-2 mb-3">
                            <img src="{{ asset('storage/'.$destination->image) }}" class="w-32 h-24 object-cover rounded-xl">
                            <p class="text-xs text-gray-500 mt-1">Foto saat ini</p>
                        </div>
                        @endif
                        <input type="file" name="image" accept="image/*"
                               class="mt-1 block w-full border rounded-xl px-3 py-2 text-sm">
                        <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah foto utama</p>
                    </div>

                    {{-- Foto Galeri --}}
                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Foto Galeri</label>

                        {{-- Foto yang sudah ada --}}
                        @if($destination->images->count() > 0)
                        <div class="grid grid-cols-4 gap-3 mb-3">
                            @foreach($destination->images as $img)
                            <div class="relative group">
                                <img src="{{ asset('storage/'.$img->image) }}"
                                    class="w-full h-24 object-cover rounded-xl">
                                <button type="button"
                                        onclick="hapusFoto('{{ route('destinations.images.destroy', [$destination, $img]) }}')"
                                        class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs hover:bg-red-600 transition-all opacity-0 group-hover:opacity-100">
                                    ✕
                                </button>
                            </div>
                            @endforeach
                        </div>
                        @endif

                        <input type="file" name="images[]" accept="image/*" multiple
                               class="mt-1 block w-full border rounded-xl px-3 py-2 text-sm">
                        <p class="text-xs text-gray-500 mt-1">Tambah foto galeri baru (bisa pilih beberapa)</p>
                    </div>

                    {{-- Tombol --}}
                    <div class="flex gap-3">
                        <button type="submit"
                                style="background-color: #7c3aed; color: white; font-weight: 600; padding: 10px 24px; border-radius: 10px;">
                            Simpan Perubahan
                        </button>
                        <a href="{{ route('admin.dashboard') }}"
                           class="px-6 py-2.5 border border-gray-300 text-gray-600 rounded-xl text-sm font-semibold hover:bg-gray-50 transition-all">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('scripts')
    <script>
    function hapusFoto(url) {
        if (!confirm('Hapus foto ini?')) return;

        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'X-HTTP-Method-Override': 'DELETE'
            },
        }).then(response => {
            if (response.ok) {
                window.location.reload();
            } else {
                alert('Gagal menghapus foto!');
            }
        }).catch(() => {
            alert('Terjadi kesalahan!');
        });
    }
    </script>
    @endpush
</x-app-layout>