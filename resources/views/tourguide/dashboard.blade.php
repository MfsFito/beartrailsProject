<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard Tour Guide — BearTrails</title>
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
                        "surface-container": "#f8ecdb", "surface-container-low": "#fdf2e1",
                        "surface-container-high": "#f2e7d6",
                        "surface-container-highest": "#ece1d0",
                        "surface-container-lowest": "#ffffff",
                        "surface-variant": "#ece1d0", "on-surface": "#201b11",
                        "on-surface-variant": "#414844", "outline": "#717973",
                        "outline-variant": "#c1c8c2", "error": "#ba1a1a",
                        "error-container": "#ffdad6", "on-error-container": "#93000a",
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
<body class="bg-surface-container min-h-screen">

<div class="flex min-h-screen">

    {{-- Sidebar --}}
    <aside class="fixed left-0 top-0 h-full w-64 z-50 bg-primary-container border-r border-emerald-900 shadow-2xl flex flex-col py-6 overflow-y-auto">

        {{-- Logo --}}
        <div class="px-6 mb-6">
            <a href="{{ route('home') }}" class="text-xl font-black text-white tracking-tighter">BearTrails</a>
            <p class="text-emerald-300/60 text-xs mt-1">Tour Guide Portal</p>
        </div>

        {{-- Avatar + Nama --}}
        <div class="px-6 mb-8 flex flex-col items-center text-center">
            <div class="w-14 h-14 rounded-full border-2 border-tertiary-fixed mb-3 overflow-hidden">
                @if($profile && $profile->photo)
                    <img src="{{ asset('storage/'.$profile->photo) }}" alt="{{ auth()->user()->name }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full bg-tertiary-container flex items-center justify-center">
                        <span class="material-symbols-outlined text-tertiary-fixed text-3xl">person</span>
                    </div>
                @endif
            </div>
            <h2 class="text-white font-bold text-base leading-tight">{{ auth()->user()->name }}</h2>
            <span class="bg-tertiary-container text-tertiary-fixed text-[10px] px-3 py-1 rounded-full uppercase tracking-widest font-bold mt-2">Tour Guide</span>
        </div>

        {{-- Nav Links --}}
        <nav class="flex-1 space-y-1 px-2">
            <a href="{{ route('tourguide.dashboard') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all {{ request()->routeIs('tourguide.dashboard') ? 'bg-[#2D6A4F] text-white border-l-4 border-tertiary-fixed' : 'text-emerald-100/70 hover:text-white hover:bg-white/5' }}">
                <span class="material-symbols-outlined">dashboard</span>
                <span class="text-sm font-semibold">Dashboard</span>
            </a>
            <a href="{{ route('tourguide.profile.edit') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all text-emerald-100/70 hover:text-white hover:bg-white/5">
                <span class="material-symbols-outlined">manage_accounts</span>
                <span class="text-sm font-semibold">Edit Profil</span>
            </a>
            <a href="{{ route('home') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all text-emerald-100/70 hover:text-white hover:bg-white/5">
                <span class="material-symbols-outlined">public</span>
                <span class="text-sm font-semibold">Lihat Website</span>
            </a>
        </nav>

        {{-- Logout --}}
        <div class="px-2 mt-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg transition-all text-red-400/80 hover:text-red-400 hover:bg-red-500/10">
                    <span class="material-symbols-outlined">logout</span>
                    <span class="text-sm font-semibold">Keluar</span>
                </button>
            </form>
        </div>
    </aside>

    {{-- Main Content --}}
    <div class="ml-64 flex-1 flex flex-col min-h-screen">

        {{-- Alert --}}
        @if(session('success'))
        <div class="mx-lg mt-lg px-lg py-sm bg-tertiary-fixed text-on-tertiary-fixed-variant rounded-xl flex items-center gap-2 text-sm font-semibold shadow-sm">
            <span class="material-symbols-outlined text-[20px]">check_circle</span>
            {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div class="mx-lg mt-lg px-lg py-sm bg-error-container text-on-error-container rounded-xl flex items-center gap-2 text-sm font-semibold shadow-sm">
            <span class="material-symbols-outlined text-[20px]">error</span>
            {{ session('error') }}
        </div>
        @endif

        {{-- Jika profil belum dibuat --}}
        @if(!$profile)
        <div class="flex-1 flex items-center justify-center p-xl">
            <div class="text-center space-y-4">
                <span class="material-symbols-outlined text-6xl text-outline">person_add</span>
                <h2 class="text-2xl font-bold text-on-surface">Lengkapi Profil Tour Guide-mu</h2>
                <p class="text-on-surface-variant max-w-sm mx-auto">Profil kamu belum diisi. Mulai lengkapi agar wisatawan bisa menemukanmu!</p>
                <a href="{{ route('tourguide.profile.edit') }}" class="inline-flex items-center gap-2 px-8 py-3 bg-primary text-white rounded-xl text-sm font-semibold hover:opacity-90 transition-all">
                    <span class="material-symbols-outlined">edit</span>
                    Buat Profil Sekarang
                </a>
            </div>
        </div>

        @else
        <main class="flex-1 p-lg space-y-xl max-w-5xl">

            {{-- Header --}}
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-on-surface">Selamat Datang, {{ auth()->user()->name }}! 👋</h1>
                    <p class="text-on-surface-variant text-sm mt-1">{{ now()->translatedFormat('l, d F Y') }}</p>
                </div>
            </div>

            {{-- Stats Cards --}}
            <section class="grid grid-cols-1 md:grid-cols-2 gap-lg">
                <div class="bg-surface-container-lowest p-lg rounded-xl shadow-sm border-l-4 border-primary-container hover:shadow-md transition-shadow">
                    <p class="text-on-surface-variant text-xs font-semibold uppercase tracking-wider mb-2">Jadwal Aktif</p>
                    <div class="flex items-baseline gap-2">
                        <span class="text-primary text-4xl font-bold">{{ $stats['jadwal_aktif'] }}</span>
                        <span class="text-on-surface-variant text-xs">tanggal tersedia</span>
                    </div>
                </div>
                <div class="bg-surface-container-lowest p-lg rounded-xl shadow-sm border-l-4 border-secondary-container hover:shadow-md transition-shadow">
                    <p class="text-on-surface-variant text-xs font-semibold uppercase tracking-wider mb-2">Post Portofolio</p>
                    <div class="flex items-baseline gap-2">
                        <span class="text-primary text-4xl font-bold">{{ $stats['post_portofolio'] }}</span>
                        <span class="text-on-surface-variant text-xs">cerita</span>
                    </div>
                </div>
            </section>

            {{-- Kelola Jadwal --}}
            <section class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden">
                <div class="p-lg flex justify-between items-center border-b border-surface-variant">
                    <h2 class="text-xl font-bold text-primary">Jadwal Ketersediaan</h2>
                </div>
                <div class="p-lg space-y-lg">
                    @if($availabilities->isEmpty())
                    <div class="text-center py-xl text-on-surface-variant">
                        <span class="material-symbols-outlined text-5xl text-outline block mb-3">event_busy</span>
                        <p>Belum ada jadwal. Tambahkan tanggal kamu tersedia di bawah.</p>
                    </div>
                    @else
                    <div class="overflow-x-auto rounded-xl border border-outline-variant">
                        <table class="w-full text-left">
                            <thead class="bg-surface-container-high">
                                <tr>
                                    <th class="py-4 px-6 text-xs font-semibold text-on-surface-variant uppercase">Tanggal</th>
                                    <th class="py-4 px-6 text-xs font-semibold text-on-surface-variant uppercase">Hari</th>
                                    <th class="py-4 px-6 text-xs font-semibold text-on-surface-variant uppercase">Status</th>
                                    <th class="py-4 px-6 text-xs font-semibold text-on-surface-variant uppercase text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-outline-variant">
                                @foreach($availabilities as $availability)
                                <tr class="hover:bg-surface-container-low transition-colors">
                                    <td class="py-4 px-6 text-sm text-on-surface font-medium">
                                        {{ \Carbon\Carbon::parse($availability->available_date)->translatedFormat('d F Y') }}
                                    </td>
                                    <td class="py-4 px-6 text-sm text-on-surface-variant">
                                        {{ \Carbon\Carbon::parse($availability->available_date)->translatedFormat('l') }}
                                    </td>
                                    <td class="py-4 px-6">
                                        <span class="px-3 py-1 {{ $availability->status === 'available' ? 'bg-tertiary-fixed text-on-tertiary-fixed-variant' : 'bg-outline-variant text-on-surface-variant' }} rounded-full text-xs font-bold">
                                            {{ $availability->status === 'available' ? 'Tersedia' : 'Terisi' }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6 text-right">
                                        <form action="{{ route('tourguide.availability.destroy', $availability) }}" method="POST" onsubmit="return confirm('Hapus jadwal ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="flex items-center gap-1 ml-auto text-error text-xs hover:bg-error-container/20 px-3 py-1 rounded-lg transition-colors">
                                                <span class="material-symbols-outlined text-[18px]">delete</span>
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif

                    {{-- Form Tambah Jadwal --}}
                    <div class="p-lg bg-surface-container-low rounded-xl border border-surface-variant/50">
                        <h3 class="font-bold text-lg text-primary mb-md">Tambah Tanggal Tersedia</h3>
                        <form action="{{ route('tourguide.availability.store') }}" method="POST" class="flex flex-col sm:flex-row gap-md items-end">
                            @csrf
                            <div class="flex-1 space-y-sm">
                                <label class="text-on-surface text-sm font-semibold block">Pilih Tanggal</label>
                                <input type="date" name="available_date" min="{{ now()->toDateString() }}"
                                       class="w-full rounded-xl border-outline-variant bg-white focus:border-primary focus:ring-primary text-sm" required>
                                @error('available_date')
                                <p class="text-error text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit" class="flex items-center gap-2 px-6 py-3 bg-secondary-container text-on-secondary-container text-sm font-semibold rounded-xl hover:brightness-95 transition-all shadow-sm whitespace-nowrap">
                                <span class="material-symbols-outlined text-[20px]">add_circle</span>
                                Tambah Jadwal
                            </button>
                        </form>
                    </div>
                </div>
            </section>

            {{-- Kelola Portofolio --}}
            <section class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden">
                <div class="p-lg border-b border-surface-variant">
                    <h2 class="text-xl font-bold text-primary">Portofolio</h2>
                </div>
                <div class="p-lg space-y-lg">
                    @if($portfolios->isEmpty())
                    <div class="text-center py-xl text-on-surface-variant">
                        <span class="material-symbols-outlined text-5xl text-outline block mb-3">photo_library</span>
                        <p>Belum ada portofolio. Tambahkan cerita perjalananmu!</p>
                    </div>
                    @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-lg">
                        @foreach($portfolios as $portfolio)
                        <div class="bg-surface-container rounded-xl overflow-hidden border border-outline-variant/30 group hover:-translate-y-1 hover:shadow-md transition-all duration-300">
                            <div class="h-[140px] overflow-hidden">
                                @if($portfolio->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($portfolio->image))
                                    <img src="{{ asset('storage/'.$portfolio->image) }}" alt="{{ $portfolio->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full bg-surface-container-high flex items-center justify-center">
                                        <span class="material-symbols-outlined text-4xl text-outline">image</span>
                                    </div>
                                @endif
                            </div>
                            <div class="p-md">
                                @if($portfolio->title)
                                <p class="font-bold text-on-surface text-sm leading-tight line-clamp-1">{{ $portfolio->title }}</p>
                                @endif
                                @if($portfolio->description)
                                <p class="text-xs text-outline mt-1 line-clamp-2">{{ $portfolio->description }}</p>
                                @endif
                                <form action="{{ route('tourguide.portfolio.destroy', $portfolio) }}" method="POST" class="mt-sm" onsubmit="return confirm('Hapus portofolio ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-error text-xs flex items-center gap-1 hover:bg-error-container/20 px-2 py-1 rounded-lg transition-colors">
                                        <span class="material-symbols-outlined text-[16px]">delete</span>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif

                    {{-- Form Upload --}}
                    <div class="p-lg bg-surface-container-low rounded-xl border border-surface-variant/50">
                        <h3 class="font-bold text-lg text-primary mb-md">Upload Cerita Baru</h3>
                        <form action="{{ route('tourguide.portfolio.store') }}" method="POST" enctype="multipart/form-data" class="space-y-md">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-md">
                                <div class="space-y-sm">
                                    <label class="text-on-surface text-sm font-semibold block">Judul Cerita</label>
                                    <input type="text" name="title" placeholder="Contoh: Menjemput Matahari di Ijen" value="{{ old('title') }}"
                                           class="w-full rounded-xl border-outline-variant bg-white focus:border-primary focus:ring-primary text-sm" required>
                                    @error('title')
                                    <p class="text-error text-xs">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="space-y-sm">
                                    <label class="text-on-surface text-sm font-semibold block">Foto (bisa pilih beberapa)</label>
                                    <input type="file" name="images[]" accept="image/*" multiple
                                           class="w-full rounded-xl border border-outline-variant bg-white text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white hover:file:opacity-90" required>
                                    @error('images')
                                    <p class="text-error text-xs">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="md:col-span-2 space-y-sm">
                                    <label class="text-on-surface text-sm font-semibold block">Deskripsi (opsional)</label>
                                    <textarea name="description" rows="3" placeholder="Ceritakan pengalamanmu..."
                                              class="w-full rounded-xl border-outline-variant bg-white focus:border-primary focus:ring-primary text-sm placeholder:text-outline-variant resize-none">{{ old('description') }}</textarea>
                                </div>
                            </div>
                            <button type="submit" class="flex items-center gap-2 px-8 py-3 bg-primary text-white text-sm font-semibold rounded-xl hover:opacity-90 transition-all shadow-md">
                                <span class="material-symbols-outlined text-[20px]">upload</span>
                                Upload Portofolio
                            </button>
                        </form>
                    </div>
                </div>
            </section>

        </main>
        @endif

    </div>
</div>

</body>
</html>