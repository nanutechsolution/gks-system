<?php

namespace App\Http\Controllers;

use App\Models\Anggaran;
use App\Models\Keuangan;
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
}
