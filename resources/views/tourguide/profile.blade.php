<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edit Profil — BearTrails Tour Guide</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,600;9..144,700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet"/>
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
                        "surface-container-lowest": "#ffffff",
                        "surface-variant": "#ece1d0",
                        "on-surface": "#201b11", "on-surface-variant": "#414844",
                        "outline": "#717973", "outline-variant": "#c1c8c2",
                        "error": "#ba1a1a", "error-container": "#ffdad6",
                        "primary-fixed": "#c1ecd4",
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
        <div class="px-6 mb-6">
            <a href="{{ route('home') }}" class="text-xl font-black text-white tracking-tighter">BearTrails</a>
            <p class="text-emerald-300/60 text-xs mt-1">Tour Guide Portal</p>
        </div>

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

        <nav class="flex-1 space-y-1 px-2">
            <a href="{{ route('tourguide.dashboard') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all text-emerald-100/70 hover:text-white hover:bg-white/5">
                <span class="material-symbols-outlined">dashboard</span>
                <span class="text-sm font-semibold">Dashboard</span>
            </a>
            <a href="{{ route('tourguide.profile.edit') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all bg-[#2D6A4F] text-white border-l-4 border-tertiary-fixed">
                <span class="material-symbols-outlined">manage_accounts</span>
                <span class="text-sm font-semibold">Edit Profil</span>
            </a>
            <a href="{{ route('home') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all text-emerald-100/70 hover:text-white hover:bg-white/5">
                <span class="material-symbols-outlined">public</span>
                <span class="text-sm font-semibold">Lihat Website</span>
            </a>
        </nav>

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

        <main class="flex-1 p-lg space-y-xl max-w-3xl">

            {{-- Header --}}
            <div>
                <h1 class="text-2xl font-bold text-on-surface">Edit Profil Tour Guide</h1>
                <p class="text-on-surface-variant text-sm mt-1">Lengkapi profilmu agar wisatawan bisa menemukanmu</p>
            </div>

            {{-- Form Edit Profil --}}
            <form method="POST" action="{{ route('tourguide.profile.update') }}" enctype="multipart/form-data" class="space-y-lg">
                @csrf

                {{-- Foto Profil --}}
                <div class="bg-surface-container-lowest rounded-xl p-lg shadow-sm border border-outline-variant/30">
                    <h3 class="font-bold text-lg text-primary mb-md">Foto Profil</h3>
                    <div class="flex items-center gap-lg">
                        <div class="w-24 h-24 rounded-full overflow-hidden border-4 border-outline-variant flex-shrink-0">
                            @if($profile && $profile->photo)
                                <img src="{{ asset('storage/'.$profile->photo) }}" id="photo-preview" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-surface-container flex items-center justify-center" id="photo-placeholder">
                                    <span class="material-symbols-outlined text-4xl text-outline">person</span>
                                </div>
                                <img id="photo-preview" class="w-full h-full object-cover hidden">
                            @endif
                        </div>
                        <div class="flex-1">
                            <label class="text-sm font-semibold text-on-surface block mb-2">Upload Foto Baru</label>
                            <input type="file" name="photo" accept="image/*"
                                   onchange="previewPhoto(this)"
                                   class="w-full text-sm border border-outline-variant rounded-xl bg-white file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white hover:file:opacity-90"/>
                            <p class="text-xs text-on-surface-variant mt-1">JPG, PNG. Maksimal 2MB.</p>
                        </div>
                    </div>
                </div>

                {{-- Info Dasar --}}
                <div class="bg-surface-container-lowest rounded-xl p-lg shadow-sm border border-outline-variant/30">
                    <h3 class="font-bold text-lg text-primary mb-md">Informasi Dasar</h3>
                    <div class="space-y-md">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-md">
                            <div>
                                <label class="text-sm font-semibold text-on-surface block mb-1">Lokasi / Wilayah Layanan <span class="text-error">*</span></label>
                                <input type="text" name="location"
                                       value="{{ old('location', $profile->location ?? '') }}"
                                       class="w-full border border-outline-variant rounded-xl px-md py-2.5 text-sm focus:ring-1 focus:ring-primary outline-none"
                                       placeholder="contoh: Lombok, NTB" required/>
                                @error('location')
                                <p class="text-error text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="text-sm font-semibold text-on-surface block mb-1">Nomor HP / WhatsApp</label>
                                <input type="text" name="phone"
                                       value="{{ old('phone', $profile->phone ?? '') }}"
                                       class="w-full border border-outline-variant rounded-xl px-md py-2.5 text-sm focus:ring-1 focus:ring-primary outline-none"
                                       placeholder="contoh: 08123456789"/>
                            </div>
                        </div>

                        <div>
                            <label class="text-sm font-semibold text-on-surface block mb-1">Harga Per Hari (Rp) <span class="text-error">*</span></label>
                            <input type="number" name="price_per_day" min="0"
                                   value="{{ old('price_per_day', $profile->price_per_day ?? '') }}"
                                   class="w-full border border-outline-variant rounded-xl px-md py-2.5 text-sm focus:ring-1 focus:ring-primary outline-none"
                                   placeholder="contoh: 500000" required/>
                            @error('price_per_day')
                            <p class="text-error text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="text-sm font-semibold text-on-surface block mb-1">Bio / Deskripsi Diri</label>
                            <textarea name="bio" rows="4"
                                      class="w-full border border-outline-variant rounded-xl px-md py-2.5 text-sm focus:ring-1 focus:ring-primary outline-none resize-none placeholder:text-outline-variant"
                                      placeholder="Ceritakan pengalamanmu sebagai tour guide...">{{ old('bio', $profile->bio ?? '') }}</textarea>
                        </div>

                    </div>
                </div>

                {{-- Tombol Simpan --}}
                <div class="flex gap-md">
                    <button type="submit"
                            class="flex items-center gap-2 px-8 py-3 bg-primary text-white text-sm font-semibold rounded-xl hover:opacity-90 transition-all shadow-md">
                        <span class="material-symbols-outlined text-[20px]">save</span>
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('tourguide.dashboard') }}"
                       class="flex items-center gap-2 px-8 py-3 border border-outline-variant text-on-surface-variant text-sm font-semibold rounded-xl hover:bg-surface-container transition-all">
                        Kembali
                    </a>
                </div>

            </form>

        </main>
    </div>
</div>

<script>
function previewPhoto(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('photo-preview');
            const placeholder = document.getElementById('photo-placeholder');
            preview.src = e.target.result;
            preview.classList.remove('hidden');
            if (placeholder) placeholder.classList.add('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

</body>
</html>