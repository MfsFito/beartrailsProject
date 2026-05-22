<x-app-layout>
    {{-- Hero Section --}}
    <section class="relative min-h-[600px] flex flex-col items-center justify-center text-center px-6 py-xxl bg-gradient-to-br from-primary to-primary-container">
        <div class="absolute inset-0 opacity-20" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDJob1e0m0AMaiCHrEnQfj3cWCNCaOf_Tp-psl1Dcwth5UD_fU6nOd_Vd2uyvBDej3lR0XDvodvZRA0PzZroOBzzvrRl3VDswlOrXepnJVkQCDVP5sJpvWd9RwwkJB-Iex4x2Dl5-Mz0WS0q6UTiTka2rC6MWMOqGbJF5YFcpcSSFGjZqATlJnqHe9hJbzuC0Qvo3rscfrkZYXuOyp-vCG9DXcB8M5LsXAVpLqeE1Hj0yLG1v3OdEbYVrg2HZTWvNO1WbbNMdgRblc'); background-size: cover; background-position: center;"></div>
        <div class="relative z-10 max-w-4xl mx-auto">
            <h1 class="font-display text-hero-display text-white mb-md">Follow the Trail, Discover the World</h1>
            <p class="text-body-lg text-on-primary-container mb-xl max-w-2xl mx-auto">Temukan destinasi wisata terbaik Indonesia dalam satu platform</p>

            {{-- Search Bar --}}
            <form action="{{ route('destinations.index') }}" method="GET" class="bg-white p-2 rounded-xl shadow-2xl flex flex-col md:flex-row items-center gap-2 max-w-[600px] mx-auto mb-lg">
                <div class="flex items-center px-md w-full">
                    <span class="material-symbols-outlined text-outline">search</span>
                    <input name="q" class="w-full border-none focus:ring-0 text-on-surface py-md" placeholder="Cari destinasi wisata..." type="text"/>
                </div>
                <button type="submit" class="w-full md:w-auto bg-secondary text-white px-xl py-md rounded-lg font-bold hover:opacity-90">Cari</button>
            </form>

            {{-- Quick Tags --}}
            <div class="flex flex-wrap justify-center gap-sm">
                <a href="{{ route('destinations.index') }}?kategori=Pantai" class="px-md py-sm rounded-full border border-white text-white font-label-md cursor-pointer hover:bg-white/10 transition-all">🏖 Pantai</a>
                <a href="{{ route('destinations.index') }}?kategori=Gunung" class="px-md py-sm rounded-full border border-white text-white font-label-md cursor-pointer hover:bg-white/10 transition-all">⛰ Gunung</a>
                <a href="{{ route('destinations.index') }}?kategori=Budaya" class="px-md py-sm rounded-full border border-white text-white font-label-md cursor-pointer hover:bg-white/10 transition-all">🏛 Budaya</a>
                <a href="{{ route('destinations.index') }}?kategori=Kuliner" class="px-md py-sm rounded-full border border-white text-white font-label-md cursor-pointer hover:bg-white/10 transition-all">🍜 Kuliner</a>
            </div>
        </div>
    </section>

    {{-- Peta Interaktif --}}
    <section class="py-xxl px-6 md:px-12 max-w-7xl mx-auto">
        <h2 class="font-display text-h2 text-primary mb-xl flex items-center gap-md">
            <span class="material-symbols-outlined text-primary-container">map</span>
            Jelajahi Destinasi di Peta
        </h2>
        <div class="rounded-xl h-[450px] overflow-hidden border border-tertiary-fixed-dim shadow-sm">
            <div id="map-home" style="height: 450px; width: 100%;"></div>
        </div>
    </section>

    {{-- Cuaca 5 Kota --}}
    <section class="py-xxl bg-surface-container">
        <div class="max-w-7xl mx-auto px-6 md:px-12">
            <h2 class="font-display text-h2 text-primary mb-xl flex items-center gap-md">
                <span class="material-symbols-outlined text-primary-container">cloudy_snowing</span>
                Cuaca Hari Ini
            </h2>
            <div class="grid grid-cols-2 md:grid-cols-5 gap-lg" id="weather-grid">
                @foreach([
                    ['nama' => 'Mataram', 'lat' => -8.5833, 'lon' => 116.1167],
                    ['nama' => 'Lombok Barat', 'lat' => -8.6500, 'lon' => 116.0833],
                    ['nama' => 'Lombok Tengah', 'lat' => -8.7442, 'lon' => 116.2833],
                    ['nama' => 'Lombok Timur', 'lat' => -8.5667, 'lon' => 116.5833],
                    ['nama' => 'Lombok Utara', 'lat' => -8.3667, 'lon' => 116.1667],
                ] as $kota)
                <div class="bg-[#E0F2FE] p-xl rounded-xl text-center border border-outline-variant hover:scale-105 transition-transform"
                     data-lat="{{ $kota['lat'] }}" data-lon="{{ $kota['lon'] }}" data-nama="{{ $kota['nama'] }}">
                    <p class="font-label-md text-primary mb-sm">{{ $kota['nama'] }}</p>
                    <span class="material-symbols-outlined text-4xl text-on-secondary-container mb-md weather-icon">sunny</span>
                    <h3 class="font-display text-h3 weather-temp">--°C</h3>
                    <span class="bg-white/50 px-sm py-xs rounded-lg text-caption mt-sm block weather-humidity">-- Humidity</span>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Destinasi Populer --}}
    <section class="py-xxl px-6 md:px-12 max-w-7xl mx-auto">
        <div class="flex flex-col md:flex-row justify-between items-end mb-xl gap-md">
            <div>
                <h2 class="font-display text-h2 text-primary">Destinasi Populer</h2>
                <p class="text-on-surface-variant text-body-md">Pilihan terbaik untuk petualanganmu selanjutnya</p>
            </div>
            <a href="{{ route('destinations.index') }}" class="text-tertiary font-bold border-b-2 border-tertiary hover:gap-md transition-all text-sm">
                Lihat Semua →
            </a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-lg">
            @forelse($destinations as $destination)
            <a href="{{ route('destinations.show', $destination) }}"
               class="bg-surface-container-lowest rounded-xl overflow-hidden border border-outline-variant hover:-translate-y-1 transition-all emerald-shadow group cursor-pointer block">
                <div class="relative h-[180px]">
                    @if($destination->image)
                        <img src="{{ asset('storage/'.$destination->image) }}" class="w-full h-full object-cover" alt="{{ $destination->name }}">
                    @else
                        <div class="w-full h-full bg-surface-container flex items-center justify-center">
                            <span class="material-symbols-outlined text-5xl text-outline">landscape</span>
                        </div>
                    @endif
                    <span class="absolute top-md left-md bg-secondary text-white px-sm py-xs rounded font-label-md text-caption">
                        {{ $destination->category }}
                    </span>
                    @auth
                    <form action="{{ route('favorites.toggle', $destination) }}" method="POST" onclick="event.stopPropagation()">
                        @csrf
                        <button type="submit" class="absolute top-md right-md w-9 h-9 bg-white/80 rounded-full flex items-center justify-center hover:bg-white transition-colors">
                            <span class="material-symbols-outlined text-error text-[20px]">favorite</span>
                        </button>
                    </form>
                    @endauth
                </div>
                <div class="p-md">
                    <div class="flex justify-between items-center mb-xs">
                        <h3 class="font-display text-h3 text-primary truncate">{{ $destination->name }}</h3>
                    </div>
                    <p class="text-caption text-on-surface-variant flex items-center gap-xs mb-md">
                        <span class="material-symbols-outlined text-[14px]">location_on</span>
                        {{ $destination->location }}
                    </p>
                </div>
            </a>
            @empty
            <p class="text-on-surface-variant col-span-4 text-center py-12">Belum ada destinasi.</p>
            @endforelse
        </div>
    </section>

    {{-- Tour Guide --}}
    <section class="py-xxl bg-background">
        <div class="max-w-7xl mx-auto px-6 md:px-12">
            <div class="text-center mb-xl">
                <h2 class="font-display text-h2 text-primary">Tour Guide Terverifikasi</h2>
                <p class="text-on-surface-variant text-body-md max-w-xl mx-auto mt-xs">Temukan pemandu wisata profesional untuk perjalananmu</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-lg">
                @forelse($tourguides as $tourguide)
                <div class="bg-white p-lg rounded-xl border border-tertiary-fixed shadow-sm text-center">
                    @if($tourguide->photo)
                        <img src="{{ asset('storage/'.$tourguide->photo) }}" class="w-24 h-24 rounded-full mx-auto mb-md object-cover border-2 border-tertiary-fixed-dim" alt="{{ $tourguide->user->name }}">
                    @else
                        <div class="w-24 h-24 rounded-full mx-auto mb-md bg-surface-container flex items-center justify-center border-2 border-tertiary-fixed-dim">
                            <span class="material-symbols-outlined text-4xl text-outline">person</span>
                        </div>
                    @endif
                    <h3 class="font-display text-h3 text-primary">{{ $tourguide->user->name }}</h3>
                    <p class="text-caption text-on-surface-variant mb-md">{{ $tourguide->location }}</p>
                    <span class="inline-block bg-primary-fixed text-on-primary-fixed px-sm py-xs rounded-full text-caption font-bold mb-md">Tersedia</span>
                    <a href="{{ route('tourguides.show', $tourguide) }}" class="block w-full border-2 border-tertiary text-tertiary py-sm rounded-lg font-bold hover:bg-tertiary hover:text-white transition-all text-sm">
                        Lihat Profil
                    </a>
                </div>
                @empty
                <p class="text-on-surface-variant col-span-4 text-center py-12">Belum ada tour guide.</p>
                @endforelse
            </div>
            <div class="text-center mt-xl">
                <a href="{{ route('tourguides.index') }}" class="inline-flex items-center gap-sm text-tertiary font-bold border-b-2 border-tertiary hover:gap-md transition-all">
                    Lihat Semua Tour Guide <span class="material-symbols-outlined">arrow_forward</span>
                </a>
            </div>
        </div>
    </section>

    {{-- Stats --}}
    <section class="bg-primary py-xxl">
        <div class="max-w-7xl mx-auto px-6 md:px-12 grid grid-cols-2 md:grid-cols-4 gap-xl text-center">
            <div>
                <h2 class="font-display text-hero-display text-tertiary-fixed-dim">{{ $stats['destinations'] }}+</h2>
                <p class="text-on-primary-container font-label-md">Destinasi</p>
            </div>
            <div>
                <h2 class="font-display text-hero-display text-tertiary-fixed-dim">{{ $stats['tourguides'] }}+</h2>
                <p class="text-on-primary-container font-label-md">Tour Guide</p>
            </div>
            <div>
                <h2 class="font-display text-hero-display text-tertiary-fixed-dim">12K+</h2>
                <p class="text-on-primary-container font-label-md">Wisatawan</p>
            </div>
            <div>
                <h2 class="font-display text-hero-display text-tertiary-fixed-dim">8K+</h2>
                <p class="text-on-primary-container font-label-md">Ulasan</p>
            </div>
        </div>
    </section>

    @push('scripts')
    <script>
    // Peta Homepage
    var mapHome = L.map('map-home').setView([-2.5, 118.0], 5);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(mapHome);

    // Marker semua destinasi
    var destinations = @json($destinations);
    destinations.forEach(function(d) {
        if (d.latitude && d.longitude) {
            L.marker([d.latitude, d.longitude])
                .addTo(mapHome)
                .bindPopup('<b>' + d.name + '</b><br>' + d.location);
        }
    });

    // Cuaca 5 Kota
    const weatherIcons = {
        0: 'sunny', 1: 'partly_cloudy_day', 2: 'partly_cloudy_day',
        3: 'cloud', 45: 'foggy', 48: 'foggy',
        51: 'grain', 61: 'rainy', 63: 'rainy',
        65: 'rainy', 80: 'rainy', 95: 'thunderstorm'
    };

    document.querySelectorAll('#weather-grid > div').forEach(function(card) {
        const lat = card.dataset.lat;
        const lon = card.dataset.lon;
        fetch(`https://api.open-meteo.com/v1/forecast?latitude=${lat}&longitude=${lon}&current=temperature_2m,weathercode,relative_humidity_2m`)
            .then(r => r.json())
            .then(data => {
                const c = data.current;
                card.querySelector('.weather-temp').textContent = c.temperature_2m + '°C';
                card.querySelector('.weather-humidity').textContent = c.relative_humidity_2m + '% Humidity';
                card.querySelector('.weather-icon').textContent = weatherIcons[c.weathercode] || 'sunny';
            })
            .catch(() => {});
    });
    </script>
    @endpush
</x-app-layout>