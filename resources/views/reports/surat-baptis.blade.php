<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Times New Roman', serif; padding: 40px; border: 5px double #000; height: 90%; }
        .header { text-align: center; border-bottom: 2px solid #000; padding-bottom: 10px; }
        .title { text-align: center; margin-top: 30px; text-decoration: underline; }
        .content { margin-top: 40px; line-height: 2; font-size: 16px; }
        .footer { margin-top: 60px; float: right; text-align: center; }
    </style>
</head>
<body>
    <div class="header">
        <h2 style="margin:0">GEREJA KRISTEN SUMBA (GKS)</h2>
        <h3 style="margin:0">JEMAAT REDA PADA</h3>
        <p style="margin:0">Alamat: [Alamat Lengkap Gereja]</p>
    </div>

    <div class="title">
        <h2>SURAT PIAGAM BAPTIS KUDUS</h2>
    </div>

    <div class="content">
        Menerangkan bahwa:<br>
        <strong>Nama:</strong> {{ $jemaat->nama_lengkap }}<br>
        <strong>Tempat/Tgl Lahir:</strong> {{ $jemaat->tempat_lahir }}, {{ $jemaat->tanggal_lahir?->format('d F Y') }}<br>
        <br>
        Telah menerima <strong>BAPTISAN KUDUS</strong> pada:<br>
        <strong>Hari/Tanggal:</strong> {{ \Carbon\Carbon::parse($jemaat->tanggal_baptis)->translatedFormat('l, d F Y') }}<br>
        <strong>Tempat:</strong> {{ $jemaat->tempat_baptis ?? 'GKS Jemaat Reda Pada' }}<br>
        <strong>Oleh Pelayan Firman:</strong> {{ $jemaat->pendeta_baptis }}
    </div>

    <div class="footer">
        Reda Pada, {{ now()->translatedFormat('d F Y') }}<br>
        Ketua Majelis Jemaat,<br><br><br><br>
        <strong>Pdt. Alponia Malo, S.Th</strong>
    </div>
</body>
</html>
