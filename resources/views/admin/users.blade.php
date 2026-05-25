<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Kelola User — BearTrails Admin</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
<div class="flex min-h-screen">

    {{-- Sidebar --}}
    <aside class="fixed left-0 top-0 h-full w-[250px] z-50 bg-[#012d1d] text-white flex flex-col shadow-2xl">
        <div class="px-6 pt-8 pb-6 border-b border-white/10">
            <a href="{{ route('home') }}" class="text-2xl font-black tracking-wide text-white">BearTrails</a>
            <p class="text-[#b1f0ce] text-xs font-bold mt-1 tracking-widest uppercase">Admin Panel</p>
        </div>
        <nav class="flex-1 py-6 flex flex-col gap-1">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-6 py-3 border-l-4 border-transparent text-gray-300 hover:bg-white/5 hover:text-white transition-all text-sm font-medium">
                <span class="material-symbols-outlined text-[22px]">dashboard</span>
                Dashboard
            </a>
            <a href="{{ route('admin.users') }}" class="flex items-center gap-3 px-6 py-3 border-l-4 border-[#b1f0ce] bg-white/10 text-white transition-all text-sm font-medium">
                <span class="material-symbols-outlined text-[22px]">group</span>
                Kelola User
            </a>
            <a href="{{ route('home') }}" class="flex items-center gap-3 px-6 py-3 border-l-4 border-transparent text-gray-300 hover:bg-white/5 hover:text-white transition-all text-sm font-medium">
                <span class="material-symbols-outlined text-[22px]">public</span>
                Lihat Website
            </a>
        </nav>
        <div class="p-4 border-t border-white/10">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg text-red-400/80 hover:text-red-400 hover:bg-red-500/10 transition-all text-sm">
                    <span class="material-symbols-outlined">logout</span>
                    Keluar
                </button>
            </form>
        </div>
    </aside>

    {{-- Main --}}
    <div class="ml-[250px] flex-1 p-8">

        {{-- Header --}}
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Kelola User</h1>
                <p class="text-gray-500 text-sm mt-1">Total {{ $users->count() }} user terdaftar</p>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 text-sm text-gray-500 hover:text-gray-800 transition-colors">
                <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                Kembali ke Dashboard
            </a>
        </div>

        {{-- Alert --}}
        @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-xl flex items-center gap-2">
            <span class="material-symbols-outlined">check_circle</span>
            {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div class="mb-6 p-4 bg-red-100 text-red-700 rounded-xl flex items-center gap-2">
            <span class="material-symbols-outlined">error</span>
            {{ session('error') }}
        </div>
        @endif

        {{-- Tabel User --}}
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <table class="w-full text-left text-sm">
                <thead class="bg-[#012d1d] text-white">
                    <tr>
                        <th class="px-6 py-4 font-semibold">Nama</th>
                        <th class="px-6 py-4 font-semibold">Email</th>
                        <th class="px-6 py-4 font-semibold">Bergabung</th>
                        <th class="px-6 py-4 font-semibold">Favorit</th>
                        <th class="px-6 py-4 font-semibold">Review</th>
                        <th class="px-6 py-4 font-semibold text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($users as $user)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 font-medium text-gray-800">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-[#1b4332] text-white flex items-center justify-center text-xs font-bold">
                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                </div>
                                {{ $user->name }}
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-600">{{ $user->email }}</td>
                        <td class="px-6 py-4 text-gray-500 text-xs">{{ $user->created_at->format('d M Y') }}</td>
                        <td class="px-6 py-4 text-center">
                            <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded text-xs font-bold">
                                {{ $user->favorites()->count() }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-xs font-bold">
                                {{ $user->reviews()->count() }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                  onsubmit="return confirm('Yakin hapus akun {{ $user->name }}? Semua data terkait akan terhapus.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="border border-red-500 text-red-500 rounded-lg px-3 py-1.5 text-xs font-semibold hover:bg-red-500 hover:text-white transition-all flex items-center gap-1 mx-auto">
                                    <span class="material-symbols-outlined text-[14px]">delete</span>
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                            <span class="material-symbols-outlined text-5xl text-gray-300 block mb-3">group</span>
                            Belum ada user terdaftar.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>