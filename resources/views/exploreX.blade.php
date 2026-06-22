<x-app-layout>
    <section class="min-h-[80vh] flex items-center justify-center bg-surface-container px-6">
        <div class="max-w-md w-full bg-white p-10 rounded-3xl shadow-xl border border-outline-variant text-center relative overflow-hidden">
            {{-- Ornamen Dekorasi --}}
            <div class="absolute -top-12 -right-12 w-32 h-32 bg-primary-fixed rounded-full opacity-50"></div>
            <div class="absolute -bottom-8 -left-8 w-24 h-24 bg-tertiary-fixed rounded-full opacity-50"></div>

            <div class="relative z-10">
                <div class="w-24 h-24 bg-error-container rounded-full flex items-center justify-center mx-auto mb-6 border-4 border-white shadow-sm">
                    <span class="material-symbols-outlined text-error text-5xl">lock</span>
                </div>
                
                <h2 class="font-display text-3xl font-bold text-primary mb-3">Halaman Eksklusif</h2>
                <p class="text-on-surface-variant text-sm mb-8 leading-relaxed">
                    Fitur peta interaktif dan radar cuaca real-time hanya tersedia untuk user yang memiliki akun di BearTrails. Silakan masuk untuk memulai petualanganmu!
                </p>

                <div class="space-y-3">
                    <a href="{{ route('login') }}" class="block w-full py-3.5 bg-primary text-white rounded-xl font-bold hover:opacity-90 transition-all shadow-md hover:-translate-y-0.5">
                        Masuk Sekarang
                    </a>
                    <a href="{{ route('register') }}" class="block w-full py-3.5 bg-surface-container-low text-primary border border-outline-variant rounded-xl font-bold hover:bg-surface-container transition-all">
                        Buat Akun Baru
                    </a>
                </div>
                
                <div class="mt-6">
                    <a href="{{ route('home') }}" class="text-sm text-outline hover:text-primary font-medium flex items-center justify-center gap-1 transition-colors">
                        <span class="material-symbols-outlined text-[16px]">arrow_back</span> Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>