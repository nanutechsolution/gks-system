<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Keterangan - {{ $surat->jemaat->nama_lengkap }}</title>
    <style>
        body { font-family: 'Times New Roman', serif; line-height: 1.6; color: #000; margin: 0; padding: 0; }
        .page { padding: 40px; }
        
        /* Kop Surat */
        .header { text-align: center; border-bottom: 3px solid #000; padding-bottom: 10px; margin-bottom: 20px; }
        .header h1 { margin: 0; font-size: 18px; text-transform: uppercase; }
        .header h2 { margin: 5px 0; font-size: 20px; text-transform: uppercase; }
        .header p { margin: 0; font-size: 12px; font-style: italic; }

        /* Judul Surat */
        .title-box { text-align: center; margin-bottom: 30px; }
        .title-box h3 { margin: 0; text-decoration: underline; text-transform: uppercase; font-size: 16px; }
        .title-box p { margin: 5px 0 0 0; font-size: 13px; }

        /* Isi Surat */
        .content { font-size: 14px; text-align: justify; }
        .content p { margin-bottom: 15px; }
        .data-table { width: 100%; margin: 20px 0; }
        .data-table td { padding: 3px 0; vertical-align: top; }
        .data-table td.label { width: 180px; }
        .data-table td.colon { width: 20px; text-align: center; }

        /* Footer / Tanda Tangan */
        .footer { margin-top: 50px; width: 100%; }
        .footer td { width: 50%; text-align: center; vertical-align: top; }
        .signature-space { height: 80px; }
    </style>
</head>
<body>
    <div class="page">
        <!-- Kop Surat Dinamis -->
        <div class="header">
            <h1>{{ $pengaturan->nama_gereja ?? 'GEREJA KRISTEN SUMBA (GKS)' }}</h1>
            <h2>BPMJ {{ $pengaturan->nama_jemaat ?? 'JEMAAT REDA PADA' }}</h2>
            <p>{{ $pengaturan->alamat_lengkap ?? 'Alamat belum diatur di menu Pengaturan Gereja' }}</p>
        </div>

        <!-- Judul & Nomor Surat -->
        <div class="title-box">
            <h3>
                @if($surat->jenis_surat === 'Pindah')
                    SURAT KETERANGAN PINDAH ANGGOTA JEMAAT
                @elseif($surat->jenis_surat === 'Anggota Aktif')
                    SURAT KETERANGAN ANGGOTA JEMAAT
                @elseif($surat->jenis_surat === 'Rekomendasi Nikah')
                    SURAT REKOMENDASI PERNIKAHAN
                @else
                    SURAT KETERANGAN GEREJAWI
                @endif
            </h3>
            <p>Nomor: {{ $surat->nomor_surat }}</p>
        </div>

        <div class="content">
            <p>Majelis Jemaat {{ $pengaturan->nama_jemaat ?? 'GKS Reda Pada' }} dengan ini menerangkan bahwa:</p>

            <table class="data-table">
                <tr>
                    <td class="label">Nama Lengkap</td>
                    <td class="colon">:</td>
                    <td><strong>{{ strtoupper($surat->jemaat->nama_lengkap) }}</strong></td>
                </tr>
                <tr>
                    <td class="label">Tempat, Tanggal Lahir</td>
                    <td class="colon">:</td>
                    <td>{{ $surat->jemaat->tempat_lahir ?? '-' }}, {{ $surat->jemaat->tanggal_lahir ? $surat->jemaat->tanggal_lahir->translatedFormat('d F Y') : '-' }}</td>
                </tr>
                <tr>
                    <td class="label">Jenis Kelamin</td>
                    <td class="colon">:</td>
                    <td>{{ $surat->jemaat->jenis_kelamin }}</td>
                </tr>
                <tr>
                    <td class="label">Alamat Asal</td>
                    <td class="colon">:</td>
                    <td>{{ $surat->jemaat->alamat ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="label">Status Sakramen</td>
                    <td class="colon">:</td>
                    <td>
                        {{ $surat->jemaat->status_baptis ? 'Sudah Baptis' : 'Belum Baptis' }} / 
                        {{ $surat->jemaat->status_sidi ? 'Sudah Sidi' : 'Belum Sidi' }}
                    </td>
                </tr>
            </table>

            <!-- Narasi Dinamis Berdasarkan Jenis Surat -->
            @if($surat->jenis_surat === 'Pindah')
                <p>Nama yang tercantum di atas adalah benar anggota jemaat kami yang terdaftar di <strong>{{ $surat->jemaat->sektor ?? 'Sektor Jemaat' }}</strong>. Terhitung sejak tanggal surat ini dikeluarkan, yang bersangkutan telah menyatakan pindah ke:</p>
                <p style="padding-left: 20px;"><strong>{{ $surat->tujuan_surat }}</strong></p>
                <p>Dengan alasan: <em>{{ $surat->keperluan ?? 'Kepentingan keluarga/pekerjaan' }}</em>. Demikian surat keterangan ini diberikan agar dapat diterima sebagai anggota jemaat di tempat tujuan.</p>
            @elseif($surat->jenis_surat === 'Anggota Aktif')
                <p>Bahwa nama tersebut di atas adalah benar anggota jemaat <strong>{{ $pengaturan->nama_jemaat ?? 'GKS Reda Pada' }}</strong> yang terdaftar dan aktif dalam kegiatan pelayanan gerejawi.</p>
                <p>Surat keterangan ini diberikan atas permintaan yang bersangkutan untuk keperluan: <strong>{{ $surat->keperluan ?? '-' }}</strong> yang ditujukan kepada <strong>{{ $surat->tujuan_surat }}</strong>.</p>
            @elseif($surat->jenis_surat === 'Rekomendasi Nikah')
                <p>Bahwa nama tersebut di atas bermaksud untuk melangsungkan pernikahan dengan calon pasangannya di <strong>{{ $surat->tujuan_surat }}</strong>.</p>
                <p>Berdasarkan catatan kami, yang bersangkutan tidak memiliki halangan gerejawi untuk melangsungkan pernikahan tersebut. Mohon kiranya dapat dibantu dalam proses selanjutnya.</p>
            @else
                <p>{{ $surat->keperluan }}</p>
            @endif

            <p>Demikian surat keterangan ini kami buat dengan sebenarnya untuk dipergunakan sebagaimana mestinya. Kiranya Tuhan Yesus Sang Kepala Gereja senantiasa memberkati kita semua.</p>
        </div>

        <!-- Bagian Tanda Tangan -->
        <div style="margin-top: 40px;">
            <table class="footer">
                <tr>
                    <td></td>
                    <td>
                        {{ $pengaturan->kota_surat ?? 'Lolo Ole' }}, {{ $surat->tanggal_surat->translatedFormat('d F Y') }}<br>
                        <strong>Badan Pelaksana Majelis Jemaat</strong><br>
                        Ketua,<br>
                        <div class="signature-space"></div>
                        <strong><u>{{ $pengaturan->nama_ketua_majelis ?? 'Pdt. Alponia Malo, S.Th' }}</u></strong>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>