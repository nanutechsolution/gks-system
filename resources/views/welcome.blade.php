<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gereja Kristen Sumba (GKS)</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="[https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap](https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap)" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-800">

    <!-- Navbar -->
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center">
                    <span class="font-bold text-2xl text-blue-800 tracking-tight">GKS Waingapu</span>
                </div>
                <div class="hidden md:flex space-x-8">
                    <a href="#" class="text-slate-600 hover:text-blue-600 font-medium">Beranda</a>
                    <a href="#jadwal" class="text-slate-600 hover:text-blue-600 font-medium">Jadwal Ibadah</a>
                    <a href="#berita" class="text-slate-600 hover:text-blue-600 font-medium">Berita</a>
                    <a href="/admin" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition font-medium text-sm">Portal Admin</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="relative bg-blue-900 text-white overflow-hidden">
        <!-- Overlay Background -->
        <div class="absolute inset-0 bg-blue-900 opacity-90"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 md:py-32 text-center">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold tracking-tight mb-6">
                Selamat Datang di <br> Gereja Kristen Sumba
            </h1>
            <p class="text-lg md:text-xl text-blue-100 max-w-2xl mx-auto mb-10">
                Terang yang bersinar di pulau Sumba. Mari bertumbuh bersama dalam iman, pengharapan, dan kasih Kristus.
            </p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">

            <!-- Kolom Kiri: Berita (Lebar 2/3) -->
            <div class="lg:col-span-2" id="berita">
                <h2 class="text-2xl font-bold text-slate-900 mb-6 border-b pb-2">Berita & Pengumuman Terbaru</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @forelse($beritaTerbaru as $berita)
                    <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden hover:shadow-md transition">
                        @if($berita->gambar_sampul)
                        <img src="{{ asset('storage/' . $berita->gambar_sampul) }}" alt="{{ $berita->judul }}" class="w-full h-48 object-cover">
                        @else
                        <div class="w-full h-48 bg-slate-200 flex items-center justify-center text-slate-400">
                            [Gambar Tidak Tersedia]
                        </div>
                        @endif
                        <div class="p-5">
                            <p class="text-xs text-blue-600 font-semibold mb-2">{{ \Carbon\Carbon::parse($berita->tanggal_publish)->format('d M Y') }}</p>
                            <h3 class="text-lg font-bold text-slate-900 mb-2">{{ $berita->judul }}</h3>
                            <p class="text-sm text-slate-600 mb-4 line-clamp-3">{{ $berita->ringkasan }}</p>
                            <a href="#" class="text-blue-600 text-sm font-medium hover:underline">Baca selengkapnya &rarr;</a>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-full bg-blue-50 text-blue-800 p-4 rounded-lg text-center">
                        Belum ada berita atau pengumuman saat ini.
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Kolom Kanan: Jadwal Ibadah (Lebar 1/3) -->
            <div id="jadwal">
                <h2 class="text-2xl font-bold text-slate-900 mb-6 border-b pb-2">Jadwal Ibadah Terdekat</h2>

                <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6">
                    <div class="space-y-6">
                        @forelse($jadwalIbadah as $jadwal)
                        <div class="border-l-4 border-blue-600 pl-4">
                            <h3 class="text-lg font-bold text-slate-900">{{ $jadwal->nama_ibadah }}</h3>
                            <div class="mt-2 space-y-1 text-sm text-slate-600">
                                <p class="flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    {{ \Carbon\Carbon::parse($jadwal->waktu_mulai)->translatedFormat('l, d F Y - H:i') }}
                                </p>
                                <p class="flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    {{ $jadwal->pengkhotbah }}
                                </p>
                                <p class="flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    {{ $jadwal->lokasi }}
                                </p>
                            </div>
                        </div>
                        @empty
                        <p class="text-sm text-slate-500 text-center">Belum ada jadwal ibadah terdekat.</p>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-slate-900 text-slate-400 py-8 text-center">
        <p>&copy; 2026 Gereja Kristen Sumba. Hak Cipta Dilindungi.</p>
    </footer>

</body>

</html>