<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Panel — BearTrails</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,600;9..144,700;9..144,900&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        "primary": "#012d1d", "on-primary": "#ffffff",
                        "primary-container": "#1b4332", "on-primary-container": "#86af99",
                        "secondary": "#8e4e14", "secondary-container": "#ffab69",
                        "on-secondary-container": "#783d01",
                        "tertiary": "#002d1c", "tertiary-container": "#00452e",
                        "tertiary-fixed": "#b1f0ce", "tertiary-fixed-dim": "#95d4b3",
                        "on-tertiary-fixed-variant": "#0e5138",
                        "background": "#fff8f2", "surface": "#fff8f2",
                        "surface-container": "#f8ecdb",
                        "surface-container-low": "#fdf2e1",
                        "surface-container-high": "#f2e7d6",
                        "surface-container-highest": "#ece1d0",
                        "surface-container-lowest": "#ffffff",
                        "surface-variant": "#ece1d0",
                        "on-surface": "#201b11", "on-surface-variant": "#414844",
                        "outline": "#717973", "outline-variant": "#c1c8c2",
                        "error": "#ba1a1a", "error-container": "#ffdad6",
                        "primary-fixed": "#c1ecd4", "primary-fixed-dim": "#a5d0b9",
                        "on-primary-fixed": "#002114",
                    },
                    spacing: {
                        "xs": "4px", "sm": "8px", "md": "16px",
                        "lg": "24px", "xl": "40px", "xxl": "64px",
                    },
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        h1, h2, h3 { font-family: 'Fraunces', serif; }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>
<body class="bg-surface-container-low min-h-screen">

<div class="flex min-h-screen">

    {{-- Sidebar --}}
    <aside class="fixed left-0 top-0 h-full w-[250px] z-50 bg-primary text-white flex flex-col shadow-2xl border-r border-emerald-900/50">

        {{-- Logo --}}
        <div class="px-6 pt-8 pb-6 border-b border-white/10">
            <a href="{{ route('home') }}" class="text-2xl font-black tracking-wide text-white">BearTrails</a>
            <p class="text-tertiary-fixed text-xs font-bold mt-1 tracking-widest uppercase">Admin Panel</p>
        </div>

        {{-- Nav Links --}}
        <nav class="flex-1 py-6 flex flex-col gap-1 overflow-y-auto">
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-3 px-6 py-3 border-l-4 transition-all font-medium text-sm
                      {{ request()->routeIs('admin.dashboard') ? 'bg-white/10 border-tertiary-fixed text-white' : 'border-transparent text-gray-300 hover:bg-white/5 hover:text-white hover:border-white/30' }}">
                <span class="material-symbols-outlined text-[22px]">dashboard</span>
                Dashboard
            </a>
            
            <a href="{{ route('admin.users') }}"
               class="flex items-center gap-3 px-6 py-3 border-l-4 transition-all font-medium text-sm border-transparent text-gray-300 hover:bg-white/5 hover:text-white hover:border-white/30">
                <span class="material-symbols-outlined text-[22px]">group</span>
                Kelola User
            </a>

            <a href="{{ route('home') }}"
               class="flex items-center gap-3 px-6 py-3 border-l-4 transition-all font-medium text-sm border-transparent text-gray-300 hover:bg-white/5 hover:text-white hover:border-white/30">
                <span class="material-symbols-outlined text-[22px]">public</span>
                Lihat Website
            </a>
        </nav>

        {{-- Admin Profile + Logout --}}
        <div class="p-4 border-t border-white/10 flex items-center justify-between gap-3">
            <div class="flex items-center gap-3 min-w-0">
                <div class="w-10 h-10 rounded-full bg-tertiary-container border-2 border-tertiary-fixed flex items-center justify-center shrink-0">
                    <span class="material-symbols-outlined text-tertiary-fixed text-xl">admin_panel_settings</span>
                </div>
                <div class="min-w-0">
                    <p class="text-sm font-bold text-white leading-tight truncate">{{ auth()->user()->name }}</p>
                    <p class="text-[10px] text-gray-400 tracking-wide">Super Admin</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" title="Keluar" class="text-gray-400 hover:text-red-400 transition-colors shrink-0">
                    <span class="material-symbols-outlined">logout</span>
                </button>
            </form>
        </div>
    </aside>

    {{-- Main Content --}}
    <div class="ml-[250px] flex-1 flex flex-col min-h-screen">

        {{-- Top Bar --}}
        <header class="sticky top-0 bg-white border-b border-outline-variant z-40 flex items-center justify-between px-8 h-16 shadow-sm">
            <div>
                <h2 class="text-primary text-xl font-bold">Selamat datang, {{ auth()->user()->name }}! 👋</h2>
                <p class="text-xs text-outline">{{ now()->translatedFormat('d F Y') }}</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('destinations.create') }}"
                   class="flex items-center gap-2 px-5 py-2 bg-secondary text-white rounded-xl text-sm font-semibold hover:opacity-90 active:scale-95 transition-all shadow-sm">
                    <span class="material-symbols-outlined text-[20px]">add</span>
                    Tambah Destinasi
                </a>
                <button onclick="document.getElementById('modal-tambah-tg').classList.remove('hidden')"
                        class="flex items-center gap-2 px-5 py-2 bg-primary text-white rounded-xl text-sm font-semibold hover:opacity-90 active:scale-95 transition-all shadow-sm">
                    <span class="material-symbols-outlined text-[20px]">person_add</span>
                    Tambah Tour Guide
                </button>
            </div>
        </header>

        {{-- Alerts --}}
        @if(session('success'))
        <div class="mx-8 mt-6 px-6 py-3 bg-tertiary-fixed text-on-tertiary-fixed-variant rounded-xl flex items-center gap-2 text-sm font-semibold shadow-sm">
            <span class="material-symbols-outlined text-[20px]">check_circle</span>
            {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div class="mx-8 mt-6 px-6 py-3 bg-error-container text-on-error-container rounded-xl flex items-center gap-2 text-sm font-semibold shadow-sm">
            <span class="material-symbols-outlined text-[20px]">error</span>
            {{ session('error') }}
        </div>
        @endif

        <main class="flex-1 p-8 space-y-8 max-w-[1280px]">

            {{-- Stats Cards --}}
            <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white rounded-xl shadow-sm border-l-4 border-[#10B981] p-5 flex items-center gap-4 hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 rounded-full bg-[#10B981]/10 flex items-center justify-center">
                        <span class="material-symbols-outlined text-[#10B981]">landscape</span>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-outline uppercase tracking-wider mb-1">Total Destinasi</p>
                        <p class="text-3xl font-bold text-on-surface leading-none">{{ $stats['total_destinations'] }}</p>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border-l-4 border-primary p-5 flex items-center gap-4 hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center">
                        <span class="material-symbols-outlined text-primary">group</span>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-outline uppercase tracking-wider mb-1">Total User</p>
                        <p class="text-3xl font-bold text-on-surface leading-none">{{ number_format($stats['total_users']) }}</p>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border-l-4 border-secondary p-5 flex items-center gap-4 hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 rounded-full bg-secondary/10 flex items-center justify-center">
                        <span class="material-symbols-outlined text-secondary">tour</span>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-outline uppercase tracking-wider mb-1">Tour Guide Aktif</p>
                        <p class="text-3xl font-bold text-on-surface leading-none">{{ $stats['total_tourguides'] }}</p>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border-l-4 border-tertiary-fixed p-5 flex items-center gap-4 hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 rounded-full bg-tertiary-fixed/30 flex items-center justify-center">
                        <span class="material-symbols-outlined text-on-tertiary-fixed-variant">reviews</span>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-outline uppercase tracking-wider mb-1">Total Review</p>
                        <p class="text-3xl font-bold text-on-surface leading-none">{{ number_format($stats['total_reviews']) }}</p>
                    </div>
                </div>
            </section>

            {{-- Tabel Destinasi & Tour Guide --}}
            <section class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                {{-- Destinasi --}}
                <div class="bg-white rounded-xl shadow-sm overflow-hidden flex flex-col">
                    <div class="p-6 flex justify-between items-center border-b border-gray-100">
                        <h3 class="font-bold text-lg text-on-surface">Destinasi Terbaru</h3>
                        <a href="{{ route('destinations.create') }}" class="flex items-center gap-1.5 bg-secondary text-white px-4 py-2 rounded-lg text-sm font-semibold hover:opacity-90 transition-all shadow-sm">
                            <span class="material-symbols-outlined text-[18px]">add</span>
                            Tambah
                        </a>
                    </div>
                    <div class="overflow-x-auto flex-1">
                        <table class="w-full text-left text-sm">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th class="px-4 py-3 font-semibold">Foto</th>
                                    <th class="px-4 py-3 font-semibold">Nama</th>
                                    <th class="px-4 py-3 font-semibold">Kategori</th>
                                    <th class="px-4 py-3 font-semibold text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($destinations as $destination)
                                <tr class="bg-white hover:bg-surface-container-low transition-colors">
                                    <td class="px-4 py-3">
                                        @if($destination->image)
                                            <img src="{{ asset('storage/'.$destination->image) }}" class="w-10 h-10 rounded-lg object-cover">
                                        @else
                                            <div class="w-10 h-10 bg-surface-container rounded-lg flex items-center justify-center">
                                                <span class="material-symbols-outlined text-outline text-[18px]">landscape</span>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 font-medium text-on-surface max-w-[120px] truncate">{{ $destination->name }}</td>
                                    <td class="px-4 py-3">
                                        @php
                                            $catColors = ['Pantai' => 'bg-blue-100 text-blue-800', 'Gunung' => 'bg-green-100 text-green-800', 'Budaya' => 'bg-orange-100 text-orange-800', 'Kuliner' => 'bg-yellow-100 text-yellow-800', 'Alam' => 'bg-emerald-100 text-emerald-800'];
                                            $colorClass = $catColors[$destination->category] ?? 'bg-gray-100 text-gray-700';
                                        @endphp
                                        <span class="px-2 py-1 rounded text-xs font-bold {{ $colorClass }}">{{ $destination->category }}</span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex justify-center gap-2">
                                            <a href="{{ route('destinations.edit', $destination) }}"
                                               class="border border-blue-500 text-blue-500 rounded p-1 hover:bg-blue-500 hover:text-white transition"
                                               title="Edit">
                                                <span class="material-symbols-outlined text-[16px]">edit</span>
                                            </a>
                                            <a href="{{ route('destinations.show', $destination) }}"
                                               class="border border-[#10B981] text-[#10B981] rounded p-1 hover:bg-[#10B981] hover:text-white transition"
                                               title="Lihat">
                                                <span class="material-symbols-outlined text-[16px]">visibility</span>
                                            </a>
                                            <form action="{{ route('destinations.destroy', $destination) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="border border-error text-error rounded p-1 hover:bg-error hover:text-white transition">
                                                    <span class="material-symbols-outlined text-[16px]">delete</span>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-8 text-center text-on-surface-variant">
                                        <span class="material-symbols-outlined text-4xl text-outline block mb-2">landscape</span>
                                        Belum ada destinasi.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Tour Guide --}}
                <div class="bg-white rounded-xl shadow-sm overflow-hidden flex flex-col">
                    <div class="p-6 flex justify-between items-center border-b border-gray-100">
                        <h3 class="font-bold text-lg text-on-surface">Tour Guide</h3>
                        <button onclick="document.getElementById('modal-tambah-tg').classList.remove('hidden')"
                                class="flex items-center gap-1.5 bg-primary text-white px-4 py-2 rounded-lg text-sm font-semibold hover:opacity-90 transition-all shadow-sm">
                            <span class="material-symbols-outlined text-[18px]">person_add</span>
                            Tambah
                        </button>
                    </div>
                    <div class="overflow-x-auto flex-1">
                        <table class="w-full text-left text-sm">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th class="px-4 py-3 font-semibold">Foto</th>
                                    <th class="px-4 py-3 font-semibold">Nama</th>
                                    <th class="px-4 py-3 font-semibold">Wilayah</th>
                                    <th class="px-4 py-3 font-semibold text-center">Status</th>
                                    <th class="px-4 py-3 font-semibold text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($tourguides as $tg)
                                <tr class="bg-white hover:bg-surface-container-low transition-colors">
                                    <td class="px-4 py-3">
                                        @if($tg->photo)
                                            <img src="{{ asset('storage/'.$tg->photo) }}" class="w-9 h-9 rounded-full object-cover border-2 border-outline-variant">
                                        @else
                                            <div class="w-9 h-9 rounded-full bg-primary-container flex items-center justify-center border-2 border-outline-variant">
                                                <span class="material-symbols-outlined text-on-primary-container text-[18px]">person</span>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 font-medium text-on-surface max-w-[110px] truncate">{{ $tg->user->name }}</td>
                                    <td class="px-4 py-3 text-on-surface-variant text-xs max-w-[100px] truncate">{{ $tg->location }}</td>
                                    <td class="px-4 py-3 text-center">
                                        <span class="{{ $tg->status === 'active' ? 'bg-tertiary-fixed text-on-tertiary-fixed-variant' : 'bg-outline-variant text-on-surface-variant' }} px-2 py-1 rounded text-[10px] font-bold">
                                            {{ $tg->status === 'active' ? 'AKTIF' : 'NONAKTIF' }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <div class="flex justify-center gap-1">
                                            <form action="{{ route('admin.tourguide.toggle', $tg->user) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                        class="text-[10px] font-bold px-3 py-1 rounded border transition-all
                                                               {{ $tg->status === 'active' ? 'border-orange-400 text-orange-500 hover:bg-orange-500 hover:text-white' : 'border-green-500 text-green-600 hover:bg-green-500 hover:text-white' }}">
                                                    {{ $tg->status === 'active' ? 'Nonaktifkan' : 'Aktifkan' }}
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.tourguide.destroy', $tg->user) }}" method="POST" onsubmit="return confirm('Hapus tour guide ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="border border-error text-error rounded p-1.5 hover:bg-error hover:text-white transition">
                                                    <span class="material-symbols-outlined text-[14px]">delete</span>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-8 text-center text-on-surface-variant">
                                        <span class="material-symbols-outlined text-4xl text-outline block mb-2">tour</span>
                                        Belum ada tour guide.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

            {{-- Review Terbaru --}}
            <section class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                    <h3 class="font-bold text-lg text-on-surface">Review Terbaru</h3>
                    <span class="text-xs text-outline">{{ $recentReviews->count() }} terbaru</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-primary text-white whitespace-nowrap">
                            <tr>
                                <th class="px-6 py-4 font-semibold">User</th>
                                <th class="px-6 py-4 font-semibold">Destinasi</th>
                                <th class="px-6 py-4 font-semibold">Rating</th>
                                <th class="px-6 py-4 font-semibold">Komentar</th>
                                <th class="px-6 py-4 font-semibold">Tanggal</th>
                                <th class="px-6 py-4 font-semibold text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($recentReviews as $review)
                            <tr class="{{ $loop->even ? 'bg-surface-container-low/40' : 'bg-white' }} hover:bg-surface-container-low transition-colors">
                                <td class="px-6 py-4 font-medium text-on-surface whitespace-nowrap">{{ $review->user->name ?? '—' }}</td>
                                <td class="px-6 py-4 text-on-surface-variant whitespace-nowrap max-w-[140px] truncate">{{ $review->destination->name ?? '—' }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-0.5">
                                        @for($i = 1; $i <= 5; $i++)
                                        <span class="material-symbols-outlined text-secondary text-[16px]" style="font-variation-settings:'FILL' {{ $i <= $review->rating ? 1 : 0 }},'wght' 400,'GRAD' 0,'opsz' 24">star</span>
                                        @endfor
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-on-surface-variant italic max-w-xs truncate">"{{ $review->comment }}"</td>
                                <td class="px-6 py-4 text-outline text-xs whitespace-nowrap">{{ $review->created_at->translatedFormat('d M Y') }}</td>
                                <td class="px-6 py-4 text-center">
                                    <form action="{{ route('reviews.destroy', $review) }}" method="POST" onsubmit="return confirm('Hapus review ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="border border-error text-error rounded p-1 hover:bg-error hover:text-white transition">
                                            <span class="material-symbols-outlined text-[16px]">delete</span>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-on-surface-variant">
                                    <span class="material-symbols-outlined text-5xl text-outline block mb-3">reviews</span>
                                    Belum ada review.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>

        </main>
    </div>
</div>

{{-- Modal Tambah Tour Guide --}}
<div id="modal-tambah-tg" class="hidden fixed inset-0 bg-black/50 z-[100] flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-8">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl font-bold text-primary">Tambah Akun Tour Guide</h3>
            <button onclick="document.getElementById('modal-tambah-tg').classList.add('hidden')" class="text-outline hover:text-error transition-colors">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>

        <form method="POST" action="{{ route('admin.tourguide.store') }}" class="space-y-6">
            @csrf
            <div>
                <label class="block text-sm font-semibold text-on-surface mb-1">Nama Lengkap</label>
                <input type="text" name="name" required
                       class="w-full border border-outline-variant rounded-xl px-4 py-2.5 text-sm focus:ring-1 focus:ring-primary outline-none"
                       placeholder="Nama tour guide"/>
            </div>
            <div>
                <label class="block text-sm font-semibold text-on-surface mb-1">Email</label>
                <input type="email" name="email" required
                       class="w-full border border-outline-variant rounded-xl px-4 py-2.5 text-sm focus:ring-1 focus:ring-primary outline-none"
                       placeholder="email@beartrails.com"/>
            </div>
            <div>
                <label class="block text-sm font-semibold text-on-surface mb-1">Password</label>
                <input type="password" name="password" required minlength="8"
                       class="w-full border border-outline-variant rounded-xl px-4 py-2.5 text-sm focus:ring-1 focus:ring-primary outline-none"
                       placeholder="Minimal 8 karakter"/>
            </div>
            <div>
                <label class="block text-sm font-semibold text-on-surface mb-1">Lokasi / Wilayah</label>
                <input type="text" name="location" required
                       class="w-full border border-outline-variant rounded-xl px-4 py-2.5 text-sm focus:ring-1 focus:ring-primary outline-none"
                       placeholder="contoh: Lombok, NTB"/>
            </div>
            <div>
                <label class="block text-sm font-semibold text-on-surface mb-1">Harga Per Hari (Rp)</label>
                <input type="number" name="price_per_day" required min="0"
                       class="w-full border border-outline-variant rounded-xl px-4 py-2.5 text-sm focus:ring-1 focus:ring-primary outline-none"
                       placeholder="contoh: 500000"/>
            </div>
            <div class="flex gap-3 pt-2">
                <button type="button"
                        onclick="document.getElementById('modal-tambah-tg').classList.add('hidden')"
                        class="flex-1 py-3 border border-outline-variant text-on-surface-variant rounded-xl text-sm font-semibold hover:bg-surface-container transition-all">
                    Batal
                </button>
                <button type="submit"
                        class="flex-1 py-3 bg-primary text-white rounded-xl text-sm font-semibold hover:opacity-90 transition-all">
                    Buat Akun
                </button>
            </div>
        </form>
    </div>
</div>

</body>
</html>