@php
    $appConfig = \App\Models\Konfigurasi::pluck('nilai', 'kunci')->toArray();
    $logoUrl = !empty($appConfig['logo_path']) ? asset($appConfig['logo_path']) : asset('images/spmb-logo.png');
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Pendaftaran - {{ $pendaftaran->nama_lengkap }}</title>
    <style>
        @page {
            size: A4;
            margin: 0;
        }
        body {
            font-family: 'Arial', sans-serif;
            margin: 40px;
            color: #333;
            background-color: #fff;
        }
        .card-container {
            border: 2px solid #000;
            padding: 30px;
            width: 700px;
            margin: 0 auto;
            position: relative;
        }
        .header {
            text-align: center;
            border-bottom: 3px double #000;
            margin-bottom: 20px;
            padding-bottom: 10px;
        }
        .header h1 {
            margin: 5px 0;
            font-size: 20px;
            text-transform: uppercase;
        }
        .header h2 {
            margin: 5px 0;
            font-size: 16px;
        }
        .header p {
            margin: 2px 0;
            font-size: 12px;
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
            font-size: 24px;
            font-weight: bold;
            padding: 10px;
            border: 1px dashed #000;
            display: inline-block;
            margin-top: 5px;
            letter-spacing: 2px;
        }
        .data-table {
            width: 100%;
            border-collapse: collapse;
        }
        .data-table td {
            padding: 8px 5px;
            vertical-align: top;
        }
        .label {
            width: 180px;
            font-weight: bold;
        }
        .separator {
            width: 10px;
        }
        .footer {
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
        }
        .qr-placeholder {
            width: 100px;
            height: 100px;
            border: 1px solid #ccc;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            text-align: center;
        }
        .signature {
            text-align: center;
            width: 280px;
        }
        .signature-space {
            height: 60px;
        }
        .print-btn {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 10px 20px;
            background: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        @media print {
            .print-btn {
                display: none;
            }
            body {
                margin: 0;
                padding: 40px;
            }
        }
    </style>
</head>
<body>
    <button class="print-btn" onclick="window.print()">Cetak Sekarang</button>

    <div class="card-container">
        <div class="header" style="display: flex; align-items: center; padding-bottom: 15px;">
            <div style="flex: 0 0 180px; text-align: center;">
                <img src="{{ $logoUrl }}" alt="Logo" style="max-height: 130px; max-width: 100%;">
            </div>
            <div style="flex: 1; text-align: center; padding-left: 20px;">
                <h1 style="font-size: 18px;">{{ strtoupper($appConfig['nama_sistem'] ?? 'Sistem Penerimaan Murid Baru') }}</h1>
                <h2 style="font-size: 16px;">{{ strtoupper($appConfig['nama_instansi'] ?? 'Dinas Pendidikan') }}</h2>
                <p style="font-size: 12px; margin-top: 3px;">{{ $appConfig['alamat'] ?? '' }} | Telp: {{ $appConfig['telepon'] ?? '-' }} | Email: {{ $appConfig['email_resmi'] ?? '-' }}</p>
            </div>
        </div>

        <div class="content">
            {{-- Kartu Pendaftaran --}}


            <div class="registration-number">
                <h3>NOMOR PENDAFTARAN</h3>
                <div>{{ $pendaftaran->nomor_pendaftaran }}</div>
            </div>

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
                    <td>{{ $pendaftaran->tempat_lahir }}, {{ \Carbon\Carbon::parse($pendaftaran->tanggal_lahir)->isoFormat('D MMMM YYYY') }}</td>
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
                    <td>{{ \Carbon\Carbon::parse($pendaftaran->tanggal_daftar)->isoFormat('D MMMM YYYY HH:mm') }} WIB</td>
                </tr>
            </table>

            <div class="footer">
                <div>
                    {!! QrCode::size(100)->margin(1)->generate($pendaftaran->nomor_pendaftaran) !!}
                </div>
                <div class="signature">
                    <p>Kota Lhokseumawe, {{ \Carbon\Carbon::now()->isoFormat('D MMMM YYYY') }}</p>
                    <p>Peserta,</p>
                    <div class="signature-space"></div>
                    <p><strong>({{ $pendaftaran->nama_lengkap }})</strong></p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Auto print prompt
        window.onload = function() {
            // setTimeout(function() { window.print(); }, 500);
        };
    </script>
</body>
</html>
