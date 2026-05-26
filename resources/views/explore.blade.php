<x-app-layout>

    {{-- Header --}}
    <section class="relative h-[200px] w-full overflow-hidden flex items-center bg-gradient-to-br from-[#1B4332] to-[#2D6A4F]">
        <div class="relative max-w-7xl mx-auto px-6 md:px-12 z-10 w-full">
            <h1 class="font-display text-4xl font-bold text-white">🗺️ Explore Peta</h1>
            <p class="text-white/80 mt-2">Klik titik mana saja di peta untuk melihat koordinat dan cuaca real-time</p>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-6 md:px-12 py-xl">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-lg">

            {{-- Kolom Kiri: Input + Info --}}
            <div class="lg:col-span-1 space-y-lg">

                {{-- Input Koordinat Manual --}}
                <div class="bg-white rounded-xl p-lg shadow-sm border border-outline-variant">
                    <h3 class="font-bold text-primary mb-md flex items-center gap-2">
                        <span class="material-symbols-outlined text-[20px]">pin_drop</span>
                        Cari Koordinat
                    </h3>
                    <div class="space-y-md">
                        <div>
                            <label class="text-xs font-semibold text-on-surface-variant mb-1 block">Latitude</label>
                            <input id="input-lat" type="number" step="any"
                                   placeholder="contoh: -8.4095"
                                   class="w-full border border-outline-variant rounded-lg px-md py-2 text-sm focus:ring-1 focus:ring-primary outline-none"/>
                        </div>
                        <div>
                            <label class="text-xs font-semibold text-on-surface-variant mb-1 block">Longitude</label>
                            <input id="input-lon" type="number" step="any"
                                   placeholder="contoh: 115.1889"
                                   class="w-full border border-outline-variant rounded-lg px-md py-2 text-sm focus:ring-1 focus:ring-primary outline-none"/>
                        </div>
                        <button onclick="searchByCoords()"
                                class="w-full py-2.5 bg-primary text-white rounded-lg text-sm font-semibold hover:opacity-90 transition-all flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-[18px]">search</span>
                            Cari Lokasi
                        </button>
                    </div>
                </div>

                {{-- Tombol GPS --}}
                <button onclick="getMyLocation()"
                        class="w-full py-3 bg-tertiary-fixed text-on-tertiary-fixed-variant rounded-xl font-semibold text-sm flex items-center justify-center gap-2 hover:opacity-90 transition-all shadow-sm border border-outline-variant">
                    <span class="material-symbols-outlined text-[18px]">my_location</span>
                    Lokasi Saya Sekarang
                </button>

                {{-- Info Koordinat --}}
                <div id="coord-info" class="bg-white rounded-xl p-lg shadow-sm border border-outline-variant hidden">
                    <h3 class="font-bold text-primary mb-md flex items-center gap-2">
                        <span class="material-symbols-outlined text-[20px]">location_on</span>
                        Informasi Titik
                    </h3>
                    <div class="space-y-sm">
                        <div class="flex justify-between items-center py-sm border-b border-outline-variant">
                            <span class="text-xs text-on-surface-variant font-semibold">Latitude</span>
                            <span class="text-sm font-bold text-primary" id="info-lat">--</span>
                        </div>
                        <div class="flex justify-between items-center py-sm">
                            <span class="text-xs text-on-surface-variant font-semibold">Longitude</span>
                            <span class="text-sm font-bold text-primary" id="info-lon">--</span>
                        </div>
                    </div>
                </div>

                {{-- Cuaca Hari Ini --}}
                <div id="explore-weather-now" class="bg-[#90E0EF] p-lg rounded-xl shadow-sm border border-sky-300 hidden">
                    <div class="flex justify-between items-start mb-md">
                        <h4 class="font-bold uppercase tracking-widest text-xs text-primary/70">☀️ Cuaca Saat Ini</h4>
                        <span class="material-symbols-outlined text-3xl text-primary" id="explore-weather-icon">wb_sunny</span>
                    </div>
                    <div class="text-4xl font-bold text-primary mb-sm" id="explore-weather-temp">--°C</div>
                    <div class="flex justify-between text-sm font-medium text-primary">
                        <div class="flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm">humidity_mid</span>
                            <span id="explore-weather-humidity">--%</span>
                        </div>
                        <div id="explore-weather-condition">Memuat...</div>
                    </div>
                </div>

                {{-- Cuaca Per Waktu --}}
                <div id="explore-hourly" class="bg-gray-100 p-lg rounded-xl shadow-sm border border-gray-200 hidden">
                    <h4 class="font-bold uppercase tracking-widest text-xs text-gray-500 mb-md">🕐 Hari Ini</h4>
                    <div id="explore-hourly-container" class="grid grid-cols-4 gap-2"></div>
                </div>

                {{-- Forecast 7 Hari --}}
                <div id="explore-forecast" class="bg-gray-100 p-lg rounded-xl shadow-sm border border-gray-200 hidden">
                    <h4 class="font-bold uppercase tracking-widest text-xs text-gray-500 mb-md">📅 7 Hari ke Depan</h4>
                    <div id="explore-forecast-container" class="space-y-2"></div>
                </div>

            </div>

            {{-- Kolom Kanan: Peta --}}
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-sm border border-outline-variant overflow-hidden">
                    <div class="p-md border-b border-outline-variant flex items-center justify-between">
                        <p class="text-sm text-on-surface-variant">
                            <span class="material-symbols-outlined text-[16px] align-middle">info</span>
                            Klik titik mana saja di peta untuk info koordinat & cuaca
                        </p>
                        <div id="loading-indicator" class="hidden text-xs text-primary font-semibold animate-pulse">
                            ⏳ Memuat cuaca...
                        </div>
                    </div>
                    <div id="explore-map" style="height: 600px; width: 100%;"></div>
                </div>
                <div class="mt-md bg-white rounded-xl p-md shadow-sm border border-outline-variant">
                    <p class="text-xs text-on-surface-variant flex items-center gap-1">
                        <span class="material-symbols-outlined text-[16px]">place</span>
                        Marker hijau = destinasi BearTrails yang sudah terdaftar. Klik untuk lihat cuacanya.
                    </p>
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
    <script>
    window.addEventListener('load', function() {

        // Init Peta
        var exploreMap = L.map('explore-map').setView([-2.5, 118.0], 5);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(exploreMap);

        // Marker destinasi dari database
        var destinations = @json($destinations);
        destinations.forEach(function(d) {
            if (d.latitude && d.longitude) {
                L.marker([d.latitude, d.longitude], {
                    icon: L.divIcon({
                        html: `<div style="background:#1B4332;color:white;padding:4px 8px;border-radius:12px;font-size:11px;font-weight:bold;white-space:nowrap;box-shadow:0 2px 4px rgba(0,0,0,0.3)">${d.name}</div>`,
                        className: '',
                        iconAnchor: [0, 0]
                    })
                }).addTo(exploreMap)
                  .on('click', function() {
                      exploreMap.setView([d.latitude, d.longitude], 12);
                      updatePoint(d.latitude, d.longitude);
                  });
            }
        });

        var clickMarker = null;

        // Klik di peta
        exploreMap.on('click', function(e) {
            const lat = parseFloat(e.latlng.lat.toFixed(6));
            const lon = parseFloat(e.latlng.lng.toFixed(6));
            updatePoint(lat, lon);
        });

        // Update titik yang dipilih
        function updatePoint(lat, lon) {
            if (clickMarker) exploreMap.removeLayer(clickMarker);
            clickMarker = L.marker([lat, lon], {
                icon: L.divIcon({
                    html: `<div style="font-size:28px;filter:drop-shadow(0 2px 4px rgba(0,0,0,0.3))">📍</div>`,
                    iconSize: [30, 30],
                    className: ''
                })
            }).addTo(exploreMap);

            // Update info koordinat
            document.getElementById('coord-info').classList.remove('hidden');
            document.getElementById('info-lat').textContent = lat;
            document.getElementById('info-lon').textContent = lon;

            // Update input
            document.getElementById('input-lat').value = lat;
            document.getElementById('input-lon').value = lon;

            // Fetch cuaca
            fetchWeatherExplore(lat, lon);
        }

        // Fetch cuaca
        function fetchWeatherExplore(lat, lon) {
            document.getElementById('loading-indicator').classList.remove('hidden');

            const weatherCodes = {
                0: ['wb_sunny', 'Cerah'], 1: ['partly_cloudy_day', 'Sebagian Cerah'],
                2: ['partly_cloudy_day', 'Berawan'], 3: ['cloud', 'Mendung'],
                45: ['foggy', 'Berkabut'], 51: ['grain', 'Gerimis'],
                61: ['rainy', 'Hujan Ringan'], 63: ['rainy', 'Hujan Sedang'],
                80: ['rainy', 'Hujan Lokal'], 95: ['thunderstorm', 'Badai']
            };

            const weatherEmoji = {
                0: '☀️', 1: '🌤️', 2: '⛅', 3: '☁️',
                45: '🌫️', 51: '🌦️', 61: '🌧️', 63: '🌧️',
                80: '🌦️', 95: '⛈️'
            };

            const hari = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];

            fetch(`https://api.open-meteo.com/v1/forecast?latitude=${lat}&longitude=${lon}&current=temperature_2m,weathercode,relative_humidity_2m&hourly=temperature_2m,weathercode,precipitation_probability&daily=temperature_2m_max,temperature_2m_min,weathercode,precipitation_sum&timezone=Asia%2FMakassar&forecast_days=7`)
                .then(r => r.json())
                .then(data => {
                    document.getElementById('loading-indicator').classList.add('hidden');

                    // Cuaca sekarang
                    const c = data.current;
                    const [icon, condition] = weatherCodes[c.weathercode] || ['wb_sunny', 'Cerah'];
                    document.getElementById('explore-weather-now').classList.remove('hidden');
                    document.getElementById('explore-weather-temp').textContent = c.temperature_2m + '°C';
                    document.getElementById('explore-weather-humidity').textContent = c.relative_humidity_2m + '%';
                    document.getElementById('explore-weather-condition').textContent = condition;
                    document.getElementById('explore-weather-icon').textContent = icon;

                    // Per waktu
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
                    document.getElementById('explore-hourly').classList.remove('hidden');
                    document.getElementById('explore-hourly-container').innerHTML = hourlyHTML;

                    // 7 hari
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
                    document.getElementById('explore-forecast').classList.remove('hidden');
                    document.getElementById('explore-forecast-container').innerHTML = forecastHTML;
                })
                .catch(() => {
                    document.getElementById('loading-indicator').classList.add('hidden');
                    document.getElementById('explore-weather-now').classList.remove('hidden');
                    document.getElementById('explore-weather-condition').textContent = 'Data tidak tersedia';
                });
        }

        // Search manual koordinat
        window.searchByCoords = function() {
            const lat = parseFloat(document.getElementById('input-lat').value);
            const lon = parseFloat(document.getElementById('input-lon').value);
            if (isNaN(lat) || isNaN(lon)) {
                alert('Masukkan latitude dan longitude yang valid!');
                return;
            }
            if (lat < -90 || lat > 90 || lon < -180 || lon > 180) {
                alert('Koordinat tidak valid! Latitude: -90 hingga 90, Longitude: -180 hingga 180');
                return;
            }
            exploreMap.setView([lat, lon], 12);
            updatePoint(lat, lon);
        };

        // Lokasi GPS user
        window.getMyLocation = function() {
            if (!navigator.geolocation) {
                alert('Browser tidak mendukung GPS.');
                return;
            }
            const btn = document.querySelector('button[onclick="getMyLocation()"]');
            btn.textContent = '⏳ Mencari lokasi...';
            btn.disabled = true;

            navigator.geolocation.getCurrentPosition(
                function(pos) {
                    const lat = parseFloat(pos.coords.latitude.toFixed(6));
                    const lon = parseFloat(pos.coords.longitude.toFixed(6));
                    exploreMap.setView([lat, lon], 13);
                    updatePoint(lat, lon);
                    btn.innerHTML = '<span class="material-symbols-outlined text-[18px]">my_location</span> Lokasi Saya Sekarang';
                    btn.disabled = false;
                },
                function() {
                    alert('Gagal mendapatkan lokasi. Pastikan GPS aktif.');
                    btn.innerHTML = '<span class="material-symbols-outlined text-[18px]">my_location</span> Lokasi Saya Sekarang';
                    btn.disabled = false;
                }
            );
        };

    });
    </script>
    @endpush

</x-app-layout>