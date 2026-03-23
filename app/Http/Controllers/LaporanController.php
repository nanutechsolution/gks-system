<?php

namespace App\Http\Controllers;

use App\Models\Anggaran;
use App\Models\Keluarga;
use App\Models\Keuangan;
use App\Models\Pengaturan;
use App\Models\PksRumahTangga;
use App\Models\SuratKeterangan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function cetakAnggaran($tahun = 2026)
    {
        $data = Anggaran::where('tahun', $tahun)->get()->groupBy('jenis');
        $pengaturan = \App\Models\Pengaturan::first();

        // Menghitung total per jenis
        $totals = [
            'Pendapatan' => [
                'rencana' => Anggaran::where('tahun', $tahun)->where('jenis', 'Pendapatan')->sum('target_per_tahun'),
                'realisasi' => Keuangan::whereYear('tanggal', $tahun)->whereIn('kategori', Anggaran::where('jenis', 'Pendapatan')->pluck('nama_pos'))->sum('nominal'),
            ],
            'Belanja' => [
                'rencana' => Anggaran::where('tahun', $tahun)->where('jenis', 'Belanja')->sum('target_per_tahun'),
                'realisasi' => Keuangan::whereYear('tanggal', $tahun)->whereIn('kategori', Anggaran::where('jenis', 'Belanja')->pluck('nama_pos'))->sum('nominal'),
            ]
        ];

        $pdf = Pdf::loadView('reports.anggaran', compact('data', 'tahun', 'totals', 'pengaturan'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream("Laporan_Anggaran_{$tahun}.pdf");
    }

    public function cetakSuratBaptis($id)
    {
        $jemaat = \App\Models\Jemaat::findOrFail($id);

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('reports.surat-baptis', compact('jemaat'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream("Surat_Baptis_{$jemaat->nama_lengkap}.pdf");
    }

    public function cetakBuktiKas($id)
    {
        // Ambil data transaksi beserta relasi nama rekeningnya
        $transaksi = \App\Models\Keuangan::with('rekening')->findOrFail($id);

        // Tentukan judul berdasarkan jenis
        $judul = $transaksi->jenis === 'Pemasukan' ? 'BUKTI KAS MASUK (BKM)' : 'BUKTI KAS KELUAR (BKK)';

        // Load tampilan PDF
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('reports.bukti-kas', compact('transaksi', 'judul'))
            ->setPaper('a5', 'landscape'); // Ukuran A5 Landscape sangat cocok untuk bukti kas

        return $pdf->stream("Bukti_Kas_{$transaksi->referensi}_{$transaksi->tanggal->format('Ymd')}.pdf");
    }

    /**
     * Mencetak Kartu Keluarga Jemaat GKS Reda Pada.
     */
    public function cetakKartuKeluarga($id)
    {
        $keluarga = Keluarga::with(['anggota' => function ($query) {
            // Urutkan: Kepala Keluarga paling atas, lalu Istri, lalu Anak
            $query->orderByRaw("CASE 
                WHEN hubungan_keluarga = 'Kepala Keluarga' THEN 1 
                WHEN hubungan_keluarga = 'Istri' THEN 2 
                WHEN hubungan_keluarga = 'Anak' THEN 3 
                ELSE 4 END");
        }])->findOrFail($id);

        $pengaturan = Pengaturan::first();

        $pdf = Pdf::loadView('reports.kartu-keluarga', compact('keluarga', 'pengaturan'))
            ->setPaper('a4', 'landscape'); // Format Landscape agar kolom muat banyak

        return $pdf->stream("KK_{$keluarga->nama_keluarga}.pdf");
    }

    public function cetakSuratKeterangan($id)
    {
        $surat = SuratKeterangan::with('jemaat')->findOrFail($id);
        $pengaturan = Pengaturan::first();

        $pdf = Pdf::loadView('reports.surat-keterangan', compact('surat', 'pengaturan'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream("Surat_{$surat->jenis_surat}_{$surat->jemaat->nama_lengkap}.pdf");
    }

    public function cetakJadwalPks(Request $request)
    {
        $bulan = $request->bulan ?? now()->month;
        $tahun = $request->tahun ?? now()->year;
        $sektor = $request->sektor;

        $jadwal = PksRumahTangga::with('keluarga')
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->when($sektor, fn($q) => $q->where('sektor', $sektor))
            ->orderBy('tanggal', 'asc')
            ->get();

        $pdf = Pdf::loadView('reports.jadwal-pks', compact('jadwal', 'bulan', 'tahun', 'sektor'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream("Jadwal_PKS_{$bulan}_{$tahun}.pdf");
    }
}
