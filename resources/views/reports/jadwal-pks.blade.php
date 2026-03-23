<!DOCTYPE html>
<html>
<head>
    <title>Jadwal Ibadah PKS</title>
    <style>
        body { font-family: sans-serif; font-size: 11px; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #000; padding-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; text-align: center; }
        .text-center { text-align: center; }
    </style>
</head>
<body>
    <div class="header">
        <h2 style="margin:0">JADWAL IBADAH PKS RUMAH TANGGA</h2>
        <h3 style="margin:5px 0">{{ strtoupper($sektor ?? 'SEMUA SEKTOR') }} - GKS JEMAAT REDA PADA</h3>
        <p>Bulan: {{ \Carbon\Carbon::create(null, $bulan)->translatedFormat('F') }} {{ $tahun }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="15%">Hari / Tgl</th>
                <th width="20%">Tuan Rumah</th>
                <th width="15%">Waktu</th>
                <th width="25%">Pelayan Firman (Liturgos)</th>
                <th width="20%">Tema / Bahan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jadwal as $index => $item)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $item->tanggal->translatedFormat('l, d M') }}</td>
                <td><strong>Kel. {{ $item->keluarga->nama_keluarga }}</strong></td>
                <td class="text-center">{{ $item->jam }} WITA</td>
                <td>
                    {{ $item->pelayan_firman }}<br>
                    <small>Lit: {{ $item->liturgos ?? '-' }}</small>
                </td>
                <td>{{ $item->tema ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top: 30px; text-align: right;">
        Dicetak pada: {{ now()->translatedFormat('d F Y') }}
    </div>
</body>
</html>