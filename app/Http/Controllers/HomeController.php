<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\JadwalIbadah;
use App\Models\PksRumahTangga;
use App\Models\Pengaturan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Menampilkan halaman depan website dengan data dinamis.
     */
    public function index()
    {
        // 1. Ambil Pengaturan Profil Gereja
        $pengaturan = Pengaturan::first();

        // 2. Ambil 3 Jadwal Ibadah Raya terdekat
        $jadwalIbadah = JadwalIbadah::where('waktu_mulai', '>=', now())
            ->orderBy('waktu_mulai', 'asc')
            ->take(3)
            ->get();

        // 3. Ambil 3 Berita/Pengumuman terbaru yang sudah dipublish
        $beritaTerbaru = Berita::where('is_published', true)
            ->orderBy('tanggal_publish', 'desc')
            ->take(3)
            ->get();

        // 4. Ambil 3 Jadwal PKS Rumah Tangga terdekat
        $jadwalPks = PksRumahTangga::with('keluarga')
            ->where('tanggal', '>=', now()->toDateString())
            ->orderBy('tanggal', 'asc')
            ->take(3)
            ->get();

        return view('welcome', compact('pengaturan', 'jadwalIbadah', 'beritaTerbaru', 'jadwalPks'));
    }
}