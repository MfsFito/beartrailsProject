<x-app-layout>

    {{-- Hero Section --}}
    <section class="relative bg-gradient-to-br from-[#1B4332] to-[#2D6A4F] text-on-primary py-xxl px-lg md:px-xl overflow-hidden flex flex-col items-center justify-center text-center min-h-[512px]">
        <div class="relative z-10 max-w-4xl mx-auto space-y-6">
            <div class="flex items-center justify-center space-x-2 text-xs text-primary-fixed mb-8">
                <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
                <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                <span>About</span>
            </div>
            <span class="inline-block bg-primary-fixed text-primary-container font-semibold text-sm px-4 py-1.5 rounded-full shadow-sm mb-4">
                Tentang Kami
            </span>
            <h1 class="font-display text-5xl font-bold text-white">Cerita di Balik BearTrails</h1>
            <p class="text-lg text-primary-fixed max-w-2xl mx-auto mt-6 opacity-90">
                Platform wisata yang lahir dari project tugas kuliah yang akan membawa suasana yang baru.
            </p>
        </div>
    </section>

    {{-- Tentang Platform --}}
    <section class="py-xxl px-lg md:px-xl max-w-[1280px] mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-xl lg:gap-xxl items-center">
            <div class="space-y-6">
                <span class="inline-block bg-primary-fixed/20 text-primary-container border border-primary-fixed/50 font-semibold text-sm px-4 py-1.5 rounded-full">
                    Platform
                </span>
                <h2 class="font-display text-3xl font-semibold text-on-surface">Satu Tempat untuk Semua Petualanganmu</h2>
                <p class="text-on-surface-variant text-base">
                    BearTrails menghubungkan jiwa petualang dengan keindahan Nusantara. Kami menggabungkan panduan lokal yang autentik dengan teknologi modern untuk memastikan perjalanan yang aman, terencana, dan tak terlupakan.
                </p>
                <ul class="space-y-4 mt-6">
                    <li class="flex items-start">
                        <span class="material-symbols-outlined text-surface-tint mr-3 flex-shrink-0">check_circle</span>
                        <span class="text-on-surface-variant text-base"><strong>Peta Interaktif:</strong> Jelajahi rute dan titik minat dengan mudah menggunakan peta terintegrasi kami.</span>
                    </li>
                    <li class="flex items-start">
                        <span class="material-symbols-outlined text-surface-tint mr-3 flex-shrink-0">check_circle</span>
                        <span class="text-on-surface-variant text-base"><strong>Prakiraan Cuaca Real-time:</strong> Rencanakan perjalanan dengan percaya diri dengan info cuaca terkini di destinasi.</span>
                    </li>
                    <li class="flex items-start">
                        <span class="material-symbols-outlined text-surface-tint mr-3 flex-shrink-0">check_circle</span>
                        <span class="text-on-surface-variant text-base"><strong>Tour Guide Terverifikasi:</strong> Temukan dan hubungi pemandu lokal yang berpengetahuan dan berpengalaman.</span>
                    </li>
                </ul>
            </div>

            {{-- Stats Grid --}}
            <div class="bg-surface rounded-xl p-lg md:p-xl shadow-sm border border-outline-variant/30 grid grid-cols-2 gap-lg relative">
                <div class="absolute inset-0 bg-primary-container/5 rounded-xl -z-10 translate-y-2 translate-x-2 blur-sm"></div>
                <div class="flex flex-col space-y-2">
                    <span class="font-display text-4xl font-bold text-primary-container">3</span>
                    <span class="text-xs font-semibold text-on-surface-variant uppercase tracking-wider">Anggota Tim</span>
                </div>
                <div class="flex flex-col space-y-2">
                    <span class="font-display text-4xl font-bold text-primary-container">∞</span>
                    <span class="text-xs font-semibold text-on-surface-variant uppercase tracking-wider">Semangat</span>
                </div>
            </div>
        </div>
    </section>

    {{-- Visi & Misi --}}
    <section class="bg-surface py-xxl px-lg md:px-xl">
        <div class="max-w-[1280px] mx-auto text-center">
            <span class="inline-block bg-surface-container-high text-on-surface font-semibold text-sm px-4 py-1.5 rounded-full border border-outline-variant/50 mb-8">
                Visi & Misi
            </span>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-lg">
                <div class="bg-surface-container rounded-lg p-lg text-left border-l-4 border-surface-tint shadow-sm hover:-translate-y-1 transition-transform duration-300 hover:shadow-[0px_10px_20px_rgba(45,106,79,0.15)] flex flex-col h-full">
                    <div class="h-12 w-12 bg-primary-container/10 text-primary-container rounded-full flex items-center justify-center mb-6">
                        <span class="material-symbols-outlined text-[24px]">explore</span>
                    </div>
                    <h3 class="font-bold text-lg text-on-surface mb-3">Visi</h3>
                    <p class="text-on-surface-variant text-base flex-grow">
                        Menjadi platform penemuan perjalanan terdepan yang menginspirasi eksplorasi berkelanjutan dan menghubungkan dunia dengan keajaiban alam dan budaya Indonesia yang tersembunyi.
                    </p>
                </div>
                <div class="bg-surface-container rounded-lg p-lg text-left border-l-4 border-surface-tint shadow-sm hover:-translate-y-1 transition-transform duration-300 hover:shadow-[0px_10px_20px_rgba(45,106,79,0.15)] flex flex-col h-full">
                    <div class="h-12 w-12 bg-primary-container/10 text-primary-container rounded-full flex items-center justify-center mb-6">
                        <span class="material-symbols-outlined text-[24px]">target</span>
                    </div>
                    <h3 class="font-bold text-lg text-on-surface mb-3">Misi</h3>
                    <p class="text-on-surface-variant text-base flex-grow">
                        Menyediakan akses mudah, aman, dan informatif ke destinasi luar biasa. Memberdayakan komunitas lokal melalui pariwisata yang bertanggung jawab, sambil menawarkan teknologi modern bagi para petualang.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Tim We Bare Bears --}}
    <section class="py-xxl px-lg md:px-xl max-w-[1280px] mx-auto text-center">
        <span class="inline-block bg-primary-fixed/20 text-primary-container border border-primary-fixed/50 font-semibold text-sm px-4 py-1.5 rounded-full mb-4">
            Tim Pembuat
        </span>
        <h2 class="font-display text-3xl font-semibold text-on-surface mb-12">We Bare Bears 🐻</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-lg">

            {{-- Rival --}}
            <div class="bg-surface rounded-xl p-lg border border-outline-variant/30 flex flex-col items-center text-center shadow-sm hover:-translate-y-1 transition-transform duration-300 hover:shadow-[0px_10px_20px_rgba(45,106,79,0.15)]">
                <div class="w-24 h-24 rounded-full bg-secondary-container text-on-secondary-container flex items-center justify-center font-display text-3xl font-bold mb-4">R</div>
                <div class="text-2xl mb-2">🐻</div>
                <h3 class="font-bold text-lg text-on-surface mb-1">RIVAL</h3>
                <span class="text-xs font-semibold bg-primary-fixed text-primary-container px-3 py-1 rounded-full mb-4">Grizzly — Frontend</span>
                <p class="text-on-surface-variant text-sm">...</p>
            </div>

            {{-- Fatio --}}
            <div class="bg-surface rounded-xl p-lg border border-outline-variant/30 flex flex-col items-center text-center shadow-sm hover:-translate-y-1 transition-transform duration-300 hover:shadow-[0px_10px_20px_rgba(45,106,79,0.15)]">
                <div class="w-24 h-24 rounded-full bg-secondary-fixed text-on-secondary-fixed flex items-center justify-center font-display text-3xl font-bold mb-4">F</div>
                <div class="text-2xl mb-2">🐼</div>
                <h3 class="font-bold text-lg text-on-surface mb-1">FATIO</h3>
                <span class="text-xs font-semibold bg-primary-fixed text-primary-container px-3 py-1 rounded-full mb-4">Panda — Project Lead (Fullstack)</span>
                <p class="text-on-surface-variant text-sm">...</p>
            </div>

            {{-- Alif --}}
            <div class="bg-surface rounded-xl p-lg border border-outline-variant/30 flex flex-col items-center text-center shadow-sm hover:-translate-y-1 transition-transform duration-300 hover:shadow-[0px_10px_20px_rgba(45,106,79,0.15)]">
                <div class="w-24 h-24 rounded-full bg-surface-container-high text-on-surface flex items-center justify-center font-display text-3xl font-bold mb-4">A</div>
                <div class="text-2xl mb-2">🐻‍❄️</div>
                <h3 class="font-bold text-lg text-on-surface mb-1">ALIF</h3>
                <span class="text-xs font-semibold bg-primary-fixed text-primary-container px-3 py-1 rounded-full mb-4">Ice Bear — Backend</span>
                <p class="text-on-surface-variant text-sm">...</p>
            </div>

        </div>
    </section>

{{-- CTA --}}
<section class="bg-primary text-white py-xl px-lg text-center">
    <h2 class="font-display text-3xl font-semibold mb-6 text-white">
        Siap Menjelajah Indonesia?
    </h2>

    <div class="flex flex-col sm:flex-row justify-center items-center gap-4">
        <a href="{{ route('destinations.index') }}"
           class="bg-white text-primary font-semibold text-sm px-6 py-3 rounded-full hover:bg-gray-100 transition-colors w-full sm:w-auto shadow-sm">
            Jelajahi Destinasi
        </a>

        <a href="{{ route('tourguides.index') }}"
           class="bg-transparent border border-white text-white font-semibold text-sm px-6 py-3 rounded-full hover:bg-white/10 transition-colors w-full sm:w-auto">
            Temukan Tour Guide
        </a>
    </div>
</section>

</x-app-layout>