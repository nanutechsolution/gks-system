<!DOCTYPE html>
<html>
<head>
    <title>Laporan Realisasi Anggaran</title>
    <style>
        /* Mengadopsi font dan gaya profesional dari BKM/BKK */
        body { font-family: 'Helvetica', 'Arial', sans-serif; font-size: 11px; margin: 0; padding: 20px; }
        
        .header { text-align: center; margin-bottom: 25px; border-bottom: 2px solid #000; padding-bottom: 10px; }
        .header h2 { margin: 0; font-size: 16px; text-transform: uppercase; }
        .header h3 { margin: 5px 0 0 0; font-size: 14px; text-decoration: underline; }
        
        table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 6px 8px; text-align: left; }
        
        /* Pewarnaan dan perataan tabel */
        th { background-color: #e2e8f0; text-align: center; font-weight: bold; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .bg-gray { background-color: #f2f2f2; }
        .bg-light-gray { background-color: #f9fafb; }
        
        /* Tabel Tanda Tangan tanpa border */
        .ttd-table { border: none !important; margin-top: 10px; width: 100%; }
        .ttd-table td { border: none !important; padding: 0; }
    </style>
</head>
<body>
    @php
        // Fungsi sederhana untuk angka Romawi
        function toRoman($num) {
            $map = ['M'=>1000, 'CM'=>900, 'D'=>500, 'CD'=>400, 'C'=>100, 'XC'=>90, 'L'=>50, 'XL'=>40, 'X'=>10, 'IX'=>9, 'V'=>5, 'IV'=>4, 'I'=>1];
            $res = '';
            foreach($map as $roman => $int) {
                while($num >= $int) {
                    $res .= $roman;
                    $num -= $int;
                }
            }
            return $res;
        }
    @endphp

    <div class="header">
        <h2>BPMJ GKS JEMAAT REDA PADA</h2>
        <h3>LAPORAN REALISASI ANGGARAN TAHUN {{ $tahun }}</h3>
    </div>

    @foreach($data as $jenis => $items)
    <!-- Menyesuaikan format judul tabel seperti di dokumen foto -->
    <h4 style="margin-bottom: 8px; font-size: 12px; text-transform: uppercase;">
        {{ $jenis === 'Pendapatan' ? 'A. REALISASI PENDAPATAN' : 'B. REALISASI BELANJA' }} JEMAAT REDA PADA TAHUN {{ $tahun }}
    </h4>
    
    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="15%">Kode Pos</th>
                <th width="35%">Uraian Pos</th>
                <th width="15%">Rencana (Rp)</th>
                <th width="15%">Realisasi (Rp)</th>
                <th width="15%">Kurang/Lebih (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @php
                // Mengelompokkan item berdasarkan field kelompok_pos
                $groupedItems = $items->groupBy('kelompok_pos');
                $romanIndex = 1;
            @endphp

            @foreach($groupedItems as $kelompok => $group)
                @php
                    $isGrouped = !empty($kelompok);
                    $subRencana = 0;
                    $subRealisasi = 0;
                    $kodeKelompok = '-';

                    if ($isGrouped) {
                        // Ekstrak kode induk dari item pertama (Misal: dari 2.1.1 menjadi 2.1)
                        $firstKode = $group->first()->kode_pos;
                        if ($firstKode) {
                            $parts = explode('.', $firstKode);
                            if (count($parts) > 1) {
                                array_pop($parts); // Buang digit terakhir
                                $kodeKelompok = implode('.', $parts);
                            } else {
                                $kodeKelompok = $firstKode;
                            }
                        }
                    }
                @endphp

                <!-- Baris Header Kelompok (Hanya tampil jika ada nama kelompoknya) -->
                @if($isGrouped)
                <tr class="bg-light-gray" style="font-weight: bold;">
                    <td class="text-center">{{ toRoman($romanIndex++) }}</td>
                    <td class="text-center">{{ $kodeKelompok }}</td>
                    <td colspan="4">{{ strtoupper($kelompok) }}</td>
                </tr>
                @endif

                <!-- Looping item di dalam kelompok -->
                @foreach($group as $index => $item)
                @php 
                    $realisasi = \App\Models\Keuangan::where('kategori', $item->nama_pos)->whereYear('tanggal', $tahun)->sum('nominal');
                    $selisih = $item->target_per_tahun - $realisasi;
                    
                    $subRencana += $item->target_per_tahun;
                    $subRealisasi += $realisasi;
                @endphp
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="text-center">{{ $item->kode_pos ?? '-' }}</td>
                    <td style="{{ $isGrouped ? 'padding-left: 20px;' : '' }}">{{ $item->nama_pos }}</td>
                    <td class="text-right">{{ number_format($item->target_per_tahun, 0, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($realisasi, 0, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($selisih, 0, ',', '.') }}</td>
                </tr>
                @endforeach

                <!-- Baris Subtotal Kelompok -->
                @if($isGrouped)
                <tr style="font-weight: bold; font-style: italic;">
                    <td colspan="3" class="text-center">Jumlah {{ $kelompok }}</td>
                    <td class="text-right">{{ number_format($subRencana, 0, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($subRealisasi, 0, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($subRencana - $subRealisasi, 0, ',', '.') }}</td>
                </tr>
                @endif
            @endforeach
        </tbody>
        <tfoot>
            <tr class="bg-gray" style="font-weight: bold; font-size: 12px;">
                <td colspan="3" class="text-center">TOTAL KESELURUHAN {{ strtoupper($jenis) }}</td>
                <td class="text-right">{{ number_format($totals[$jenis]['rencana'], 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($totals[$jenis]['realisasi'], 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($totals[$jenis]['rencana'] - $totals[$jenis]['realisasi'], 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>
    @endforeach

    <!-- Bagian Tanda Tangan disesuaikan persis dengan foto fisik -->
    <div style="text-align: right; margin-top: 20px; margin-bottom: 20px;">
        Lolo Ole, {{ now()->translatedFormat('d F Y') }}
    </div>
    
    <div style="text-align: center; font-weight: bold; margin-bottom: 40px;">
        BPMJ GKS JEMAAT REDA PADA
    </div>

    <table class="ttd-table">
        <tr>
            <td width="50%" class="text-center">
                Ketua<br><br><br><br>
                <strong><u>Pdt. Alponia Malo, S.Th</u></strong>
            </td>
            <td width="50%" class="text-center">
                Sekretaris<br><br><br><br>
                <strong><u>Pnt. Benyamin T. Dona</u></strong>
            </td>
        </tr>
    </table>
</body>
</html>