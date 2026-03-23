

<!DOCTYPE html>
<html>
<head>
    <title>{{ $judul }}</title>
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; font-size: 12px; margin: 0; padding: 20px; }
        .container { border: 2px solid #000; padding: 20px; position: relative; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #000; padding-bottom: 10px; }
        .header h2 { margin: 0; font-size: 16px; text-transform: uppercase; }
        .header h3 { margin: 5px 0 0 0; font-size: 18px; text-decoration: underline; }
        .no-ref { position: absolute; top: 20px; right: 20px; font-weight: bold; }
        
        .content-table { width: 100%; margin-bottom: 20px; }
        .content-table td { padding: 8px 0; vertical-align: top; }
        .content-table td.label { width: 150px; font-weight: bold; }
        .content-table td.colon { width: 20px; text-align: center; }
        
        .box-nominal { 
            background-color: #f0f0f0; 
            padding: 15px; 
            font-size: 16px; 
            font-weight: bold; 
            border: 1px solid #000;
            margin: 10px 0;
        }

        .signatures { width: 100%; margin-top: 30px; text-align: center; }
        .signatures td { width: 33%; padding-top: 50px; }
    </style>
</head>
<body>
    @php
        // Fungsi Rekursif untuk membaca angka (Terbilang)
        function penyebut($nilai) {
            $nilai = abs($nilai);
            $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
            $temp = "";
            if ($nilai < 12) {
                $temp = " ". $huruf[$nilai];
            } else if ($nilai < 20) {
                $temp = penyebut($nilai - 10). " belas";
            } else if ($nilai < 100) {
                $temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
            } else if ($nilai < 200) {
                $temp = " seratus" . penyebut($nilai - 100);
            } else if ($nilai < 1000) {
                $temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
            } else if ($nilai < 2000) {
                $temp = " seribu" . penyebut($nilai - 1000);
            } else if ($nilai < 1000000) {
                $temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
            } else if ($nilai < 1000000000) {
                $temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
            } else if ($nilai < 1000000000000) {
                $temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
            } else if ($nilai < 1000000000000000) {
                $temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
            }
            return $temp;
        }

        function terbilang($nilai) {
            if($nilai < 0) {
                $hasil = "minus ". trim(penyebut($nilai));
            } else {
                $hasil = trim(penyebut($nilai));
            }
            return ucwords($hasil) . " Rupiah";
        }
    @endphp

    <div class="container">
        <div class="header">
            <h2>GEREJA KRISTEN SUMBA (GKS) JEMAAT REDA PADA</h2>
            <h3>{{ $judul }}</h3>
        </div>
        
        <div class="no-ref">
            No: {{ $transaksi->referensi ?? '...................' }}
        </div>

        <table class="content-table">
            <tr>
                <td class="label">Tanggal Transaksi</td>
                <td class="colon">:</td>
                <td>{{ $transaksi->tanggal->translatedFormat('d F Y') }}</td>
            </tr>
            <tr>
                <td class="label">{{ $transaksi->jenis === 'Pemasukan' ? 'Diterima Dari' : 'Dibayarkan Kepada' }}</td>
                <td class="colon">:</td>
                <td style="border-bottom: 1px dotted #000;">&nbsp;</td>
            </tr>
            <tr>
                <td class="label">Pos Anggaran (Kategori)</td>
                <td class="colon">:</td>
                <td>{{ $transaksi->kategori }}</td>
            </tr>
            <tr>
                <td class="label">Sumber / Tujuan Kas</td>
                <td class="colon">:</td>
                <td>{{ $transaksi->rekening ? $transaksi->rekening->nama_kas : 'Kas Tunai' }}</td>
            </tr>
            <tr>
                <td class="label">Uraian Keterangan</td>
                <td class="colon">:</td>
                <td>{{ $transaksi->keterangan ?? '-' }}</td>
            </tr>
        </table>

        <div class="box-nominal">
            <div style="font-size: 18px; margin-bottom: 8px;">
                Jumlah Uang: Rp {{ number_format($transaksi->nominal, 0, ',', '.') }}
            </div>
            <div style="font-size: 13px; font-weight: normal; font-style: italic; border-top: 1px dashed #999; padding-top: 8px;">
                Terbilang: # {{ terbilang($transaksi->nominal) }} #
            </div>
        </div>

        <table class="signatures">
            <tr>
                <td>
                    Mengetahui / Menyetujui,<br>
                    <strong>Ketua Majelis Jemaat</strong>
                    <br><br><br><br>
                    ( ......................................... )
                </td>
                <td>
                    Lunas Dibayar / Diterima,<br>
                    <strong>Bendahara Jemaat</strong>
                    <br><br><br><br>
                    ( ......................................... )
                </td>
                <td>
                    <br>
                    <strong>Penerima / Penyetor</strong>
                    <br><br><br><br>
                    ( ......................................... )
                </td>
            </tr>
        </table>
    </div>
</body>
</html>

