<x-app-layout>

    {{-- Header Banner --}}
    <section class="relative h-[300px] w-full overflow-hidden flex items-center bg-gradient-to-br from-[#1B4332] to-[#2D6A4F]">
        <div class="absolute inset-0 opacity-20 pointer-events-none">
            <div class="w-full h-full bg-gradient-to-br from-primary to-primary-container"></div>
        </div>
        <div class="relative max-w-7xl mx-auto px-6 md:px-12 z-10 w-full">
            <nav class="flex items-center gap-2 text-white/70 text-xs mb-4">
                <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
                <span class="material-symbols-outlined text-[14px]">chevron_right</span>
                <span class="text-white">Destinasi</span>
            </nav>
            <h1 class="font-display text-5xl font-bold text-white max-w-2xl leading-tight">Jelajahi Destinasi Wisata</h1>
        </div>
    </section>

    {{-- Filter Bar --}}
    <div class="sticky top-[72px] z-40 bg-white shadow-md py-4">
        <div class="max-w-7xl mx-auto px-6 md:px-12 space-y-4">

            {{-- Filter Kategori --}}
            <div class="flex items-center gap-3 overflow-x-auto pb-2">
                <a href="{{ route('destinations.index') }}"
                   class="whitespace-nowrap px-6 py-2 {{ !request('kategori') ? 'bg-primary text-white' : 'bg-surface-container-high text-on-surface hover:bg-surface-variant' }} rounded-full text-sm font-semibold shadow-sm transition-colors">
                   Semua
                </a>
                @foreach(['Pantai' => '🏖', 'Gunung' => '⛰', 'Budaya' => '🏛', 'Kuliner' => '🍜', 'Alam' => '🌿'] as $kat => $emoji)
                <a href="{{ route('destinations.index') }}?kategori={{ $kat }}"
                   class="whitespace-nowrap px-6 py-2 {{ request('kategori') === $kat ? 'bg-primary text-white' : 'bg-surface-container-high text-on-surface hover:bg-surface-variant' }} rounded-full text-sm font-semibold transition-colors">
                   {{ $emoji }} {{ $kat }}
                </a>
                @endforeach
            </div>

            {{-- Search & Lokasi --}}
            <form method="GET" action="{{ route('destinations.index') }}" class="flex flex-col md:flex-row gap-4">
                @if(request('kategori'))
                    <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                @endif
                <div class="relative flex-1 group">
                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline group-focus-within:text-primary">search</span>
                    <input name="q" value="{{ request('q') }}"
                           class="w-full pl-12 pr-4 py-3 bg-surface-container-low border border-transparent focus:border-on-primary-container focus:ring-0 rounded-xl text-sm transition-all outline-none"
                           placeholder="Cari destinasi impianmu..."/>
                </div>
                <button type="submit" class="px-6 py-3 bg-primary text-white rounded-xl text-sm font-semibold hover:opacity-90 transition-all">
                    Cari
                </button>
            </form>
        </div>
    </div>

    {{-- Grid Destinasi --}}
    <section class="max-w-7xl mx-auto px-6 md:px-12 py-xl">

        @if(request('q') || request('kategori'))
        <p class="text-on-surface-variant text-sm mb-lg">
            Menampilkan {{ $destinations->count() }} hasil
            @if(request('q')) untuk "<strong>{{ request('q') }}</strong>" @endif
            @if(request('kategori')) kategori <strong>{{ request('kategori') }}</strong> @endif
        </p>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-lg">
            @forelse($destinations as $destination)
            <a href="{{ route('destinations.show', $destination) }}"
               class="bg-surface-container-lowest rounded-xl overflow-hidden transition-all duration-300 cursor-pointer block group"
               style="transition: transform 0.3s, box-shadow 0.3s;"
               onmouseover="this.style.transform='translateY(-5px)';this.style.boxShadow='0px 10px 20px rgba(45,106,79,0.15)'"
               onmouseout="this.style.transform='';this.style.boxShadow=''">
                <div class="relative h-[180px] w-full">
                    @if($destination->image)
                        <img src="{{ asset('storage/'.$destination->image) }}"
                             class="w-full h-full object-cover" alt="{{ $destination->name }}">
                    @else
                        <div class="w-full h-full bg-surface-container flex items-center justify-center">
                            <span class="material-symbols-outlined text-5xl text-outline">landscape</span>
                        </div>
                    @endif
                    <span class="absolute top-3 left-3 bg-secondary-container text-on-secondary-container px-3 py-1 rounded-full text-xs font-semibold shadow-sm">
                        {{ $destination->category }}
                    </span>
                    @auth
                    @php
                        $isFavorited = auth()->check() && $destination->favorites->contains('user_id', auth()->id());
                    @endphp
                    <form action="{{ route('favorites.toggle', $destination) }}" method="POST"
                        onclick="event.stopPropagation()" class="absolute top-3 right-3">
                        @csrf
                        <button type="submit" class="w-[34px] h-[34px] bg-white/90 hover:bg-white rounded-full flex items-center justify-center transition-transform active:scale-90 shadow-md {{ $isFavorited ? 'text-error' : 'text-on-surface-variant hover:text-error' }}">
                            <span class="material-symbols-outlined text-[20px]"
                                style="font-variation-settings: 'FILL' {{ $isFavorited ? 1 : 0 }};">
                                favorite
                            </span>
                        </button>
                    </form>
                    @endauth
                </div>
                <div class="p-md space-y-2">
                    <h3 class="font-bold text-lg text-primary truncate">{{ $destination->name }}</h3>
                    <div class="flex items-center gap-1 text-on-surface-variant text-xs">
                        <span class="material-symbols-outlined text-[16px]">location_on</span>
                        <span>{{ $destination->location }}</span>
                    </div>
                    <div class="flex justify-between items-center pt-2">
                        <div class="flex items-center gap-1">
                            <span class="material-symbols-outlined text-secondary text-[18px]">star</span>
                            <span class="text-sm font-semibold text-on-surface">
                                {{ number_format($destination->averageRating() ?? 0, 1) }}
                            </span>
                        </div>
                        <span class="text-primary font-bold text-sm">
                            @if($destination->entry_fee == 0)
                                Gratis
                            @else
                                Rp {{ number_format($destination->entry_fee / 1000, 0) }}k
                            @endif
                        </span>
                    </div>
                </div>
            </a>
            @empty
            <div class="col-span-4 text-center py-xxl">
                <span class="material-symbols-outlined text-6xl text-outline">search_off</span>
                <p class="text-on-surface-variant mt-md text-lg">Destinasi tidak ditemukan.</p>
                <a href="{{ route('destinations.index') }}" class="mt-md inline-block text-primary font-semibold hover:underline">
                    Lihat semua destinasi
                </a>
            </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($destinations->hasPages())
        <div class="mt-xxl flex justify-center">
            {{ $destinations->links() }}
        </div>
        @endif

    </section>

</x-app-layout>