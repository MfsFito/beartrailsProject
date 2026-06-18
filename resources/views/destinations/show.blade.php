<x-app-layout>

    {{-- Hero Image --}}
    <section class="relative w-full h-[420px] overflow-hidden">
        @if($destination->image)
            <img src="{{ asset('storage/'.$destination->image) }}"
                 class="w-full h-full object-cover" alt="{{ $destination->name }}">
        @else
            <div class="w-full h-full bg-gradient-to-br from-primary to-primary-container"></div>
        @endif
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
        <div class="absolute bottom-12 left-6 md:left-12 max-w-7xl mx-auto w-full">
            <span class="inline-block px-3 py-1 bg-secondary-container text-on-secondary-container text-xs font-bold rounded-md mb-4 uppercase tracking-wider">
                {{ $destination->category }}
            </span>
            <h1 class="text-white font-display text-5xl font-bold leading-tight drop-shadow-lg">
                {{ $destination->name }}
            </h1>
        </div>
    </section>

    {{-- Galeri Foto --}}
    @if($destination->images->count() > 0)
    @php
        $allImages = $destination->images;
        $totalImages = $allImages->count();
        $showImages = $allImages->take(5);
        $remaining = $totalImages - 5;
    @endphp
    <div class="max-w-[1200px] mx-auto px-6 pt-6 mb-4">

        {{-- 1 foto --}}
        @if($totalImages === 1)
        <div class="h-[400px] rounded-xl overflow-hidden cursor-pointer"
            onclick="openLightbox('{{ asset('storage/'.$showImages->first()->image) }}', 0)">
            <img src="{{ asset('storage/'.$showImages->first()->image) }}"
                class="w-full h-full object-cover hover:scale-105 transition-transform duration-300"
                alt="{{ $destination->name }}">
        </div>

        {{-- 2 foto --}}
        @elseif($totalImages === 2)
        <div class="grid grid-cols-2 gap-3 h-[400px]">
            @foreach($showImages as $index => $img)
            <div class="rounded-xl overflow-hidden cursor-pointer group"
                onclick="openLightbox('{{ asset('storage/'.$img->image) }}', {{ $index }})">
                <img src="{{ asset('storage/'.$img->image) }}"
                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                    alt="{{ $destination->name }}">
            </div>
            @endforeach
        </div>

        {{-- 3 foto --}}
        @elseif($totalImages === 3)
        <div class="grid grid-cols-3 gap-3 h-[400px]">
            @foreach($showImages as $index => $img)
            <div class="rounded-xl overflow-hidden cursor-pointer group"
                onclick="openLightbox('{{ asset('storage/'.$img->image) }}', {{ $index }})">
                <img src="{{ asset('storage/'.$img->image) }}"
                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                    alt="{{ $destination->name }}">
            </div>
            @endforeach
        </div>

        {{-- 4+ foto --}}
        @else
        <div class="grid grid-cols-4 grid-rows-2 gap-3 h-[420px]">

            {{-- Foto pertama: besar di kiri --}}
            <div class="col-span-2 row-span-2 rounded-xl overflow-hidden cursor-pointer group"
                onclick="openLightbox('{{ asset('storage/'.$showImages->first()->image) }}', 0)">
                <img src="{{ asset('storage/'.$showImages->first()->image) }}"
                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                    alt="{{ $destination->name }}">
            </div>

            {{-- Foto 2-5: grid kanan --}}
            @foreach($showImages->skip(1)->take(4) as $index => $img)
            <div class="relative rounded-xl overflow-hidden cursor-pointer group"
                onclick="openLightbox('{{ asset('storage/'.$img->image) }}', {{ $index + 1 }})">
                <img src="{{ asset('storage/'.$img->image) }}"
                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                    alt="{{ $destination->name }}">

                {{-- Tombol +N foto di foto terakhir --}}
                @if($loop->last && $remaining > 0)
                <div onclick="event.stopPropagation(); openGallery()"
                    class="absolute inset-0 bg-black/50 flex items-center justify-center cursor-pointer hover:bg-black/60 transition-all">
                    <span class="text-white font-bold text-xl">+{{ $remaining }} foto</span>
                </div>
                @endif
            </div>
            @endforeach

        </div>
        @endif

    </div>

    {{-- Lightbox --}}
    <div id="lightbox" class="hidden fixed inset-0 bg-black/95 z-[200] flex flex-col items-center justify-center p-4">
        <button onclick="closeLightbox()" class="absolute top-4 right-4 text-white hover:text-gray-300 z-10">
            <span class="material-symbols-outlined text-4xl">close</span>
        </button>
        <div class="absolute top-4 left-1/2 -translate-x-1/2 text-white text-sm font-semibold bg-black/40 px-4 py-1 rounded-full" id="lightbox-counter"></div>
        <div class="relative flex items-center justify-center w-full max-h-[80vh]">
            <button onclick="prevPhoto()" class="absolute left-4 text-white hover:text-gray-300 bg-black/40 rounded-full p-2 transition-all hover:bg-black/60">
                <span class="material-symbols-outlined text-3xl">chevron_left</span>
            </button>
            <img id="lightbox-img" src="" class="max-w-full max-h-[75vh] rounded-xl shadow-2xl object-contain">
            <button onclick="nextPhoto()" class="absolute right-4 text-white hover:text-gray-300 bg-black/40 rounded-full p-2 transition-all hover:bg-black/60">
                <span class="material-symbols-outlined text-3xl">chevron_right</span>
            </button>
        </div>
        <div class="flex gap-2 mt-4 overflow-x-auto max-w-full px-4" id="lightbox-thumbs"></div>
    </div>

    {{-- Data semua foto untuk JS --}}
    <script>
        var allPhotos = [
            @foreach($allImages as $img)
            '{{ asset('storage/'.$img->image) }}',
            @endforeach
        ];
    </script>

    @endif
    
    {{-- Main Content --}}
    <main class="max-w-[1200px] mx-auto py-12 px-6 grid grid-cols-1 md:grid-cols-3 gap-12">

        {{-- Kolom Kiri --}}
        <div class="md:col-span-2">

            {{-- Info Lokasi & Rating --}}
            <div class="flex flex-wrap items-center gap-6 mb-8">
                <div class="flex items-center text-on-surface-variant font-medium">
                    <span class="material-symbols-outlined text-tertiary mr-2">location_on</span>
                    {{ $destination->location }}
                </div>
                <div class="flex items-center bg-surface-container px-3 py-1.5 rounded-full border border-outline-variant">
                    <span class="material-symbols-outlined text-secondary mr-1 text-[18px]">star</span>
                    <span class="font-bold text-on-surface mr-1">
                        {{ number_format($destination->averageRating() ?? 0, 1) }}
                    </span>
                    <span class="text-on-surface-variant text-xs">({{ $reviews->count() }} ulasan)</span>
                </div>
                <div class="flex items-center text-on-surface-variant font-medium">
                    <span class="material-symbols-outlined text-secondary mr-2">confirmation_number</span>
                    @if($destination->entry_fee == 0)
                        <span class="text-green-600 font-bold">Gratis</span>
                    @else
                        <span class="font-bold text-primary">Rp {{ number_format($destination->entry_fee, 0, ',', '.') }}</span>
                    @endif
                </div>
            </div>

            {{-- Deskripsi --}}
            <div class="mb-8">
                <p class="text-lg text-on-surface leading-relaxed">
                    {{ $destination->description }}
                </p>
            </div>

            {{-- Peta --}}
            @if($destination->latitude && $destination->longitude)
            <div class="mb-8">
                <h2 class="font-display text-2xl font-semibold text-primary mb-4">Lokasi Destinasi</h2>
                <div id="map" class="w-full h-[350px] rounded-xl border border-tertiary-fixed-dim shadow-sm"></div>
                <div class="mt-3">
                    <a href="https://www.openstreetmap.org/?mlat={{ $destination->latitude }}&mlon={{ $destination->longitude }}"
                       target="_blank"
                       class="inline-flex items-center text-tertiary font-bold hover:underline text-sm">
                        Buka di OpenStreetMap
                        <span class="material-symbols-outlined text-sm ml-1">north_east</span>
                    </a>
                </div>
            </div>
            @endif

            {{-- Reviews --}}
            <div class="mb-8">
                <h2 class="font-display text-2xl font-semibold text-primary mb-6">Ulasan Pengunjung</h2>

                @if($reviews->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                    <div class="bg-surface-container p-8 rounded-2xl flex flex-col items-center justify-center text-center">
                        <div class="text-6xl font-bold text-primary leading-none mb-2">
                            {{ number_format($destination->averageRating() ?? 0, 1) }}
                        </div>
                        <div class="flex text-secondary mb-4">
                            @for($i = 1; $i <= 5; $i++)
                                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                            @endfor
                        </div>
                        <p class="text-on-surface-variant text-sm">{{ $reviews->count() }} ulasan</p>
                    </div>
                    <div class="md:col-span-2 space-y-4">
                        @foreach($reviews->take(2) as $review)
                        <div class="p-6 bg-surface-container-low rounded-xl border border-outline-variant">
                            <div class="flex justify-between items-start mb-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-tertiary-fixed flex items-center justify-center font-bold text-tertiary text-sm">
                                        {{ strtoupper(substr($review->user->name, 0, 2)) }}
                                    </div>
                                    <div>
                                        <h5 class="font-bold text-sm">{{ $review->user->name }}</h5>
                                        <span class="text-xs text-on-surface-variant">{{ $review->created_at->format('d M Y') }}</span>
                                    </div>
                                </div>
                                <div class="flex text-secondary">
                                    @for($i = 1; $i <= $review->rating; $i++)
                                        <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">star</span>
                                    @endfor
                                </div>
                            </div>
                            <p class="text-on-surface-variant text-sm">{{ $review->comment }}</p>
                            @if(auth()->id() === $review->user_id)
                            <form action="{{ route('reviews.destroy', $review) }}" method="POST" class="mt-2">
                                @csrf
                                @method('DELETE')
                                <button class="text-error text-xs hover:underline">Hapus Review</button>
                            </form>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                @auth
                <div class="bg-surface-container-highest p-8 rounded-2xl border border-outline-variant">
                    <h3 class="font-bold text-lg text-primary mb-6">Bagikan Pengalamanmu</h3>
                    <form action="{{ route('reviews.store', $destination) }}" method="POST" class="space-y-6">
                        @csrf
                        <div>
                            <label class="block text-sm font-bold text-on-surface-variant mb-2">Rating Kamu</label>
                            <div class="flex gap-1">
                                @for($i = 1; $i <= 5; $i++)
                                <label class="cursor-pointer">
                                    <input type="radio" name="rating" value="{{ $i }}" class="hidden" required>
                                    <span class="material-symbols-outlined text-outline hover:text-secondary transition-colors star-btn" data-value="{{ $i }}">star</span>
                                </label>
                                @endfor
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-on-surface-variant mb-2">Ulasan</label>
                            <textarea name="comment" rows="4"
                                      class="w-full bg-white border border-outline-variant rounded-xl p-4 text-sm focus:ring-2 focus:ring-tertiary-fixed-dim outline-none transition-all placeholder:text-outline"
                                      placeholder="Ceritakan pengalamanmu berkunjung ke sini..."></textarea>
                        </div>
                        <button type="submit"
                                class="px-8 py-3 bg-secondary-container text-on-secondary-container font-bold rounded-lg hover:opacity-90 transition-all shadow-sm">
                            Kirim Ulasan
                        </button>
                    </form>
                </div>
                @else
                <div class="bg-surface-container p-6 rounded-xl text-center">
                    <p class="text-on-surface-variant mb-3">Login untuk menulis ulasan</p>
                    <a href="{{ route('login') }}" class="inline-block px-6 py-2 bg-primary text-white rounded-lg font-bold hover:opacity-90 transition-all">
                        Masuk Sekarang
                    </a>
                </div>
                @endauth
            </div>
        </div>

        {{-- Kolom Kanan (Sidebar) --}}
        <aside class="space-y-6">
            <div class="sticky top-[100px] space-y-6">

                {{-- Tombol Favorit --}}
                @auth
                <div class="bg-surface-container-highest p-6 rounded-xl shadow-sm border border-outline-variant">
                    <form action="{{ route('favorites.toggle', $destination) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full py-4 bg-secondary-container text-on-secondary-container font-bold rounded-lg flex justify-center items-center gap-2 hover:opacity-90 transition-all active:scale-95">
                            <span class="material-symbols-outlined">favorite</span>
                            Simpan ke Favorit
                        </button>
                    </form>
                </div>
                @endauth

                {{-- Cuaca Saat Ini --}}
                @if($destination->latitude && $destination->longitude)
                <div class="bg-[#90E0EF] p-6 rounded-xl text-primary shadow-sm border border-sky-300">
                    <div class="flex justify-between items-start mb-4">
                        <h4 class="font-bold uppercase tracking-widest text-xs opacity-70">Cuaca Saat Ini</h4>
                        <span class="material-symbols-outlined text-3xl" id="weather-icon-sidebar">wb_sunny</span>
                    </div>
                    <div class="text-4xl font-bold mb-2" id="weather-temp-sidebar">--°C</div>
                    <div class="flex justify-between text-sm font-medium">
                        <div class="flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm">humidity_mid</span>
                            <span id="weather-humidity-sidebar">--%</span>
                        </div>
                        <div id="weather-condition-sidebar">Memuat...</div>
                    </div>
                </div>

                {{-- Cuaca Per Waktu --}}
                <div class="bg-gray-100 p-5 rounded-xl shadow-sm border border-gray-200">
                    <h4 class="font-bold uppercase tracking-widest text-xs text-gray-500 mb-4">🕐 Hari Ini</h4>
                    <div id="hourly-container" class="grid grid-cols-4 gap-2">
                        @foreach(['Pagi', 'Siang', 'Sore', 'Malam'] as $waktu)
                        <div class="text-center">
                            <p class="text-xs text-gray-400">{{ $waktu }}</p>
                            <p class="text-lg my-1">--</p>
                            <p class="text-xs font-bold text-gray-600">--°</p>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Forecast 7 Hari --}}
                <div class="bg-gray-100 p-5 rounded-xl shadow-sm border border-gray-200">
                    <h4 class="font-bold uppercase tracking-widest text-xs text-gray-500 mb-4">📅 7 Hari ke Depan</h4>
                    <div id="forecast-container" class="space-y-2">
                        <p class="text-gray-400 text-xs text-center">Memuat prakiraan...</p>
                    </div>
                </div>

                {{-- Tombol Rute --}}
                <div class="bg-surface-container-highest p-5 rounded-xl shadow-sm border border-outline-variant">
                    <h4 class="font-bold uppercase tracking-widest text-xs text-on-surface-variant mb-3">🧭 Navigasi</h4>
                    <button onclick="showRoute()" id="btn-route"
                            class="w-full py-3 bg-primary text-white font-semibold rounded-lg flex justify-center items-center gap-2 hover:opacity-90 transition-all active:scale-95 text-sm">
                        <span class="material-symbols-outlined text-[18px]">directions</span>
                        Rute ke Sini
                    </button>
                    <button onclick="cancelRoute()" id="btn-cancel-route"
                            class="hidden w-full py-3 bg-error text-white font-semibold rounded-lg flex justify-center items-center gap-2 hover:opacity-90 transition-all active:scale-95 text-sm mt-2">
                        <span class="material-symbols-outlined text-[18px]">close</span>
                        Batalkan Rute
                    </button>
                    <p class="text-xs text-on-surface-variant mt-2 text-center">Membutuhkan izin lokasi GPS</p>
                    <div id="route-info" class="hidden mt-3 p-3 bg-surface-container rounded-lg text-xs text-on-surface-variant"></div>
                </div>
                @endif

            </div>
        </aside>
    </main>

    @if($destination->latitude && $destination->longitude)
    @push('scripts')
    <script>
    window.addEventListener('load', function() {

        // Peta
        var map = L.map('map').setView([{{ $destination->latitude }}, {{ $destination->longitude }}], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);
        L.marker([{{ $destination->latitude }}, {{ $destination->longitude }}])
            .addTo(map)
            .bindPopup('<b>{{ $destination->name }}</b><br>{{ $destination->location }}')
            .openPopup();

        // Data cuaca
        const weatherCodes = {
            0: ['wb_sunny', 'Cerah'],
            1: ['partly_cloudy_day', 'Sebagian Cerah'],
            2: ['partly_cloudy_day', 'Berawan'],
            3: ['cloud', 'Mendung'],
            45: ['foggy', 'Berkabut'],
            51: ['grain', 'Gerimis'],
            61: ['rainy', 'Hujan Ringan'],
            63: ['rainy', 'Hujan Sedang'],
            80: ['rainy', 'Hujan Lokal'],
            95: ['thunderstorm', 'Badai']
        };

        const weatherEmoji = {
            0: '☀️', 1: '🌤️', 2: '⛅', 3: '☁️',
            45: '🌫️', 51: '🌦️', 61: '🌧️', 63: '🌧️',
            80: '🌦️', 95: '⛈️'
        };

        const hari = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];

        // Fetch cuaca + hourly + forecast
        fetch('https://api.open-meteo.com/v1/forecast?latitude={{ $destination->latitude }}&longitude={{ $destination->longitude }}&current=temperature_2m,weathercode,relative_humidity_2m&hourly=temperature_2m,weathercode,precipitation_probability&daily=temperature_2m_max,temperature_2m_min,weathercode,precipitation_sum&timezone=Asia%2FMakassar&forecast_days=7')
            .then(r => r.json())
            .then(data => {

                // Cuaca Saat Ini
                const c = data.current;
                const [icon, condition] = weatherCodes[c.weathercode] || ['wb_sunny', 'Cerah'];
                document.getElementById('weather-temp-sidebar').textContent = c.temperature_2m + '°C';
                document.getElementById('weather-humidity-sidebar').textContent = c.relative_humidity_2m + '%';
                document.getElementById('weather-condition-sidebar').textContent = condition;
                document.getElementById('weather-icon-sidebar').textContent = icon;

                // Cuaca Per Waktu
                const jamTarget = [6, 12, 18, 21];
                const labelWaktu = ['🌅 Pagi', '☀️ Siang', '🌤️ Sore', '🌙 Malam'];
                const jamLabel = ['06.00', '12.00', '18.00', '21.00'];

                let hourlyHTML = '';
                jamTarget.forEach((jam, idx) => {
                    const jamIndex = data.hourly.time.findIndex(t => t.includes(`T${String(jam).padStart(2,'0')}:00`));
                    const suhu = jamIndex !== -1 ? Math.round(data.hourly.temperature_2m[jamIndex]) : '--';
                    const kode = jamIndex !== -1 ? data.hourly.weathercode[jamIndex] : 0;
                    const emoji = weatherEmoji[kode] || '🌡️';
                    const hujanProb = jamIndex !== -1 ? data.hourly.precipitation_probability[jamIndex] : 0;

                    hourlyHTML += `
                        <div class="text-center bg-white rounded-lg p-2 shadow-sm">
                            <p class="text-[10px] text-gray-400 font-semibold">${labelWaktu[idx]}</p>
                            <p class="text-[10px] text-gray-300 mb-1">${jamLabel[idx]}</p>
                            <p class="text-xl my-1">${emoji}</p>
                            <p class="text-sm font-bold text-gray-700">${suhu}°C</p>
                            ${hujanProb > 0 ? `<p class="text-[10px] text-blue-400">💧${hujanProb}%</p>` : ''}
                        </div>
                    `;
                });
                document.getElementById('hourly-container').innerHTML = hourlyHTML;

                // Forecast 7 Hari
                const daily = data.daily;
                let forecastHTML = '';
                for (let i = 0; i < 7; i++) {
                    const date = new Date(daily.time[i]);
                    const namaHari = i === 0 ? 'Hari Ini' : hari[date.getDay()];
                    const emoji = weatherEmoji[daily.weathercode[i]] || '🌡️';
                    const max = Math.round(daily.temperature_2m_max[i]);
                    const min = Math.round(daily.temperature_2m_min[i]);
                    const hujan = daily.precipitation_sum[i] > 0
                        ? `<span class="text-blue-400 text-[10px]">💧${daily.precipitation_sum[i]}mm</span>`
                        : '';

                    forecastHTML += `
                        <div class="flex items-center justify-between py-1.5 ${i === 0 ? 'border-b border-gray-200 pb-2 mb-1' : ''}">
                            <span class="text-xs font-semibold text-gray-600 w-16">${namaHari}</span>
                            <span class="text-base">${emoji}</span>
                            <div class="text-right">
                                <span class="text-xs font-bold text-gray-700">${max}°</span>
                                <span class="text-xs text-gray-400 ml-1">${min}°</span>
                                ${hujan}
                            </div>
                        </div>
                    `;
                }
                document.getElementById('forecast-container').innerHTML = forecastHTML;
            })
            .catch(() => {
                document.getElementById('weather-condition-sidebar').textContent = 'Data tidak tersedia';
                document.getElementById('forecast-container').innerHTML = '<p class="text-gray-400 text-xs text-center">Data tidak tersedia</p>';
                document.getElementById('hourly-container').innerHTML = '<p class="text-gray-400 text-xs text-center col-span-4">Data tidak tersedia</p>';
            });

        // Fungsi Rute
        var routingControl = null;

        window.showRoute = function() {
            if (!navigator.geolocation) {
                alert('Browser kamu tidak mendukung GPS.');
                return;
            }

            const btn = document.getElementById('btn-route');
            btn.innerHTML = '⏳ Mencari lokasi...';
            btn.disabled = true;

            navigator.geolocation.getCurrentPosition(
                function(pos) {
                    const userLat = pos.coords.latitude;
                    const userLon = pos.coords.longitude;

                    if (routingControl) {
                        map.removeControl(routingControl);
                    }

                    routingControl = L.Routing.control({
                        waypoints: [
                            L.latLng(userLat, userLon),
                            L.latLng({{ $destination->latitude }}, {{ $destination->longitude }})
                        ],
                        routeWhileDragging: false,
                        showAlternatives: false,
                        lineOptions: {
                            styles: [{ color: '#012d1d', weight: 5 }]
                        },
                        createMarker: function(i, waypoint) {
                            const icon = i === 0 ? '📍' : '🏁';
                            return L.marker(waypoint.latLng, {
                                icon: L.divIcon({
                                    html: `<div style="font-size:24px">${icon}</div>`,
                                    iconSize: [30, 30],
                                    className: ''
                                })
                            });
                        }
                    }).addTo(map);

                    routingControl.on('routesfound', function(e) {
                        const route = e.routes[0];
                        const jarak = (route.summary.totalDistance / 1000).toFixed(1);
                        const waktu = Math.round(route.summary.totalTime / 60);
                        document.getElementById('route-info').classList.remove('hidden');
                        document.getElementById('route-info').innerHTML = `
                            📏 Jarak: <strong>${jarak} km</strong><br>
                            ⏱️ Estimasi: <strong>${waktu} menit</strong>
                        `;
                    });

                    document.getElementById('map').scrollIntoView({ behavior: 'smooth' });
                    btn.innerHTML = '<span class="material-symbols-outlined text-[18px]">directions</span> Ubah Rute';
                    btn.disabled = false;
                    document.getElementById('btn-cancel-route').classList.remove('hidden');
                },
                function() {
                    alert('Gagal mendapatkan lokasi. Pastikan GPS aktif dan izin lokasi diberikan.');
                    btn.innerHTML = '<span class="material-symbols-outlined text-[18px]">directions</span> Rute ke Sini';
                    btn.disabled = false;
                }
            );
        };

        // Batalkan Rute
        window.cancelRoute = function() {
            if (routingControl) {
                map.removeControl(routingControl);
                routingControl = null;
            }
            document.getElementById('route-info').classList.add('hidden');
            document.getElementById('btn-cancel-route').classList.add('hidden');
            document.getElementById('btn-route').innerHTML = '<span class="material-symbols-outlined text-[18px]">directions</span> Rute ke Sini';
            document.getElementById('btn-route').disabled = false;
        };

        // Star Rating
        const stars = document.querySelectorAll('.star-btn');
        stars.forEach((star, index) => {
            star.addEventListener('click', function() {
                stars.forEach((s, i) => {
                    s.style.fontVariationSettings = i <= index ? "'FILL' 1" : "'FILL' 0";
                    s.style.color = i <= index ? '#8e4e14' : '';
                });
                document.querySelector(`input[value="${index + 1}"]`).checked = true;
            });
        });

        // ── Lightbox dengan navigasi ──
        var currentPhotoIndex = 0;

        window.openLightbox = function(src, index) {
            currentPhotoIndex = index || 0;
            showPhoto(currentPhotoIndex);
            document.getElementById('lightbox').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            buildThumbs();
        };

        window.openGallery = function() {
            openLightbox(allPhotos[0], 0);
        };

        window.closeLightbox = function() {
            document.getElementById('lightbox').classList.add('hidden');
            document.body.style.overflow = '';
        };

        window.prevPhoto = function() {
            currentPhotoIndex = (currentPhotoIndex - 1 + allPhotos.length) % allPhotos.length;
            showPhoto(currentPhotoIndex);
        };

        window.nextPhoto = function() {
            currentPhotoIndex = (currentPhotoIndex + 1) % allPhotos.length;
            showPhoto(currentPhotoIndex);
        };

        function showPhoto(index) {
            document.getElementById('lightbox-img').src = allPhotos[index];
            document.getElementById('lightbox-counter').textContent = (index + 1) + ' / ' + allPhotos.length;
            // Update thumbnail aktif
            document.querySelectorAll('.thumb-item').forEach((t, i) => {
                t.classList.toggle('ring-2', i === index);
                t.classList.toggle('ring-white', i === index);
                t.classList.toggle('opacity-100', i === index);
                t.classList.toggle('opacity-50', i !== index);
            });
        }

        function buildThumbs() {
            const container = document.getElementById('lightbox-thumbs');
            container.innerHTML = '';
            allPhotos.forEach((src, i) => {
                const thumb = document.createElement('img');
                thumb.src = src;
                thumb.className = 'thumb-item w-16 h-16 object-cover rounded-lg cursor-pointer transition-all ' + (i === currentPhotoIndex ? 'ring-2 ring-white opacity-100' : 'opacity-50 hover:opacity-80');
                thumb.onclick = function() {
                    currentPhotoIndex = i;
                    showPhoto(i);
                };
                container.appendChild(thumb);
            });
        }

        // Keyboard navigation
        document.addEventListener('keydown', function(e) {
            if (document.getElementById('lightbox').classList.contains('hidden')) return;
            if (e.key === 'ArrowLeft') prevPhoto();
            if (e.key === 'ArrowRight') nextPhoto();
            if (e.key === 'Escape') closeLightbox();
        });


    });
    </script>
    @endpush
    @endif

</x-app-layout>