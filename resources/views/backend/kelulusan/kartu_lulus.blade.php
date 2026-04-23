@php
    $appConfig = \App\Models\Konfigurasi::pluck('nilai', 'kunci')->toArray();
    
    // Handle logo sources (use base64 if PDF, otherwise use asset URL)
    if (isset($isPdf) && $isPdf) {
        $logoUrl = $logoBase64 ?? asset('images/spmb-logo.png');
        $logoDaerah = $logoDaerahBase64 ?? asset('images/spmb-logo.png');
        $logoSurat = $logoSuratBase64 ?? asset('images/spmb-logo.png');
    } else {
        $logoUrl = !empty($appConfig['logo_path']) ? asset($appConfig['logo_path']) : asset('images/spmb-logo.png');
        $logoDaerah = !empty($appConfig['logo_daerah']) ? asset($appConfig['logo_daerah']) : asset('images/spmb-logo.png');
        $logoSurat = !empty($appConfig['logo_surat']) ? asset($appConfig['logo_surat']) : asset('images/spmb-logo.png');
    }

    // QR Code source is now handled by the controller via $qrCodeBase64
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Kelulusan - {{ $pendaftaran->nomor_pendaftaran }}</title>
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
            padding: 10px;
            max-width: 600px;
            width: 95%;
            margin: 0 auto 10px auto;
            position: relative;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }
        .card-outer-container {
            padding: 10px;
            max-width: 600px;
            width: 95%;
            margin: 0 auto 10px auto;
            position: relative;
            background-color: #fff;
        }
        .card-copy-label {
            text-align: right;
            font-size: 10px;
            font-weight: bold;
            color: #666;
            margin-bottom: 5px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .header-table {
            width: 100%;
            border-bottom: 3px double #000;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-collapse: collapse;
        }
        .header-table td {
            vertical-align: middle;
        }
        .header-logo {
            width: 80px;
            text-align: center;
        }
        .header-logo img {
            max-height: 70px;
            max-width: 70px;
        }
        .header-text {
            text-align: center;
        }
        .header h1 {
            margin: 0 0 3px 0;
            font-size: 16px;
            text-transform: uppercase;
        }
        .header h2 {
            margin: 0 0 3px 0;
            font-size: 14px;
        }
        .header p {
            margin: 0;
            font-size: 10px;
            line-height: 1.3;
        }
        .content {
            margin-top: 20px;
        }
        .status-header {
            text-align: center;
            margin-bottom: 20px;
            background: #f1faff;
            border: 1px solid #00a3ff;
            padding: 10px;
            border-radius: 4px;
        }
        .status-header h3 {
            margin: 0;
            font-size: 18px;
            color: #0084cc;
            text-transform: uppercase;
        }
        .registration-number {
            text-align: center;
            margin-bottom: 25px;
            font-weight: bold;
        }
        .registration-number div {
            font-size: 20px;
            font-weight: bold;
            display: inline-block;
            padding: 5px 15px;
            margin-top: 5px;
            background: #fff;
            color: #9c0202ff;
        }
        .data-table {
            width: 100%;
            border-collapse: collapse;
        }
        .data-table td {
            padding: 6px 5px;
            vertical-align: top;
            font-size: 12px;
        }
        .label {
            width: 35%;
            font-weight: bold;
        }
        .separator {
            width: 10px;
        }
        .accepted-box {
            background: #ebfcf4;
            border: 1px solid #50cd89;
            padding: 10px;
            margin: 15px 0;
            border-radius: 4px;
        }
        .accepted-title {
            font-size: 11px;
            color: #1e1e2d;
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        .accepted-school {
            font-size: 16px;
            color: #047857;
            font-weight: bolder;
            text-transform: uppercase;
        }
        .footer-table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        .signature {
            text-align: center;
            width: 250px;
            font-size: 12px;
        }
        .signature-space {
            height: 60px;
        }
        .notes-table {
            width: 100%;
            margin-top: 20px;
            border-top: 1px solid #ccc;
            padding-top: 10px;
            border-collapse: collapse;
        }
        .notes-table td {
            font-size: 10px;
            vertical-align: top;
            color: #555;
            line-height: 1.5;
        }
        
        /* Actions Bar */
        .actions-btn {
            position: sticky;
            top: 0;
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
            max-width: 250px;
        }
        .btn-print { background: #6c757d; }
        .btn-download { background: #007bff; }
        
        .photo-container {
            width: 90px;
            height: 120px;
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

        @media print {
            body { background-color: #fff; padding: 0; margin: 0; }
            .card-container { width: 100%; border: none; box-shadow: none; }
            .actions-btn { display: none; }
        }

        @if(isset($isPdf) && $isPdf)
        body { padding: 0; margin: 0; background-color: #fff; }
        .card-container { width: 95%; border: 1.5px solid #000; }
        @endif
    </style>
</head>
<body>
    @if(!isset($isPdf))
    <div class="actions-btn">
        @if(isset($isPublic) && $isPublic)
            <a href="{{ route('hasil-seleksi.download', $pendaftaran->id) }}" class="btn btn-download">
                 Download Kartu Lulus (PDF)
            </a>
        @else
            <a href="{{ route('pendaftaran.lulus.download', $pendaftaran->id) }}" class="btn btn-download">
                 Download Kartu Lulus (PDF)
            </a>
        @endif
        <button class="btn btn-print" onclick="window.print()">Cetak Kartu Lulus</button>
    </div>
    @endif

    <div class="card-outer-container">
        <div class="card-container">
            <table class="header-table">
                <tr>
                    <td class="header-logo">
                        <img src="{{ $logoDaerah }}" alt="Logo">
                    </td>
                    <td class="header-text">
                        <div class="header">
                            <h1>PEMERINTAH KOTA LHOKSEUMAWE</h1>
                            <h2>{{ strtoupper($appConfig['nama_instansi'] ?? 'Dinas Pendidikan') }}</h2>
                            <p>{{ $appConfig['alamat'] ?? '' }}</p>
                            <p>Telp: {{ $appConfig['telepon'] ?? '-' }} | Email: {{ $appConfig['email_resmi'] ?? '-' }}</p>
                        </div>
                    </td>
                    <td class="header-logo">
                        <img src="{{ $logoSurat }}" style="max-height: 120px; max-width: 120px;" alt="Logo">
                    </td>
                </tr>
            </table>

            <div class="content">

                <div class="registration-number">
                    <span style="font-size: 12px;">NOMOR PENDAFTARAN</span><br>
                    <div>{{ $pendaftaran->nomor_pendaftaran }}</div>
                </div>

                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="vertical-align: top; padding-right: 30px;">
                            <table class="data-table">
                                <tr>
                                    <td class="label">NAMA LENGKAP</td>
                                    <td class="separator">:</td>
                                    <td style="font-weight: bold; text-transform: uppercase;">{{ $pendaftaran->nama_lengkap }}</td>
                                </tr>
                                <tr>
                                    <td class="label">NISN</td>
                                    <td class="separator">:</td>
                                    <td>{{ $pendaftaran->nisn }}</td>
                                </tr>
                                <tr>
                                    <td class="label">TEMPAT/TGL LAHIR</td>
                                    <td class="separator">:</td>
                                    <td>{{ strtoupper($pendaftaran->tempat_lahir) }}, {{ \Carbon\Carbon::parse($pendaftaran->tanggal_lahir)->locale('id_ID')->isoFormat('D MMMM YYYY') }}</td>
                                </tr>
                                <tr>
                                    <td class="label">JENIS KELAMIN</td>
                                    <td class="separator">:</td>
                                    <td>{{ $pendaftaran->jenis_kelamin == 'L' ? 'LAKI-LAKI' : 'PEREMPUAN' }}</td>
                                </tr>
                                <tr>
                                    <td class="label">JALUR PENDAFTARAN</td>
                                    <td class="separator">:</td>
                                    <td style="font-weight: bold;">{{ strtoupper($pendaftaran->nama_jalur) }}</td>
                                </tr>
                                <tr>
                                    <td class="label">PILIHAN 1</td>
                                    <td class="separator">:</td>
                                    <td style="font-weight: bold; color: #1e40af;">{{ $pendaftaran->sekolah_pilihan_1_nama ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="label">PILIHAN 2</td>
                                    <td class="separator">:</td>
                                    <td style="font-weight: bold; color: #1e40af;">{{ $pendaftaran->sekolah_pilihan_2_nama ?? '-' }}</td>
                                </tr>
                            </table>
                        </td>
                        <td style="width: 120px; vertical-align: center; text-align: left; margin-right: 10px;">
                            <div class="photo-container">
                                @if(isset($isPdf))
                                    @if(isset($pasfotoBase64))
                                        <img src="{{ $pasfotoBase64 }}" alt="Pasfoto">
                                    @else
                                        <div style="font-size: 10px; text-align: center; padding-top: 40px;">PASFOTO 3x4</div>
                                    @endif
                                @else
                                    @if(isset($pasfoto) && $pasfoto)
                                        <img src="{{ route('pendaftaran.berkas.show', $pasfoto->id) }}" alt="Pasfoto">
                                    @else
                                        <div style="font-size: 10px; text-align: center; padding-top: 40px;">PASFOTO 3x4</div>
                                    @endif
                                @endif
                            </div>
                        </td>
                    </tr>
                </table>

                <table class="footer-table">
                    <tr>
                        <td style="width: 120px; vertical-align: top;">
                            @if(isset($qrCodeBase64))
                                <img src="{{ $qrCodeBase64 }}" alt="QR Code" style="width: 100px; height: 100px;">
                            @else
                                {{-- Fallback if used outside controller context --}}
                                <div style="width: 100px; height: 100px; border: 1px solid #ccc;"></div>
                            @endif
                        </td>
                        <td>
                            <div style="text-align: center;">
                                <span style="font-size: 24px; font-weight: bold;color: #1e40af;">SELAMAT</span>
                                <div style="font-size: 24px; font-weight: bold;">ANDA DITERIMA DI</div>
                                <div style="font-size: 24px; font-weight: bold;color: #9c0202ff;">{{ $pendaftaran->sekolah_diterima_nama ?? '-' }}</div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
