<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Destinasi Favorit Saya
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse($favorites as $favorite)
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        @if($favorite->destination->image)
                            <img src="{{ asset('storage/'.$favorite->destination->image) }}"
                                 class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                <span class="text-gray-400">No Image</span>
                            </div>
                        @endif

                        <div class="p-4">
                            <h3 class="font-bold text-lg">{{ $favorite->destination->name }}</h3>
                            <p class="text-gray-500 text-sm">📍 {{ $favorite->destination->location }}</p>
                            <p class="text-green-600 font-semibold mt-2">
                                Rp {{ number_format($favorite->destination->entry_fee, 0, ',', '.') }}
                            </p>

                            <div class="flex gap-2 mt-3">
                                <a href="{{ route('destinations.show', $favorite->destination) }}"
                                   class="flex-1 text-center bg-blue-500 text-white py-2 rounded hover:bg-blue-600">
                                    Lihat Detail
                                </a>
                                <form action="{{ route('favorites.toggle', $favorite->destination) }}" method="POST">
                                    @csrf
                                    <button class="bg-red-500 text-white px-3 py-2 rounded hover:bg-red-600">
                                        🗑️
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12">
                        <p class="text-gray-500 text-lg">Belum ada destinasi favorit.</p>
                        <a href="{{ route('destinations.index') }}"
                           class="mt-4 inline-block bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">
                            Jelajahi Destinasi
                        </a>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>