@php
    $appConfig = \App\Models\Konfigurasi::pluck('nilai', 'kunci')->toArray();
    
    // Handle logo source (use base64 if PDF, otherwise use asset URL)
    if (isset($isPdf) && $isPdf && isset($logoBase64)) {
        $logoUrl = $logoBase64;
    } else {
        $logoUrl = !empty($appConfig['logo_path']) ? asset($appConfig['logo_path']) : asset('images/spmb-logo.png');
    }

    // QR Code for PDF (SVG format - avoid Imagick dependency)
    if (isset($isPdf) && $isPdf) {
        $qrCode = QrCode::size(100)->margin(1)->generate($pendaftaran->nomor_pendaftaran);
    }
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Pendaftaran - {{ $pendaftaran->nomor_pendaftaran }}</title>
    <style>
        @page {
            size: A4;
            margin: 0;
        }
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
            background-color: #f8f9fa;
        }
        .card-container {
            border: 2px solid #000;
            padding: 30px;
            max-width: 800px;
            width: 95%;
            margin: 20px auto;
            position: relative;
            background-color: #fff;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        .header-table {
            width: 100%;
            border-bottom: 3px double #000;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-collapse: collapse;
        }
        .header-table td {
            vertical-align: middle;
        }
        .header-logo {
            width: 110px;
            text-align: center;
        }
        .header-logo img {
            max-height: 100px;
            max-width: 100px;
        }
        .header-text {
            text-align: center;
            padding-right: 50px;
        }
        .header h1 {
            margin: 0 0 5px 0;
            font-size: clamp(14px, 4vw, 18px);
            text-transform: uppercase;
        }
        .header h2 {
            margin: 0 0 5px 0;
            font-size: clamp(12px, 3.5vw, 16px);
        }
        .header p {
            margin: 0;
            font-size: clamp(10px, 2.5vw, 11px);
            line-height: 1.4;
        }
        .content {
            margin-top: 20px;
        }
        .registration-number {
            text-align: center;
            margin-bottom: 30px;
        }
        .registration-number h3 {
            margin: 0;
            font-size: 14px;
            color: #666;
        }
        .registration-number div {
            font-size: clamp(20px, 6vw, 24px);
            font-weight: bold;
            padding: 10px 15px;
            border: 2px dashed #000;
            display: inline-block;
            margin-top: 10px;
            letter-spacing: 2px;
            background: #fff;
        }
        .data-table {
            width: 100%;
            border-collapse: collapse;
        }
        .data-table td {
            padding: 8px 5px;
            vertical-align: top;
            font-size: clamp(12px, 3.5vw, 14px);
        }
        .label {
            width: 30%;
            min-width: 120px;
            font-weight: bold;
        }
        .separator {
            width: 10px;
        }
        .footer-table {
            width: 100%;
            margin-top: 40px;
            border-collapse: collapse;
        }
        .signature {
            text-align: center;
            width: 250px;
            font-size: clamp(12px, 3.5vw, 14px);
        }
        .signature-space {
            height: 60px;
        }
        
        /* Actions Bar */
        .actions-btn {
            position: sticky;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            background: #fff;
            padding: 15px;
            border-bottom: 1px solid #ddd;
            display: flex;
            justify-content: center;
            gap: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 20px;
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            text-decoration: none;
            font-weight: bold;
            transition: all 0.2s;
            flex: 1;
            max-width: 200px;
        }
        .btn-print { background: #6c757d; }
        .btn-download { background: #007bff; }
        .btn-download:hover { background: #0056b3; }
        
        .photo-container {
            width: 120px;
            height: 160px;
            border: 1px solid #000;
            padding: 2px;
            background: #fff;
            margin: 0 auto;
        }
        .photo-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .photo-placeholder {
            width: 100%;
            height: 100%;
            border: 1px dashed #ccc;
            background: #fdfdfd;
            color: #999;
            font-size: 10px;
            text-align: center;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        
        @media print {
            body { background-color: #fff; padding: 0; margin: 10px; }
            .card-container { 
                width: 100%; 
                max-width: none; 
                border-radius: 0; 
                box-shadow: none; 
                margin: 0 auto; 
                padding: 0; 
                border: none;
                transform: scale(0.9);
                transform-origin: top center;
            }
            .actions-btn { display: none; }
        }

        /* Khusus untuk PDF - DomPDF lebih stabil dengan ukuran fixed daripada scale */
        @if(isset($isPdf) && $isPdf)
        body {
            padding: 0;
            margin: 0;
            background-color: #fff;
        }
        .card-container {
            width: 580px; 
            margin: 50px auto; /* Tambahkan margin 50px di atas agar tidak mepet */
            padding: 20px;
            box-shadow: none;
            border: 1.5px solid #000;
            transform: none; 
        }
        .header h1 { font-size: 16px; }
        .header h2 { font-size: 14px; }
        .header p { font-size: 10px; }
        .data-table td { font-size: 12px; padding: 5px 5px; }
        .registration-number div { font-size: 20px; padding: 5px 10px; }
        .signature { font-size: 12px; width: 220px; }
        .photo-container { width: 100px; height: 133px; }
        @endif

        @media (max-width: 600px) {
            body { padding: 10px; }
            .card-container { padding: 15px; }
            .header-text { padding-right: 0; }
            .header-logo { width: 80px; }
            .header-logo img { max-height: 70px; max-width: 70px; }
            .label { width: 35%; }
            .content-wrapper td { display: block; width: 100% !important; }
            .photo-col { margin-top: 20px; margin-bottom: 20px; }
            .footer-table td { display: block; width: 100%; text-align: center; }
            .signature { width: 100%; margin-top: 30px; }
            .actions-btn { padding: 10px; flex-direction: row; }
            .btn { padding: 10px; font-size: 12px; }
        }
    </style>
</head>
<body>
    @if(!isset($isPdf))
    <div class="actions-btn">
        <a href="{{ route('pendaftaran.download', request()->id) }}" class="btn btn-download">
             Download PDF
        </a>
        <button class="btn btn-print" onclick="window.print()">Cetak Kartu</button>
    </div>
    @endif


    <div class="card-container">
        <table class="header-table">
            <tr>
                <td class="header-logo">
                    <img src="{{ $logoUrl }}" alt="Logo">
                </td>
                <td class="header-text">
                    <div class="header">
                        <h1>{{ strtoupper($appConfig['nama_sistem'] ?? 'Sistem Penerimaan Murid Baru') }}</h1>
                        <h2>{{ strtoupper($appConfig['nama_instansi'] ?? 'Dinas Pendidikan') }}</h2>
                        <p>{{ $appConfig['alamat'] ?? '' }}</p>
                        <p>Telp: {{ $appConfig['telepon'] ?? '-' }} | Email: {{ $appConfig['email_resmi'] ?? '-' }}</p>
                    </div>
                </td>
            </tr>
        </table>

        <div class="content">
            <div class="registration-number" style="text-align: center; margin-bottom: 25px;">
                <h3>NOMOR PENDAFTARAN</h3>
                <div>{{ $pendaftaran->nomor_pendaftaran }}</div>
            </div>

            <table class="content-wrapper" style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="vertical-align: top; padding-right: 5px;">
                        <table class="data-table">
                            <tr>
                                <td class="label">Nama Lengkap</td>
                                <td class="separator">:</td>
                                <td>{{ $pendaftaran->nama_lengkap }}</td>
                            </tr>
                            <tr>
                                <td class="label">NISN</td>
                                <td class="separator">:</td>
                                <td>{{ $pendaftaran->nisn }}</td>
                            </tr>
                            <tr>
                                <td class="label">Tempat, Tgl Lahir</td>
                                <td class="separator">:</td>
                                <td>{{ $pendaftaran->tempat_lahir }}, {{ \Carbon\Carbon::parse($pendaftaran->tanggal_lahir)->locale('id_ID')->isoFormat('D MMMM YYYY') }}</td>
                            </tr>
                            <tr>
                                <td class="label">Jenis Kelamin</td>
                                <td class="separator">:</td>
                                <td>{{ $pendaftaran->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                            </tr>
                            <tr>
                                <td class="label">Jalur Pendaftaran</td>
                                <td class="separator">:</td>
                                <td style="font-weight: bold;">{{ strtoupper($pendaftaran->nama_jalur) }}</td>
                            </tr>
                            <tr>
                                <td class="label">Tahun Ajaran</td>
                                <td class="separator">:</td>
                                <td>{{ $pendaftaran->tahun_ajaran ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="label">Pilihan Sekolah 1</td>
                                <td class="separator">:</td>
                                <td>{{ $pendaftaran->sekolah_pilihan_1_nama ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="label">Pilihan Sekolah 2</td>
                                <td class="separator">:</td>
                                <td>{{ $pendaftaran->sekolah_pilihan_2_nama ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="label">Waktu Pendaftaran</td>
                                <td class="separator">:</td>
                                <td>{{ \Carbon\Carbon::parse($pendaftaran->tanggal_daftar)->locale('id_ID')->isoFormat('D MMMM YYYY HH:mm') }} WIB</td>
                            </tr>
                        </table>
                    </td>
                    <td class="photo-col" style="width: 130px; vertical-align: top; text-align: left;">
                        <div class="photo-container" style="margin-left: 0;">
                            @if(isset($isPdf))
                                @if(isset($pasfotoBase64))
                                    <img src="{{ $pasfotoBase64 }}" alt="Pasfoto">
                                @else
                                    <div class="photo-placeholder">PASFOTO<br>3x4</div>
                                @endif
                            @else
                                @if(isset($pasfoto) && $pasfoto)
                                    <img src="{{ route('pendaftaran.berkas.show', $pasfoto->id) }}" alt="Pasfoto">
                                @else
                                    <div class="photo-placeholder">PASFOTO<br>3x4</div>
                                @endif
                            @endif
                        </div>
                    </td>
                </tr>
            </table>

            <table class="footer-table">
                <tr>
                    <td style="vertical-align: bottom;">
                        @if(isset($isPdf) && $isPdf)
                            {!! $qrCode !!}
                        @else
                            {!! QrCode::size(100)->margin(1)->generate($pendaftaran->nomor_pendaftaran) !!}
                        @endif
                    </td>
                    <td class="signature">
                        <p>Kota Lhokseumawe, {{ \Carbon\Carbon::now()->locale('id_ID')->isoFormat('D MMMM YYYY') }}</p>
                        <p>Peserta,</p>
                        <div class="signature-space"></div>
                        <p><strong>({{ $pendaftaran->nama_lengkap }})</strong></p>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>

