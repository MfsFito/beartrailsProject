<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Destinasi Baru
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow p-6">

                @if($errors->any())
                    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>• {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('destinations.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Nama Destinasi</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                               class="mt-1 block w-full border rounded px-3 py-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea name="description" rows="4"
                                  class="mt-1 block w-full border rounded px-3 py-2" required>{{ old('description') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Lokasi</label>
                        <input type="text" name="location" value="{{ old('location') }}"
                               class="mt-1 block w-full border rounded px-3 py-2" required>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Latitude</label>
                            <input type="text" name="latitude" value="{{ old('latitude') }}"
                                   class="mt-1 block w-full border rounded px-3 py-2">
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Longitude</label>
                            <input type="text" name="longitude" value="{{ old('longitude') }}"
                                   class="mt-1 block w-full border rounded px-3 py-2">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Kategori</label>
                        <select name="category" class="mt-1 block w-full border rounded px-3 py-2" required>
                            <option value="">-- Pilih Kategori --</option>
                            <option value="Pantai">Pantai</option>
                            <option value="Gunung">Gunung</option>
                            <option value="Budaya">Budaya</option>
                            <option value="Alam">Alam</option>
                            <option value="Kuliner">Kuliner</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Harga Tiket (Rp)</label>
                        <input type="number" name="entry_fee" value="{{ old('entry_fee') }}"
                               class="mt-1 block w-full border rounded px-3 py-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Foto Utama</label>
                        <input type="file" name="image" accept="image/*"
                            class="mt-1 block w-full border rounded px-3 py-2">
                        <p class="text-xs text-gray-500 mt-1">Foto yang tampil sebagai cover destinasi</p>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Foto Tambahan (Galeri)</label>
                        <input type="file" name="images[]" accept="image/*" multiple
                            class="mt-1 block w-full border rounded px-3 py-2">
                        <p class="text-xs text-gray-500 mt-1">Bisa pilih beberapa foto sekaligus</p>
                    </div>

                    <div class="flex gap-3">
                        <button type="submit"
                                style="background-color: #7c3aed; color: white; font-weight: 600; padding: 8px 24px; border-radius: 6px;">
                            Simpan
                        </button>
                        <a href="{{ route('admin.dashboard') }}"
                        style="background-color: #6b7280; color: white; font-weight: 600; padding: 8px 24px; border-radius: 6px;">
                            Batal
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>