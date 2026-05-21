<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Masuk - BearTrails</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400..900&family=Plus+Jakarta+Sans:wght@400..800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        "primary": "#012d1d", "on-primary": "#ffffff",
                        "primary-container": "#1b4332", "on-primary-container": "#86af99",
                        "primary-fixed": "#c1ecd4", "primary-fixed-dim": "#a5d0b9",
                        "secondary": "#8e4e14", "on-secondary": "#ffffff",
                        "tertiary-container": "#00452e", "tertiary-fixed": "#b1f0ce",
                        "background": "#fff8f2", "surface-container-lowest": "#ffffff",
                        "surface-container": "#f8ecdb", "on-surface": "#201b11",
                        "on-surface-variant": "#414844", "outline": "#717973",
                        "outline-variant": "#c1c8c2", "error": "#ba1a1a",
                        "error-container": "#ffdad6",
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
        h1, h2 { font-family: 'Fraunces', serif; }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>
<body class="bg-background min-h-screen flex text-on-surface relative overflow-hidden">

    {{-- Background Blur --}}
    <div class="absolute top-[-100px] left-[-100px] w-96 h-96 bg-primary-fixed-dim/30 rounded-full mix-blend-multiply filter blur-3xl opacity-70 pointer-events-none"></div>
    <div class="absolute bottom-[-100px] right-[-100px] w-96 h-96 bg-tertiary-fixed/30 rounded-full mix-blend-multiply filter blur-3xl opacity-70 pointer-events-none"></div>

    <main class="flex w-full min-h-screen z-10">

        {{-- Panel Kiri --}}
        <div class="hidden lg:flex w-[45%] bg-gradient-to-br from-primary-container to-tertiary-container text-on-primary p-xl flex-col justify-between relative overflow-hidden">
            <div class="absolute inset-0 opacity-10" style="background-image: repeating-linear-gradient(45deg, #ffffff 0, #ffffff 1px, transparent 0, transparent 50%); background-size: 10px 10px;"></div>
            <div class="relative z-10">
                <div class="flex items-center gap-sm mb-lg">
                    <span class="text-2xl font-black text-white">BearTrails</span>
                </div>
                <p class="text-primary-fixed-dim italic mt-xs max-w-sm">Follow the Trail, Discover the World</p>
            </div>
            <div class="relative z-10 flex flex-col gap-lg mt-xxl">
                <div class="flex items-start gap-md">
                    <div class="w-12 h-12 rounded-full bg-on-primary/10 flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-primary-fixed-dim">map</span>
                    </div>
                    <div>
                        <h4 class="font-bold text-white mb-xs">Peta interaktif</h4>
                        <p class="text-white/80 text-sm">Jelajahi destinasi dengan peta detail dan rute yang terverifikasi.</p>
                    </div>
                </div>
                <div class="flex items-start gap-md">
                    <div class="w-12 h-12 rounded-full bg-on-primary/10 flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-primary-fixed-dim">partly_cloudy_day</span>
                    </div>
                    <div>
                        <h4 class="font-bold text-white mb-xs">Cuaca real-time</h4>
                        <p class="text-white/80 text-sm">Pantau kondisi cuaca terkini untuk perencanaan perjalanan yang aman.</p>
                    </div>
                </div>
                <div class="flex items-start gap-md">
                    <div class="w-12 h-12 rounded-full bg-on-primary/10 flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-primary-fixed-dim">explore</span>
                    </div>
                    <div>
                        <h4 class="font-bold text-white mb-xs">Tour guide lokal</h4>
                        <p class="text-white/80 text-sm">Temukan pemandu wisata berpengalaman di setiap destinasi.</p>
                    </div>
                </div>
            </div>
            <div class="relative z-10 mt-xxl text-xs text-white/60">
                © 2025 BearTrails. Jelajahi Keindahan Nusantara.
            </div>
        </div>

        {{-- Panel Kanan (Form) --}}
        <div class="w-full lg:w-[55%] flex flex-col p-lg md:p-xl lg:px-xxl lg:py-xl bg-surface-container-lowest relative z-10">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-xs text-sm font-semibold text-outline hover:text-primary transition-colors w-fit group">
                <span class="material-symbols-outlined text-[18px] group-hover:-translate-x-1 transition-transform">arrow_back</span>
                Kembali ke Beranda
            </a>

            <div class="flex-1 flex flex-col justify-center max-w-[480px] w-full mx-auto my-xl">
                <div class="mb-lg">
                    <span class="text-sm font-semibold text-on-primary-container bg-primary-fixed/30 px-sm py-xs rounded-full inline-block mb-sm">Selamat Datang</span>
                    <h1 class="text-3xl font-bold text-on-surface mb-xs">Masuk ke Akunmu</h1>
                    <p class="text-on-surface-variant text-sm">Belum punya akun?
                        <a href="{{ route('register') }}" class="text-secondary font-semibold hover:underline">Daftar sekarang</a>
                    </p>
                </div>

                {{-- Error Message --}}
                @if($errors->any())
                <div class="mb-lg p-md bg-error-container rounded-xl">
                    <p class="text-error text-sm flex items-center gap-xs">
                        <span class="material-symbols-outlined text-[16px]">error</span>
                        {{ $errors->first() }}
                    </p>
                </div>
                @endif

                {{-- Session Status --}}
                @if(session('status'))
                <div class="mb-lg p-md bg-primary-fixed/30 rounded-xl">
                    <p class="text-primary text-sm">{{ session('status') }}</p>
                </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-lg">
                    @csrf

                    {{-- Email --}}
                    <div class="space-y-xs">
                        <label class="block text-sm font-semibold text-on-surface" for="email">Alamat Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-md flex items-center pointer-events-none">
                                <span class="material-symbols-outlined {{ $errors->has('email') ? 'text-error' : 'text-outline' }}">mail</span>
                            </div>
                            <input id="email" name="email" type="email" value="{{ old('email') }}" required
                                   class="block w-full pl-[44px] pr-md py-sm border {{ $errors->has('email') ? 'border-error bg-error-container/10' : 'border-outline-variant' }} text-on-surface rounded-xl focus:ring-2 focus:ring-primary-fixed-dim focus:border-primary-fixed-dim text-sm placeholder:text-outline-variant transition-colors"
                                   placeholder="nama@email.com"/>
                        </div>
                        @error('email')
                        <p class="text-xs text-error flex items-center gap-xs mt-xs">
                            <span class="material-symbols-outlined text-[14px]">error</span>
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="space-y-xs">
                        <div class="flex justify-between items-center">
                            <label class="block text-sm font-semibold text-on-surface" for="password">Password</label>
                        </div>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-md flex items-center pointer-events-none">
                                <span class="material-symbols-outlined text-outline">lock</span>
                            </div>
                            <input id="password" name="password" type="password" required
                                   class="block w-full pl-[44px] pr-[44px] py-sm border border-outline-variant bg-surface-container-lowest text-on-surface rounded-xl focus:ring-2 focus:ring-primary-fixed-dim focus:border-primary-fixed-dim text-sm placeholder:text-outline-variant transition-colors"
                                   placeholder="••••••••"/>
                            <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 pr-md flex items-center text-outline hover:text-on-surface transition-colors">
                                <span class="material-symbols-outlined" id="eye-icon">visibility</span>
                            </button>
                        </div>
                        @error('password')
                        <p class="text-xs text-error flex items-center gap-xs mt-xs">
                            <span class="material-symbols-outlined text-[14px]">error</span>
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    {{-- Remember Me --}}
                    <div class="flex items-center gap-sm">
                        <input type="checkbox" name="remember" id="remember" class="rounded border-outline-variant text-primary focus:ring-primary-fixed-dim">
                        <label for="remember" class="text-sm text-on-surface-variant">Ingat saya</label>
                    </div>

                    {{-- Submit --}}
                    <button type="submit"
                            class="w-full flex justify-center py-sm px-lg border border-transparent rounded-[10px] shadow-sm font-semibold text-white bg-secondary hover:bg-secondary/90 focus:outline-none transition-all hover:-translate-y-[1px]">
                        Masuk
                    </button>
                </form>
            </div>
        </div>
    </main>

    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const icon = document.getElementById('eye-icon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.textContent = 'visibility_off';
            } else {
                input.type = 'password';
                icon.textContent = 'visibility';
            }
        }
    </script>
</body>
</html>