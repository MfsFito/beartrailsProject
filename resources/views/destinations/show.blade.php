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

            {{-- Reviews --}}
            <div class="mb-8">
                <h2 class="font-display text-2xl font-semibold text-primary mb-6">Ulasan Pengunjung</h2>

                @if($reviews->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                    {{-- Rating Summary --}}
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

                    {{-- Review Cards --}}
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

                {{-- Form Review --}}
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

            </div>
        </aside>
    </main>

</x-app-layout>