<x-app-layout>

    {{-- ============================================================
        SECTION 1: BREADCRUMB + HERO BANNER
    ============================================================ --}}
    <section class="relative bg-gradient-to-r from-primary to-primary-container py-10">
        <div class="max-w-7xl mx-auto px-6 md:px-12">
            <nav class="flex items-center gap-2 text-white/70 text-xs mb-3">
                <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
                <span class="material-symbols-outlined text-[14px]">chevron_right</span>
                <a href="{{ route('tourguides.index') }}" class="hover:text-white transition-colors">Tour Guide</a>
                <span class="material-symbols-outlined text-[14px]">chevron_right</span>
                <span class="text-white">{{ $tourguideProfile->user->name }}</span>
            </nav>
            <h1 class="font-display text-3xl font-bold text-white">Profil Pemandu</h1>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-6 md:px-12 py-xl space-y-xl">

        {{-- ============================================================
            SECTION 2: PROFILE HEADER CARD
        ============================================================ --}}
        <section class="bg-surface-container-lowest p-8 md:p-10 rounded-[18px] shadow-lg
                        flex flex-col md:flex-row gap-8 items-start">

            {{-- Avatar --}}
            <div class="relative shrink-0">
                <div class="w-[120px] h-[120px] rounded-full overflow-hidden border-4 border-surface-container shadow-md">
                    @if($tourguideProfile->photo)
                        <img src="{{ asset('storage/' . $tourguideProfile->photo) }}"
                            alt="Foto {{ $tourguideProfile->user->name }}"
                            class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-primary-container flex items-center justify-center">
                            <span class="material-symbols-outlined text-5xl text-on-primary-container">person</span>
                        </div>
                    @endif
                </div>
                @if($tourguideProfile->status === 'active')
                <div class="absolute bottom-1 right-1 bg-white rounded-full p-0.5 shadow">
                    <span class="material-symbols-outlined text-[#74C69D] text-2xl"
                        style="font-variation-settings:'FILL' 1,'wght' 400,'GRAD' 0,'opsz' 24">
                        verified
                    </span>
                </div>
                @endif
            </div>

            {{-- Info Utama --}}
            <div class="flex-1 space-y-4">

                {{-- Nama + Badge --}}
                <div class="flex flex-wrap items-center gap-3">
                    <h2 class="font-display text-h1 text-on-surface">{{ $tourguideProfile->user->name }}</h2>
                    @if($tourguideProfile->status === 'active')
                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full
                                bg-tertiary-fixed text-on-tertiary-fixed-variant text-label-md">
                        <span class="material-symbols-outlined text-[16px]"
                            style="font-variation-settings:'FILL' 1,'wght' 400,'GRAD' 0,'opsz' 24">
                            check_circle
                        </span>
                        Terverifikasi BearTrails
                    </span>
                    @endif
                </div>

                {{-- Lokasi --}}
                <div class="flex items-center gap-2 text-on-surface-variant">
                    <span class="material-symbols-outlined text-secondary text-[20px]">location_on</span>
                    <span class="text-label-md font-semibold">{{ $tourguideProfile->location }}</span>
                </div>

                {{-- Rating & Harga --}}
                <div class="flex flex-wrap items-center gap-4">
                    <div class="flex items-center gap-1">
                        <span class="material-symbols-outlined text-secondary text-[20px]"
                            style="font-variation-settings:'FILL' 1,'wght' 400,'GRAD' 0,'opsz' 24">
                            star
                        </span>
                        <span class="text-label-md font-bold text-on-surface">
                            {{ number_format($tourguideProfile->rating, 1) }}
                        </span>
                        <span class="text-caption text-outline">/ 5.0</span>
                    </div>
                    <div class="h-4 w-px bg-outline-variant"></div>
                    <div class="flex items-center gap-1">
                        <span class="material-symbols-outlined text-primary text-[20px]">payments</span>
                        <span class="text-label-md font-bold text-primary">
                            Rp {{ number_format($tourguideProfile->price_per_day, 0, ',', '.') }}
                        </span>
                        <span class="text-caption text-outline">/ hari</span>
                    </div>
                </div>

                {{-- Bio --}}
                @if($tourguideProfile->bio)
                <p class="text-body-md text-on-surface-variant leading-relaxed max-w-2xl">
                    {{ $tourguideProfile->bio }}
                </p>
                @endif
            </div>
        </section>

        {{-- ============================================================
            SECTION 3: TOMBOL KONTAK
        ============================================================ --}}
        <section class="space-y-3">
            <div class="flex flex-wrap gap-4">
                {{-- WhatsApp (dari nomor phone) --}}
                @if($tourguideProfile->phone)
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $tourguideProfile->phone) }}"
                    target="_blank" rel="noopener noreferrer"
                    class="flex items-center gap-2 px-6 py-3 bg-[#25D366] text-white rounded-xl
                        hover:opacity-90 active:scale-95 transition-all text-label-md shadow-sm">
                    <span class="material-symbols-outlined">forum</span>
                    WhatsApp
                </a>
                @endif

                {{-- Email --}}
                <a href="mailto:{{ $tourguideProfile->user->email }}"
                    class="flex items-center gap-2 px-6 py-3 bg-primary-container text-white rounded-xl
                        hover:opacity-90 active:scale-95 transition-all text-label-md shadow-sm">
                    <span class="material-symbols-outlined">mail</span>
                    Email
                </a>
            </div>
            <p class="text-caption text-outline">Hubungi langsung untuk diskusi &amp; pemesanan tour</p>
        </section>

        {{-- ============================================================
            SECTION 4: JADWAL KETERSEDIAAN
        ============================================================ --}}
        <section class="space-y-6">
            <h2 class="font-display text-h2 text-on-surface">Jadwal Ketersediaan</h2>

            @if($availabilities->isEmpty())
                <div class="flex flex-col items-center justify-center py-16 bg-surface-container-lowest
                            rounded-xl border border-outline-variant text-center gap-3">
                    <span class="material-symbols-outlined text-5xl text-outline">event_busy</span>
                    <p class="text-on-surface-variant">Belum ada jadwal tersedia saat ini.</p>
                </div>
            @else
                <div class="overflow-hidden rounded-xl border border-outline-variant shadow-sm">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-surface-container-high">
                            <tr>
                                <th class="px-6 py-4 text-label-md text-on-surface">Tanggal Tersedia</th>
                                <th class="px-6 py-4 text-label-md text-on-surface">Hari</th>
                                <th class="px-6 py-4 text-label-md text-on-surface">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-outline-variant">
                            @foreach($availabilities as $i => $availability)
                            <tr class="{{ $i % 2 === 0 ? 'bg-surface-container-lowest' : 'bg-surface-container-low/40' }}
                                        hover:bg-primary-fixed/20 transition-colors">
                                <td class="px-6 py-4 text-body-md font-medium text-on-surface">
                                    {{ \Carbon\Carbon::parse($availability->available_date)->translatedFormat('d F Y') }}
                                </td>
                                <td class="px-6 py-4 text-body-md text-on-surface-variant">
                                    {{ \Carbon\Carbon::parse($availability->available_date)->translatedFormat('l') }}
                                </td>
                                <td class="px-6 py-4">
                                    @if($availability->status === 'available')
                                        <span class="px-3 py-1 bg-tertiary-fixed text-on-tertiary-fixed-variant
                                                    rounded-full text-caption font-bold">
                                            Tersedia
                                        </span>
                                    @else
                                        <span class="px-3 py-1 bg-outline-variant text-on-surface-variant
                                                    rounded-full text-caption font-bold">
                                            Penuh
                                        </span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </section>

        {{-- ============================================================
            SECTION 5: PORTOFOLIO / CERITA
        ============================================================ --}}
        <section class="space-y-6">
            <h2 class="font-display text-h2 text-on-surface">Cerita &amp; Pengalaman</h2>

            @if($portfolios->isEmpty())
                <div class="flex flex-col items-center justify-center py-16 bg-surface-container-lowest
                            rounded-xl border border-outline-variant text-center gap-3">
                    <span class="material-symbols-outlined text-5xl text-outline">photo_library</span>
                    <p class="text-on-surface-variant">Belum ada portofolio yang ditambahkan.</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-3 gap-lg">
                    @foreach($portfolios as $portfolio)
                    <div class="bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm
                                border border-outline-variant/30 group
                                hover:-translate-y-2 hover:shadow-xl transition-all duration-300">

                        {{-- Gambar --}}
                        <div class="h-[180px] overflow-hidden relative">
                            @if($portfolio->image)
                                <img src="{{ asset('storage/' . $portfolio->image) }}"
                                    alt="{{ $portfolio->title ?? 'Portofolio' }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-full bg-surface-container flex items-center justify-center">
                                    <span class="material-symbols-outlined text-5xl text-outline">image</span>
                                </div>
                            @endif
                        </div>

                        {{-- Konten --}}
                        <div class="p-md space-y-2">
                            @if($portfolio->title)
                            <h3 class="font-bold text-h3 text-on-surface leading-tight">
                                {{ $portfolio->title }}
                            </h3>
                            @endif
                            @if($portfolio->description)
                            <p class="text-caption text-outline line-clamp-2">
                                {{ $portfolio->description }}
                            </p>
                            @endif
                            <div class="flex items-center gap-1 text-primary text-label-md pt-1">
                                <span class="material-symbols-outlined text-[16px]">location_on</span>
                                {{ $tourguideProfile->location }}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif
        </section>

    </div>{{-- end max-w-7xl --}}

</x-app-layout>