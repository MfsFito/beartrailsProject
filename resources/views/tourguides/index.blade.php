<x-app-layout>

    {{-- Hero Section --}}
    <section class="h-[300px] flex items-center justify-center relative overflow-hidden bg-gradient-to-br from-[#1B4332] to-[#2D6A4F]">
        <div class="absolute inset-0 opacity-20 pointer-events-none">
            <div class="w-full h-full bg-gradient-to-br from-primary to-primary-container"></div>
        </div>
        <div class="relative z-10 text-center px-6">
            <div class="inline-flex items-center gap-2 bg-[#D8F3DC]/20 border border-[#D8F3DC]/40 text-[#D8F3DC] px-4 py-1.5 rounded-full mb-6">
                <span class="material-symbols-outlined text-[18px]">check_circle</span>
                <span class="text-xs font-semibold uppercase tracking-wider">Semua tour guide telah diverifikasi tim BearTrails</span>
            </div>
            <h1 class="font-display text-4xl font-bold text-white mb-4">Tour Guide Terverifikasi</h1>
            <p class="text-white/90 text-lg max-w-2xl mx-auto">Hubungkan dirimu dengan pemandu wisata profesional dan berpengalaman di seluruh nusantara.</p>
        </div>
    </section>

    {{-- Filter Bar --}}
    <section class="sticky top-[72px] z-40 bg-[#FAFAF8] shadow-md py-4 px-6 md:px-12">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('tourguides.index') }}"
                    class="px-6 py-2 rounded-full {{ !request('lokasi') ? 'bg-primary-container text-white' : 'bg-white border border-outline-variant text-on-surface-variant hover:border-on-primary-container' }} font-semibold text-sm transition-all">
                    Semua
                </a>
                @foreach(['Lombok', 'Bali', 'Yogyakarta', 'Jakarta'] as $lokasi)
                <a href="{{ route('tourguides.index') }}?lokasi={{ $lokasi }}"
                    class="px-6 py-2 rounded-full {{ request('lokasi') === $lokasi ? 'bg-primary-container text-white' : 'bg-white border border-outline-variant text-on-surface-variant hover:border-on-primary-container' }} font-semibold text-sm transition-all">
                    {{ $lokasi }}
                </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Tour Guide Grid --}}
    <section class="max-w-7xl mx-auto px-6 md:px-12 py-xxl">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-lg">
            @forelse($tourguides as $tourguide)
            <div class="bg-surface rounded-xl p-md border border-outline-variant/30 transition-all duration-300 hover:-translate-y-1.5 hover:shadow-[0px_10px_20px_rgba(45,106,79,0.15)] group">
                <div class="flex items-start justify-between mb-4">
                    @if($tourguide->photo)
                        <img src="{{ asset('storage/'.$tourguide->photo) }}"
                            class="w-16 h-16 rounded-full object-cover border-2 border-on-primary-container/20"
                            alt="{{ $tourguide->user->name }}">
                    @else
                        <div class="w-16 h-16 rounded-full bg-surface-container flex items-center justify-center border-2 border-on-primary-container/20">
                            <span class="material-symbols-outlined text-3xl text-outline">person</span>
                        </div>
                    @endif
                    <span class="px-3 py-1 rounded-full text-xs font-semibold
                        {{ $tourguide->status === 'active'
                            ? 'bg-on-tertiary-container/10 text-on-tertiary-container'
                            : 'bg-outline-variant/30 text-on-surface-variant' }}">
                        {{ $tourguide->status === 'active' ? 'Tersedia' : 'Tidak Tersedia' }}
                    </span>
                </div>

                <h3 class="font-bold text-lg text-on-surface mb-1">{{ $tourguide->user->name }}</h3>
                <p class="text-on-surface-variant text-sm flex items-center gap-1 mb-4">
                    <span class="material-symbols-outlined text-[16px]">location_on</span>
                    {{ $tourguide->location }}
                </p>

                @if($tourguide->bio)
                <p class="text-on-surface-variant text-sm mb-4 line-clamp-2">{{ $tourguide->bio }}</p>
                @endif

                <div class="flex flex-wrap gap-2 mb-6">
                    <span class="px-2 py-0.5 rounded-md bg-surface-variant text-on-surface-variant text-[11px] font-semibold uppercase tracking-wider">
                        Rp {{ number_format($tourguide->price_per_day, 0, ',', '.') }}/hari
                    </span>
                    @if($tourguide->rating > 0)
                    <span class="px-2 py-0.5 rounded-md bg-surface-variant text-on-surface-variant text-[11px] font-semibold uppercase tracking-wider flex items-center gap-1">
                        <span class="material-symbols-outlined text-secondary text-[12px]">star</span>
                        {{ number_format($tourguide->rating, 1) }}
                    </span>
                    @endif
                </div>

                <a href="{{ route('tourguides.show', $tourguide) }}"
                    class="block w-full py-2.5 text-center border border-on-primary-container text-on-primary-container font-semibold text-sm rounded-lg group-hover:bg-on-primary-container group-hover:text-white transition-all">
                    Lihat Profil
                </a>
            </div>
            @empty
            <div class="col-span-3 text-center py-xxl">
                <span class="material-symbols-outlined text-6xl text-outline">person_search</span>
                <p class="text-on-surface-variant mt-md text-lg">Belum ada tour guide tersedia.</p>
            </div>
            @endforelse
        </div>
    </section>

</x-app-layout>