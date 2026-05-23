<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>BearTrails — {{ config('app.name', 'BearTrails') }}</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,600;9..144,700;9..144,900&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.css"/>
    <script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.js"></script>
    <script id="tailwind-config">
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        "primary": "#012d1d",
                        "on-primary": "#ffffff",
                        "primary-container": "#1b4332",
                        "on-primary-container": "#86af99",
                        "secondary": "#8e4e14",
                        "on-secondary": "#ffffff",
                        "secondary-container": "#ffab69",
                        "on-secondary-fixed": "#2f1400",
                        "on-secondary-fixed-variant": "#6f3800",
                        "tertiary": "#002d1c",
                        "tertiary-container": "#00452e",
                        "on-tertiary-container": "#75b393",
                        "tertiary-fixed": "#b1f0ce",
                        "tertiary-fixed-dim": "#95d4b3",
                        "on-tertiary-fixed-variant": "#0e5138",
                        "background": "#fff8f2",
                        "surface": "#fff8f2",
                        "surface-dim": "#e3d9c8",
                        "surface-container": "#f8ecdb",
                        "surface-container-low": "#fdf2e1",
                        "surface-container-high": "#f2e7d6",
                        "surface-container-highest": "#ece1d0",
                        "surface-container-lowest": "#ffffff",
                        "surface-variant": "#ece1d0",
                        "on-surface": "#201b11",
                        "on-surface-variant": "#414844",
                        "outline": "#717973",
                        "outline-variant": "#c1c8c2",
                        "primary-fixed": "#c1ecd4",
                        "primary-fixed-dim": "#a5d0b9",
                        "on-primary-fixed": "#002114",
                        "error": "#ba1a1a",
                    },
                    fontFamily: {
                        "display": ["Fraunces", "serif"],
                        "body": ["Plus Jakarta Sans", "sans-serif"],
                    },
                    fontSize: {
                        "hero-display": ["48px", {"lineHeight": "1.2", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                        "h1": ["36px", {"lineHeight": "1.3", "fontWeight": "700"}],
                        "h2": ["28px", {"lineHeight": "1.4", "fontWeight": "600"}],
                        "h3": ["20px", {"lineHeight": "1.5", "fontWeight": "700"}],
                        "body-lg": ["18px", {"lineHeight": "1.6"}],
                        "body-md": ["16px", {"lineHeight": "1.6"}],
                        "label-md": ["14px", {"lineHeight": "1", "letterSpacing": "0.01em", "fontWeight": "600"}],
                        "caption": ["12px", {"lineHeight": "1.4", "fontWeight": "500"}],
                    },
                    spacing: {
                        "xs": "4px", "sm": "8px", "md": "16px",
                        "lg": "24px", "xl": "40px", "xxl": "64px",
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem", "lg": "0.5rem",
                        "xl": "0.75rem", "full": "9999px"
                    },
                }
            }
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .emerald-shadow:hover {
            box-shadow: 0px 10px 20px rgba(45, 106, 79, 0.15);
        }
        .leaflet-pane,
        .leaflet-top,
        .leaflet-bottom {
            z-index: 10 !important;
        }
        .site-navbar {
            z-index: 50;
        }
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
    @stack('styles')
</head>
<body class="bg-background text-on-surface">

<header class="bg-[#1B4332] text-white fixed top-0 w-full z-50 shadow-lg border-b border-emerald-900/50">
    <div class="flex justify-between items-center px-6 py-4 max-w-7xl mx-auto">
        <a href="{{ route('home') }}" class="text-2xl font-black tracking-tighter text-white">BearTrails</a>

        {{-- Desktop Nav --}}
        <nav class="hidden md:flex items-center gap-lg">
            <a href="{{ route('home') }}"
               class="{{ request()->routeIs('home') ? 'text-[#D8F3DC] border-b-2 border-[#D8F3DC]' : 'text-white/80 hover:text-[#D8F3DC]' }} pb-1 transition-colors text-sm font-medium">
                Home
            </a>
            <a href="{{ route('destinations.index') }}"
               class="{{ request()->routeIs('destinations*') ? 'text-[#D8F3DC] border-b-2 border-[#D8F3DC]' : 'text-white/80 hover:text-[#D8F3DC]' }} pb-1 transition-colors text-sm font-medium">
                Destinasi
            </a>
            <a href="{{ route('tourguides.index') }}"
               class="{{ request()->routeIs('tourguides*') ? 'text-[#D8F3DC] border-b-2 border-[#D8F3DC]' : 'text-white/80 hover:text-[#D8F3DC]' }} pb-1 transition-colors text-sm font-medium">
                Tour Guide
            </a>
            <a href="{{ route('explore') }}"
               class="{{ request()->routeIs('explore') ? 'text-[#D8F3DC] border-b-2 border-[#D8F3DC]' : 'text-white/80 hover:text-[#D8F3DC]' }} pb-1 transition-colors text-sm font-medium">
                Explore
            </a>
            <a href="{{ route('about') }}"
               class="{{ request()->routeIs('about') ? 'text-[#D8F3DC] border-b-2 border-[#D8F3DC]' : 'text-white/80 hover:text-[#D8F3DC]' }} pb-1 transition-colors text-sm font-medium">
                About
            </a>
        </nav>

        {{-- Desktop Right --}}
        <div class="hidden md:flex items-center gap-md">
            @auth
                <div class="relative" id="user-menu">
                    <button onclick="toggleMenu()" class="flex items-center gap-sm text-white/80 hover:text-white transition-colors">
                        <span class="material-symbols-outlined">account_circle</span>
                        <span class="text-sm font-medium hidden md:inline">{{ auth()->user()->name }}</span>
                        <span class="material-symbols-outlined text-sm">expand_more</span>
                    </button>
                    <div id="dropdown-menu" class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-outline-variant hidden z-50">
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="block px-md py-sm text-sm text-on-surface hover:bg-surface-container-low rounded-t-xl">Admin Panel</a>
                        @elseif(auth()->user()->role === 'tourguide')
                            <a href="{{ route('tourguide.dashboard') }}" class="block px-md py-sm text-sm text-on-surface hover:bg-surface-container-low rounded-t-xl">Dashboard</a>
                        @else
                            <a href="{{ route('profile.edit') }}" class="block px-md py-sm text-sm text-on-surface hover:bg-surface-container-low rounded-t-xl">Profil Saya</a>
                            <a href="{{ route('favorites.index') }}" class="block px-md py-sm text-sm text-on-surface hover:bg-surface-container-low">Favorit</a>
                        @endif
                        <hr class="border-outline-variant">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-md py-sm text-sm text-error hover:bg-surface-container-low rounded-b-xl">
                                Keluar
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="text-white/80 hover:text-white text-sm font-medium transition-colors">Masuk</a>
                <a href="{{ route('register') }}" class="bg-secondary text-white font-bold px-lg py-sm rounded-lg hover:opacity-90 transition-all text-sm">Daftar</a>
            @endauth
        </div>

    </div>
</header>

{{-- Main Content --}}
<main>
    {{ $slot }}
</main>

{{-- Footer --}}
<footer class="bg-slate-900 w-full py-16 border-t border-slate-800">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-12 max-w-7xl mx-auto px-6 md:px-12">
        <div class="md:col-span-1">
            <div class="text-lg font-black text-white mb-md">BearTrails</div>
            <p class="text-slate-400 text-sm leading-relaxed mb-lg">© 2025 BearTrails. Menjelajahi keindahan Indonesia dengan bijak.</p>
        </div>
        <div>
            <h4 class="text-emerald-400 font-semibold mb-lg text-sm">Destinasi</h4>
            <ul class="space-y-sm">
                <li><a href="{{ route('destinations.index') }}" class="text-slate-400 hover:text-emerald-400 text-sm transition-colors">Semua Destinasi</a></li>
            </ul>
        </div>
        <div>
            <h4 class="text-emerald-400 font-semibold mb-lg text-sm">Perusahaan</h4>
            <ul class="space-y-sm">
                <li><a href="{{ route('about') }}" class="text-slate-400 hover:text-emerald-400 text-sm transition-colors">Tentang Kami</a></li>
            </ul>
        </div>
        <div>
            <h4 class="text-emerald-400 font-semibold mb-lg text-sm">Tim We Bare Bears</h4>
            <ul class="space-y-sm">
                <li class="text-emerald-400 text-sm font-medium">Rival — Grizzly 🐻</li>
                <li class="text-emerald-400 text-sm font-medium">Fatio — Panda 🐼</li>
                <li class="text-emerald-400 text-sm font-medium">Alif — Ice Bear 🐻‍❄️</li>
            </ul>
        </div>
    </div>
</footer>

<script>
function toggleMenu() {
    document.getElementById('dropdown-menu').classList.toggle('hidden');
}

// Tutup dropdown kalau klik di luar
document.addEventListener('click', function(e) {
    const userMenu = document.getElementById('user-menu');
    const dropdownMenu = document.getElementById('dropdown-menu');
    if (userMenu && dropdownMenu && !userMenu.contains(e.target)) {
        dropdownMenu.classList.add('hidden');
    }
});
</script>

@stack('scripts')
</body>
</html>