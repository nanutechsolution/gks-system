<!DOCTYPE html>
<html>
<head>
    <title>Kartu Keluarga Jemaat</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; font-size: 10px; margin: 0; padding: 10px; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h1 { margin: 0; font-size: 18px; text-transform: uppercase; letter-spacing: 2px; }
        .header h2 { margin: 5px 0; font-size: 14px; }
        
        .info-table { width: 100%; margin-bottom: 15px; }
        .info-table td { padding: 2px; }
        
        table.data-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        table.data-table th, table.data-table td { border: 1px solid #000; padding: 5px; text-align: left; }
        table.data-table th { background-color: #f2f2f2; text-align: center; }

        .footer { width: 100%; margin-top: 30px; }
        .footer td { vertical-align: top; text-align: center; }
    </style>
</head>
<body>
    <div class="header">
        <h1>KARTU KELUARGA JEMAAT</h1>
        <h2>{{ $pengaturan->nama_gereja ?? 'GEREJA KRISTEN SUMBA' }} - {{ $pengaturan->nama_jemaat ?? 'JEMAAT REDA PADA' }}</h2>
        <p>No. Kartu Keluarga: <strong>{{ $keluarga->nomor_kk }}</strong></p>
    </div>

    <table class="info-table">
        <tr>
            <td width="15%">Nama Keluarga</td>
            <td width="2%">:</td>
            <td width="33%"><strong>{{ strtoupper($keluarga->nama_keluarga) }}</strong></td>
            <td width="15%">Sektor/Wilayah</td>
            <td width="2%">:</td>
            <td width="33%">{{ $keluarga->sektor ?? '-' }}</td>
        </tr>
        <tr>
            <td>Alamat Rumah</td>
            <td>:</td>
            <td>{{ $keluarga->alamat_kk }}</td>
            <td>Kota/Kabupaten</td>
            <td>:</td>
            <td>{{ $pengaturan->kota_surat ?? 'Sumba Barat Daya' }}</td>
        </tr>
    </table>

    <table class="data-table">
        <thead>
            <tr>
                <th width="3%">No</th>
                <th width="20%">Nama Lengkap</th>
                <th width="10%">Hubungan</th>
                <th width="8%">L/P</th>
                <th width="15%">Tempat, Tgl Lahir</th>
                <th width="10%">Baptis</th>
                <th width="10%">Sidi</th>
                <th width="12%">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($keluarga->anggota as $index => $item)
            <tr>
                <td align="center">{{ $index + 1 }}</td>
                <td><strong>{{ $item->nama_lengkap }}</strong></td>
                <td align="center">{{ $item->hubungan_keluarga }}</td>
                <td align="center">{{ $item->jenis_kelamin === 'Laki-laki' ? 'L' : 'P' }}</td>
                <td>{{ $item->tempat_lahir }}, {{ $item->tanggal_lahir?->format('d-m-Y') }}</td>
                <td align="center">{{ $item->status_baptis ? 'Sudah' : 'Belum' }}</td>
                <td align="center">{{ $item->status_sidi ? 'Sudah' : 'Belum' }}</td>
                <td align="center">{{ $item->status_anggota }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <table class="footer">
        <tr>
            <td width="30%">
                Dicetak pada:<br>
                {{ now()->translatedFormat('d F Y') }}
            </td>
            <td width="40%"></td>
            <td width="30%">
                Ketua Majelis Jemaat,<br><br><br><br>
                <strong><u>{{ $pengaturan->nama_ketua_majelis ?? 'Pdt. Alponia Malo, S.Th' }}</u></strong>
            </td>
        </tr>
    </table>
</body>
</html>