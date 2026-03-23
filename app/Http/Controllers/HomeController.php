<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\JadwalIbadah;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Mengambil 3 jadwal ibadah terdekat mulai dari hari ini
        $jadwalIbadah = JadwalIbadah::where('waktu_mulai', '>=', now())
            ->orderBy('waktu_mulai', 'asc')
            ->take(3)
            ->get();

        // Mengambil 3 berita terbaru yang statusnya dipublish
        $beritaTerbaru = Berita::where('is_published', true)
            ->orderBy('tanggal_publish', 'desc')
            ->take(3)
            ->get();

        return view('welcome', compact('jadwalIbadah', 'beritaTerbaru'));
    }
}
