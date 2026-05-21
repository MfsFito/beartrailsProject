<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Daftar - BearTrails</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        "primary": "#012d1d", "on-primary": "#ffffff",
                        "primary-container": "#1b4332", "on-primary-container": "#86af99",
                        "primary-fixed": "#c1ecd4", "primary-fixed-dim": "#a5d0b9",
                        "on-primary-fixed": "#002114",
                        "secondary": "#8e4e14", "on-secondary": "#ffffff",
                        "secondary-container": "#ffab69", "on-secondary-container": "#783d01",
                        "secondary-fixed": "#ffdcc4", "secondary-fixed-dim": "#ffb780",
                        "on-secondary-fixed": "#2f1400",
                        "tertiary": "#002d1c", "tertiary-container": "#00452e",
                        "tertiary-fixed": "#b1f0ce", "tertiary-fixed-dim": "#95d4b3",
                        "on-tertiary-container": "#75b393", "on-tertiary-fixed": "#002114",
                        "on-tertiary-fixed-variant": "#0e5138",
                        "background": "#fff8f2", "surface": "#fff8f2",
                        "surface-container": "#f8ecdb", "surface-container-lowest": "#ffffff",
                        "surface-container-low": "#fdf2e1",
                        "on-surface": "#201b11", "on-surface-variant": "#414844",
                        "outline": "#717973", "outline-variant": "#c1c8c2",
                        "error": "#ba1a1a", "error-container": "#ffdad6",
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
        .pattern-diagonal {
            background-image: repeating-linear-gradient(45deg, transparent, transparent 10px, rgba(113,121,115,0.03) 10px, rgba(113,121,115,0.03) 11px);
        }
    </style>
</head>
<body class="bg-surface text-on-surface antialiased min-h-screen flex">

<div class="flex w-full min-h-screen">

    {{-- Panel Kiri --}}
    <div class="hidden lg:flex w-[45%] flex-col justify-between p-xxl bg-gradient-to-br from-primary-container to-tertiary-container relative overflow-hidden z-0">
        <div class="absolute inset-0 opacity-20 mix-blend-overlay" style="background-image: url('data:image/svg+xml,%3Csvg viewBox=%220 0 200 200%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cfilter id=%22noiseFilter%22%3E%3CfeTurbulence type=%22fractalNoise%22 baseFrequency=%220.65%22 numOctaves=%223%22 stitchTiles=%22stitch%22/%3E%3C/filter%3E%3Crect width=%22100%25%22 height=%22100%25%22 filter=%22url(%23noiseFilter)%22/%3E%3C/svg%3E');"></div>
        <div class="relative z-10">
            <h1 class="text-3xl font-black text-white tracking-tight">BearTrails</h1>
        </div>
        <div class="relative z-10 max-w-md">
            <h2 class="text-5xl font-bold text-tertiary-fixed italic mb-xl leading-tight">Follow the Trail,<br/>Discover the World</h2>
            <ul class="space-y-lg text-lg text-primary-fixed-dim">
                <li class="flex items-center gap-md">
                    <span class="material-symbols-outlined text-tertiary-fixed">map</span>
                    Peta interaktif
                </li>
                <li class="flex items-center gap-md">
                    <span class="material-symbols-outlined text-tertiary-fixed">partly_cloudy_day</span>
                    Cuaca real-time
                </li>
                <li class="flex items-center gap-md">
                    <span class="material-symbols-outlined text-tertiary-fixed">explore</span>
                    Tour guide lokal
                </li>
            </ul>
        </div>
        <div class="relative z-10 text-primary-fixed-dim text-xs">
            © 2025 BearTrails. Jelajahi Keindahan Nusantara.
        </div>
        <div class="absolute top-[-10%] right-[-20%] w-[500px] h-[500px] bg-tertiary-fixed/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-[-10%] left-[-10%] w-[400px] h-[400px] bg-secondary-container/10 rounded-full blur-3xl pointer-events-none"></div>
    </div>

    {{-- Panel Kanan (Form) --}}
    <div class="w-full lg:w-[55%] relative flex flex-col items-center justify-center p-lg md:p-xl lg:p-xxl bg-surface pattern-diagonal overflow-y-auto">
        <div class="absolute top-0 left-0 w-[300px] h-[300px] bg-tertiary-fixed/30 rounded-full blur-[100px] pointer-events-none mix-blend-multiply"></div>
        <div class="absolute bottom-0 right-0 w-[400px] h-[400px] bg-tertiary-container/10 rounded-full blur-[120px] pointer-events-none mix-blend-multiply"></div>

        {{-- Back Link --}}
        <div class="absolute top-lg left-lg md:top-xl md:left-xl z-20">
            <a href="{{ route('home') }}" class="flex items-center gap-xs text-sm font-semibold text-outline hover:text-tertiary-container transition-colors duration-200">
                <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                Kembali ke Beranda
            </a>
        </div>

        {{-- Form Container --}}
        <div class="w-full max-w-[440px] relative z-10 bg-surface-container-lowest/80 backdrop-blur-md p-xl rounded-xl shadow-sm border border-outline-variant/30">
            <div class="mb-xl text-center md:text-left">
                <span class="inline-block text-sm font-semibold text-on-tertiary-container bg-tertiary-fixed/40 px-3 py-1 rounded-full mb-md uppercase tracking-widest">Bergabung Sekarang</span>
                <h2 class="text-3xl font-bold text-on-surface mb-xs">Buat Akun Baru</h2>
                <p class="text-outline text-sm">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-secondary font-semibold hover:underline transition-colors">Masuk di sini</a>
                </p>
            </div>

            {{-- Error Messages --}}
            @if($errors->any())
            <div class="mb-lg p-md bg-error-container rounded-xl">
                @foreach($errors->all() as $error)
                <p class="text-error text-sm flex items-center gap-xs">
                    <span class="material-symbols-outlined text-[14px]">error</span>
                    {{ $error }}
                </p>
                @endforeach
            </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-lg">
                @csrf

                {{-- Nama Lengkap --}}
                <div>
                    <label class="block text-sm font-semibold text-on-surface-variant mb-xs">Nama Lengkap</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="material-symbols-outlined text-outline">person</span>
                        </div>
                        <input name="name" type="text" value="{{ old('name') }}" required
                               class="block w-full pl-10 pr-3 py-3 border {{ $errors->has('name') ? 'border-error' : 'border-outline-variant' }} rounded-lg bg-surface-container-lowest text-on-surface text-sm focus:ring-1 focus:ring-tertiary-fixed-dim focus:border-tertiary-fixed-dim transition-shadow"
                               placeholder="Nama Lengkap"/>
                    </div>
                </div>

                {{-- Email --}}
                <div>
                    <label class="block text-sm font-semibold text-on-surface-variant mb-xs">Alamat Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="material-symbols-outlined text-outline">mail</span>
                        </div>
                        <input name="email" type="email" value="{{ old('email') }}" required
                               class="block w-full pl-10 pr-3 py-3 border {{ $errors->has('email') ? 'border-error' : 'border-outline-variant' }} rounded-lg bg-surface-container-lowest text-on-surface text-sm focus:ring-1 focus:ring-tertiary-fixed-dim focus:border-tertiary-fixed-dim transition-shadow"
                               placeholder="nama@email.com"/>
                    </div>
                </div>

                {{-- Password --}}
                <div>
                    <label class="block text-sm font-semibold text-on-surface-variant mb-xs">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="material-symbols-outlined text-outline">lock</span>
                        </div>
                        <input name="password" id="password" type="password" required
                               class="block w-full pl-10 pr-10 py-3 border {{ $errors->has('password') ? 'border-error' : 'border-outline-variant' }} rounded-lg bg-surface-container-lowest text-on-surface text-sm focus:ring-1 focus:ring-tertiary-fixed-dim focus:border-tertiary-fixed-dim transition-shadow"
                               placeholder="••••••••" oninput="checkStrength(this.value)"/>
                        <button type="button" onclick="togglePass('password', 'eye1')" class="absolute inset-y-0 right-0 pr-3 flex items-center text-outline hover:text-on-surface transition-colors">
                            <span class="material-symbols-outlined" id="eye1">visibility</span>
                        </button>
                    </div>
                    {{-- Strength Indicator --}}
                    <div class="mt-2 flex items-center gap-2">
                        <div class="flex-1 flex gap-1 h-1.5">
                            <div class="h-full w-1/3 rounded-full transition-colors" id="str1" style="background:#c1c8c2"></div>
                            <div class="h-full w-1/3 rounded-full transition-colors" id="str2" style="background:#c1c8c2"></div>
                            <div class="h-full w-1/3 rounded-full transition-colors" id="str3" style="background:#c1c8c2"></div>
                        </div>
                        <span class="text-xs text-on-tertiary-container" id="str-label">Masukkan password</span>
                    </div>
                </div>

                {{-- Konfirmasi Password --}}
                <div>
                    <label class="block text-sm font-semibold text-on-surface-variant mb-xs">Konfirmasi Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="material-symbols-outlined text-outline">lock</span>
                        </div>
                        <input name="password_confirmation" id="password_confirmation" type="password" required
                               class="block w-full pl-10 pr-10 py-3 border border-outline-variant rounded-lg bg-surface-container-lowest text-on-surface text-sm focus:ring-1 focus:ring-tertiary-fixed-dim focus:border-tertiary-fixed-dim transition-shadow"
                               placeholder="••••••••" oninput="checkMatch()"/>
                        <button type="button" onclick="togglePass('password_confirmation', 'eye2')" class="absolute inset-y-0 right-0 pr-3 flex items-center text-outline hover:text-on-surface transition-colors">
                            <span class="material-symbols-outlined" id="eye2">visibility</span>
                        </button>
                    </div>
                    <p class="mt-1 text-xs hidden" id="match-msg"></p>
                </div>

                {{-- Submit --}}
                <div class="pt-sm">
                    <button type="submit"
                            class="w-full py-4 bg-secondary-container text-on-secondary-container font-semibold rounded-xl hover:bg-secondary-fixed transition-colors shadow-sm flex justify-center items-center gap-sm">
                        Daftar Sekarang
                        <span class="material-symbols-outlined">arrow_forward</span>
                    </button>
                </div>
            </form>

            <p class="text-xs text-outline text-center mt-lg max-w-sm mx-auto leading-relaxed">
                Dengan mendaftar, kamu menyetujui <a href="#" class="text-on-surface-variant underline">syarat & ketentuan</a> BearTrails.
            </p>
        </div>
    </div>
</div>

<script>
    function togglePass(id, iconId) {
        const input = document.getElementById(id);
        const icon = document.getElementById(iconId);
        if (input.type === 'password') {
            input.type = 'text';
            icon.textContent = 'visibility_off';
        } else {
            input.type = 'password';
            icon.textContent = 'visibility';
        }
    }

    function checkStrength(val) {
        const s1 = document.getElementById('str1');
        const s2 = document.getElementById('str2');
        const s3 = document.getElementById('str3');
        const label = document.getElementById('str-label');
        const weak = '#ba1a1a', medium = '#f4a261', strong = '#95d4b3', empty = '#c1c8c2';

        if (val.length === 0) {
            [s1,s2,s3].forEach(s => s.style.background = empty);
            label.textContent = 'Masukkan password';
        } else if (val.length < 6) {
            s1.style.background = weak; s2.style.background = empty; s3.style.background = empty;
            label.textContent = 'Lemah';
        } else if (val.length < 10) {
            s1.style.background = medium; s2.style.background = medium; s3.style.background = empty;
            label.textContent = 'Sedang';
        } else {
            [s1,s2,s3].forEach(s => s.style.background = strong);
            label.textContent = 'Kuat';
        }
        checkMatch();
    }

    function checkMatch() {
        const pass = document.getElementById('password').value;
        const confirm = document.getElementById('password_confirmation').value;
        const msg = document.getElementById('match-msg');
        if (confirm.length === 0) { msg.classList.add('hidden'); return; }
        msg.classList.remove('hidden');
        if (pass === confirm) {
            msg.textContent = '✓ Password cocok';
            msg.style.color = '#95d4b3';
        } else {
            msg.textContent = '✗ Password tidak cocok';
            msg.style.color = '#ba1a1a';
        }
    }
</script>
</body>
</html>