<x-app-layout>

    <div class="max-w-7xl mx-auto px-lg py-xl md:py-xxl min-h-screen">

        {{-- Page Header --}}
        <div class="mb-xl">
            <h1 class="font-display text-4xl font-bold text-primary">Profil Saya</h1>
            <p class="text-on-surface-variant mt-sm">Kelola data pribadi, destinasi tersimpan, dan ulasan kamu.</p>
        </div>

        @if(session('status') === 'profile-updated')
        <div class="mb-lg p-md bg-tertiary-fixed rounded-xl text-on-tertiary-fixed-variant font-semibold text-sm flex items-center gap-sm">
            <span class="material-symbols-outlined text-[18px]">check_circle</span>
            Profil berhasil diperbarui!
        </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-xl">

            {{-- Kolom Kiri: Data Pribadi --}}
            <section class="lg:col-span-4 flex flex-col gap-lg">
                <div class="bg-surface-container-lowest rounded-xl p-xl shadow-sm border border-outline-variant/30 relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-primary to-primary-fixed-dim"></div>

                    {{-- Avatar --}}
                    <div class="flex flex-col items-center text-center mb-lg pt-sm">
                        <div class="relative mb-md group">
                            @if(auth()->user()->avatar)
                                <img src="{{ asset('storage/'.auth()->user()->avatar) }}"
                                     class="w-32 h-32 rounded-full object-cover border-4 border-surface shadow-sm"
                                     alt="{{ auth()->user()->name }}">
                            @else
                                <div class="w-32 h-32 rounded-full bg-surface-container flex items-center justify-center border-4 border-surface shadow-sm">
                                    <span class="material-symbols-outlined text-6xl text-outline">person</span>
                                </div>
                            @endif
                        </div>
                        <h2 class="font-bold text-xl text-primary">{{ auth()->user()->name }}</h2>
                        <p class="text-on-surface-variant text-sm">Member sejak {{ auth()->user()->created_at->format('Y') }}</p>
                        <span class="mt-sm inline-block px-3 py-1 rounded-full text-xs font-semibold
                            {{ auth()->user()->role === 'admin' ? 'bg-error text-white' :
                               (auth()->user()->role === 'tourguide' ? 'bg-tertiary-fixed text-on-tertiary-fixed-variant' :
                               'bg-primary-fixed text-on-primary-fixed') }}">
                            {{ ucfirst(auth()->user()->role) }}
                        </span>
                    </div>

                    {{-- Form Edit Profil --}}
                    <form method="POST" action="{{ route('profile.update') }}" class="flex flex-col gap-md">
                        @csrf
                        @method('PATCH')

                        <div class="flex flex-col gap-xs">
                            <label class="text-sm font-semibold text-on-surface" for="name">Nama Lengkap</label>
                            <input id="name" name="name" type="text" value="{{ old('name', auth()->user()->name) }}" required
                                   class="w-full rounded-xl border {{ $errors->has('name') ? 'border-error' : 'border-outline-variant' }} bg-surface px-md py-3 text-sm text-on-surface focus:border-primary-fixed-dim focus:ring-1 focus:ring-primary-fixed-dim outline-none transition-shadow"/>
                            @error('name')
                            <p class="text-error text-xs">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-xs">
                            <label class="text-sm font-semibold text-on-surface" for="email">Alamat Email</label>
                            <input id="email" name="email" type="email" value="{{ old('email', auth()->user()->email) }}" required
                                   class="w-full rounded-xl border {{ $errors->has('email') ? 'border-error' : 'border-outline-variant' }} bg-surface px-md py-3 text-sm text-on-surface focus:border-primary-fixed-dim focus:ring-1 focus:ring-primary-fixed-dim outline-none transition-shadow"/>
                            @error('email')
                            <p class="text-error text-xs">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit"
                                class="mt-sm w-full bg-primary text-white font-semibold text-sm py-4 rounded-xl hover:bg-tertiary-container transition-colors flex justify-center items-center gap-sm shadow-sm">
                            <span class="material-symbols-outlined text-[18px]">edit</span>
                            Simpan Perubahan
                        </button>
                    </form>

                    {{-- Ganti Password --}}
                    <div class="mt-lg pt-lg border-t border-outline-variant">
                        <h3 class="font-bold text-sm text-on-surface mb-md">Ganti Password</h3>
                        <form method="POST" action="{{ route('password.update') }}" class="flex flex-col gap-md">
                            @csrf
                            @method('PUT')

                            <input id="current_password" name="current_password" type="password"
                                   class="w-full rounded-xl border border-outline-variant bg-surface px-md py-3 text-sm focus:ring-1 focus:ring-primary-fixed-dim outline-none"
                                   placeholder="Password saat ini"/>

                            <input id="password" name="password" type="password"
                                   class="w-full rounded-xl border border-outline-variant bg-surface px-md py-3 text-sm focus:ring-1 focus:ring-primary-fixed-dim outline-none"
                                   placeholder="Password baru"/>

                            <input id="password_confirmation" name="password_confirmation" type="password"
                                   class="w-full rounded-xl border border-outline-variant bg-surface px-md py-3 text-sm focus:ring-1 focus:ring-primary-fixed-dim outline-none"
                                   placeholder="Konfirmasi password baru"/>

                            <button type="submit"
                                    class="w-full border border-primary text-primary font-semibold text-sm py-3 rounded-xl hover:bg-primary hover:text-white transition-colors">
                                Update Password
                            </button>
                        </form>
                    </div>

                    {{-- Hapus Akun --}}
                    <div class="mt-lg pt-lg border-t border-outline-variant">
                        <form method="POST" action="{{ route('profile.destroy') }}"
                              onsubmit="return confirm('Yakin ingin hapus akun? Tindakan ini tidak bisa dibatalkan.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="w-full border border-error text-error font-semibold text-sm py-3 rounded-xl hover:bg-error hover:text-white transition-colors">
                                Hapus Akun
                            </button>
                        </form>
                    </div>
                </div>
            </section>

            {{-- Kolom Kanan: Favorit & Review --}}
            <div class="lg:col-span-8 flex flex-col gap-xxl">

                {{-- Favorit --}}
                <section>
                    <div class="flex justify-between items-end mb-lg">
                        <h2 class="font-display text-2xl font-semibold text-primary">Destinasi Favorit</h2>
                        <a href="{{ route('favorites.index') }}" class="text-sm font-semibold text-primary hover:underline">Lihat Semua</a>
                    </div>

                    @php $favorites = auth()->user()->favorites()->with('destination')->latest()->take(4)->get(); @endphp

                    @if($favorites->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-lg">
                        @foreach($favorites as $favorite)
                        <div class="group relative rounded-xl overflow-hidden bg-surface-container-lowest shadow-sm hover:shadow-[0_10px_20px_rgba(45,106,79,0.15)] hover:-translate-y-1 transition-all duration-300 border border-outline-variant/20">
                            <div class="h-[180px] w-full relative">
                                @if($favorite->destination->image)
                                    <img src="{{ asset('storage/'.$favorite->destination->image) }}"
                                         class="w-full h-full object-cover" alt="{{ $favorite->destination->name }}">
                                @else
                                    <div class="w-full h-full bg-surface-container flex items-center justify-center">
                                        <span class="material-symbols-outlined text-5xl text-outline">landscape</span>
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                                <span class="absolute top-4 left-4 bg-secondary-container text-on-secondary-container text-xs px-3 py-1 rounded-full font-bold">
                                    {{ $favorite->destination->category }}
                                </span>
                                <form action="{{ route('favorites.toggle', $favorite->destination) }}" method="POST"
                                      class="absolute top-4 right-4">
                                    @csrf
                                    <button type="submit"
                                            class="w-[34px] h-[34px] bg-white/20 backdrop-blur-md rounded-full flex items-center justify-center text-white hover:bg-error hover:text-white transition-colors">
                                        <span class="material-symbols-outlined text-[18px]" style="font-variation-settings: 'FILL' 1;">favorite</span>
                                    </button>
                                </form>
                            </div>
                            <div class="p-md">
                                <h3 class="font-bold text-lg text-primary mb-xs">{{ $favorite->destination->name }}</h3>
                                <p class="text-on-surface-variant text-sm flex items-center gap-xs">
                                    <span class="material-symbols-outlined text-[16px] text-outline">location_on</span>
                                    {{ $favorite->destination->location }}
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="text-center py-xl bg-surface-container-lowest rounded-xl border border-outline-variant/20">
                        <span class="material-symbols-outlined text-5xl text-outline">favorite_border</span>
                        <p class="text-on-surface-variant mt-md">Belum ada destinasi favorit.</p>
                        <a href="{{ route('destinations.index') }}"
                           class="mt-md inline-block px-6 py-2 bg-primary text-white rounded-lg text-sm font-semibold hover:opacity-90 transition-all">
                            Jelajahi Destinasi
                        </a>
                    </div>
                    @endif
                </section>

                {{-- Riwayat Review --}}
                <section>
                    <h2 class="font-display text-2xl font-semibold text-primary mb-lg">Riwayat Ulasan</h2>

                    @php $reviews = auth()->user()->reviews()->with('destination')->latest()->get(); @endphp

                    @if($reviews->count() > 0)
                    <div class="flex flex-col gap-md">
                        @foreach($reviews as $review)
                        <div class="bg-surface-container-lowest rounded-xl p-lg shadow-sm border border-outline-variant/20 flex flex-col md:flex-row gap-lg items-start">
                            <div class="w-full md:w-1/4 flex-shrink-0">
                                @if($review->destination->image)
                                    <img src="{{ asset('storage/'.$review->destination->image) }}"
                                         class="w-full h-24 object-cover rounded-lg" alt="{{ $review->destination->name }}">
                                @else
                                    <div class="w-full h-24 bg-surface-container rounded-lg flex items-center justify-center">
                                        <span class="material-symbols-outlined text-3xl text-outline">landscape</span>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-grow flex flex-col gap-xs">
                                <div class="flex justify-between items-start w-full">
                                    <h3 class="font-bold text-lg text-primary">{{ $review->destination->name }}</h3>
                                    <span class="text-xs text-outline">{{ $review->created_at->format('d M Y') }}</span>
                                </div>
                                <div class="flex text-secondary mb-sm">
                                    @for($i = 1; $i <= 5; $i++)
                                    <span class="material-symbols-outlined text-[18px]"
                                          style="font-variation-settings: 'FILL' {{ $i <= $review->rating ? '1' : '0' }};">star</span>
                                    @endfor
                                </div>
                                <p class="text-on-surface-variant text-sm">{{ $review->comment }}</p>
                                <form action="{{ route('reviews.destroy', $review) }}" method="POST" class="mt-sm">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-error text-xs hover:underline flex items-center gap-xs">
                                        <span class="material-symbols-outlined text-[14px]">delete</span>
                                        Hapus Ulasan
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="text-center py-xl bg-surface-container-lowest rounded-xl border border-outline-variant/20">
                        <span class="material-symbols-outlined text-5xl text-outline">rate_review</span>
                        <p class="text-on-surface-variant mt-md">Belum ada ulasan yang ditulis.</p>
                        <a href="{{ route('destinations.index') }}"
                           class="mt-md inline-block px-6 py-2 bg-primary text-white rounded-lg text-sm font-semibold hover:opacity-90 transition-all">
                            Mulai Jelajahi
                        </a>
                    </div>
                    @endif
                </section>

            </div>
        </div>
    </div>

</x-app-layout>