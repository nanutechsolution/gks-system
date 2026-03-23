<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $pengaturan->nama_jemaat ?? 'GKS Reda Pada' }} - Official Website</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900">

    <!-- Navbar Dinamis -->
    <nav class="bg-white/80 backdrop-blur-md shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex items-center gap-3">
                    @if($pengaturan?->logo_gereja)
                        <img src="{{ asset('storage/' . $pengaturan->logo_gereja) }}" alt="Logo" class="h-12 w-auto">
                    @endif
                    <div class="flex flex-col">
                        <span class="font-bold text-lg leading-tight text-blue-900">{{ $pengaturan->nama_gereja ?? 'GKS' }}</span>
                        <span class="text-sm font-semibold text-slate-500 uppercase tracking-wider">{{ $pengaturan->nama_jemaat ?? 'JEMAAT REDA PADA' }}</span>
                    </div>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#" class="text-slate-600 hover:text-blue-600 font-semibold transition">Beranda</a>
                    <a href="#jadwal" class="text-slate-600 hover:text-blue-600 font-semibold transition">Ibadah</a>
                    <a href="#pks" class="text-slate-600 hover:text-blue-600 font-semibold transition">PKS</a>
                    <a href="#berita" class="text-slate-600 hover:text-blue-600 font-semibold transition">Berita</a>
                    <a href="/admin" class="bg-blue-600 text-white px-6 py-2.5 rounded-full hover:bg-blue-700 transition font-bold text-sm shadow-lg shadow-blue-200">Portal Jemaat</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="relative bg-blue-950 text-white overflow-hidden py-24 lg:py-32">
        <div class="absolute inset-0 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
        <div class="relative max-w-7xl mx-auto px-4 text-center">
            <span class="inline-block px-4 py-1.5 bg-blue-500/20 rounded-full text-blue-300 text-sm font-bold mb-6 tracking-widest uppercase italic">Shalom & Selamat Datang</span>
            <h1 class="text-4xl md:text-6xl font-extrabold tracking-tight mb-6 leading-tight">
                Bertumbuh Bersama Dalam <br> <span class="text-blue-400">Kasih Kristus</span>
            </h1>
            <p class="text-lg md:text-xl text-blue-100 max-w-2xl mx-auto mb-10 leading-relaxed">
                Menjadi jemaat yang misioner, mandiri, dan inklusif di tengah pelayanan {{ $pengaturan->nama_jemaat ?? 'GKS Reda Pada' }}.
            </p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            
            <!-- Kolom Kiri: Berita (8 Kolom) -->
            <div class="lg:col-span-8 space-y-12" id="berita">
                <div>
                    <h2 class="text-3xl font-extrabold text-slate-900 mb-2">Warta Jemaat</h2>
                    <p class="text-slate-500">Berita dan pengumuman terbaru seputar kegiatan gereja.</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @forelse($beritaTerbaru as $berita)
                        <div class="group bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden hover:shadow-xl transition-all duration-300">
                            <div class="relative overflow-hidden h-52">
                                @if($berita->gambar_sampul)
                                    <img src="{{ asset('storage/' . $berita->gambar_sampul) }}" alt="{{ $berita->judul }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                @else
                                    <div class="w-full h-full bg-slate-100 flex items-center justify-center text-slate-400 font-bold uppercase tracking-widest text-xs">No Image</div>
                                @endif
                            </div>
                            <div class="p-6">
                                <div class="flex items-center gap-2 mb-3">
                                    <span class="px-2.5 py-1 bg-blue-100 text-blue-700 text-[10px] font-bold uppercase rounded">{{ \Carbon\Carbon::parse($berita->tanggal_publish)->translatedFormat('d M Y') }}</span>
                                </div>
                                <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-blue-600 transition">{{ $berita->judul }}</h3>
                                <p class="text-slate-600 text-sm mb-5 line-clamp-2 leading-relaxed">{{ $berita->ringkasan }}</p>
                                <a href="#" class="inline-flex items-center font-bold text-sm text-blue-600 group-hover:gap-2 transition-all">Baca Selengkapnya <span>&rarr;</span></a>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full py-12 text-center bg-white rounded-2xl border border-dashed border-slate-300 italic text-slate-400">Belum ada berita terbaru saat ini.</div>
                    @endforelse
                </div>
            </div>

            <!-- Kolom Kanan: Jadwal (4 Kolom) -->
            <div class="lg:col-span-4 space-y-10">
                
                <!-- Jadwal Ibadah Raya -->
                <div id="jadwal">
                    <h2 class="text-xl font-extrabold text-slate-900 mb-6 flex items-center gap-2">
                        <span class="w-8 h-8 bg-blue-600 text-white rounded-lg flex items-center justify-center text-xs">⛪</span>
                        Ibadah Minggu
                    </h2>
                    <div class="space-y-4">
                        @forelse($jadwalIbadah as $jadwal)
                            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm hover:border-blue-300 transition group">
                                <h3 class="font-bold text-slate-900 group-hover:text-blue-600 transition">{{ $jadwal->nama_ibadah }}</h3>
                                <div class="mt-3 space-y-2 text-sm">
                                    <div class="flex items-center text-slate-500">
                                        <span class="mr-3">📅</span> {{ \Carbon\Carbon::parse($jadwal->waktu_mulai)->translatedFormat('l, d M Y') }}
                                    </div>
                                    <div class="flex items-center text-slate-900 font-semibold">
                                        <span class="mr-3">⏰</span> {{ \Carbon\Carbon::parse($jadwal->waktu_mulai)->format('H:i') }} WITA
                                    </div>
                                    <div class="flex items-center text-slate-500">
                                        <span class="mr-3">👤</span> {{ $jadwal->pengkhotbah }}
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-sm text-slate-400 italic">Jadwal belum tersedia.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Jadwal PKS Rumah Tangga -->
                <div id="pks">
                    <h2 class="text-xl font-extrabold text-slate-900 mb-6 flex items-center gap-2">
                        <span class="w-8 h-8 bg-emerald-600 text-white rounded-lg flex items-center justify-center text-xs">🏠</span>
                        Ibadah PKS
                    </h2>
                    <div class="space-y-4">
                        @forelse($jadwalPks as $pks)
                            <div class="bg-emerald-50/50 p-5 rounded-2xl border border-emerald-100 hover:bg-emerald-50 transition">
                                <div class="text-[10px] font-bold text-emerald-700 uppercase mb-1 tracking-widest">{{ $pks->sektor ?? 'Sektor' }}</div>
                                <h3 class="font-bold text-slate-900 italic">Kel. {{ $pks->keluarga->nama_keluarga }}</h3>
                                <div class="mt-2 text-xs text-slate-600">
                                    <div>🗓️ {{ $pks->tanggal->translatedFormat('d M Y') }} | {{ $pks->jam }}</div>
                                    <div class="mt-1 font-medium text-slate-900">🎙️ {{ $pks->pelayan_firman }}</div>
                                </div>
                            </div>
                        @empty
                            <p class="text-sm text-slate-400 italic">Belum ada jadwal PKS.</p>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Footer Dinamis -->
    <footer class="bg-white border-t border-slate-200 pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-3 gap-12 mb-12">
            <div>
                <h4 class="font-bold text-blue-900 mb-4">{{ $pengaturan->nama_gereja ?? 'GKS' }} {{ $pengaturan->nama_jemaat ?? 'Reda Pada' }}</h4>
                <p class="text-sm text-slate-500 leading-relaxed">{{ $pengaturan->alamat_lengkap ?? 'Alamat gereja belum dikonfigurasi.' }}</p>
            </div>
            <div>
                <h4 class="font-bold text-slate-900 mb-4">Pelayanan Cepat</h4>
                <ul class="text-sm text-slate-500 space-y-2">
                    <li><a href="/admin/login" class="hover:text-blue-600">Login Admin</a></li>
                    <li><a href="#" class="hover:text-blue-600">Permohonan Surat Keterangan</a></li>
                    <li><a href="#" class="hover:text-blue-600">Daftar Jemaat Baru</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold text-slate-900 mb-4">Pimpinan Jemaat</h4>
                <p class="text-sm text-slate-500">Ketua: <strong>{{ $pengaturan->nama_ketua_majelis ?? '-' }}</strong></p>
                <p class="text-sm text-slate-500 mt-1">Sekretaris: <strong>{{ $pengaturan->nama_sekretaris ?? '-' }}</strong></p>
            </div>
        </div>
        <div class="text-center text-xs text-slate-400 border-t border-slate-100 pt-8">
            &copy; {{ date('Y') }} {{ $pengaturan->nama_jemaat ?? 'GKS Reda Pada' }}. Sistem Informasi Manajemen Gereja.
        </div>
    </footer>

</body>
</html>