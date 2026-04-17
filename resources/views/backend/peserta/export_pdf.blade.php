<!DOCTYPE html>
<html>
<head>
    <title>Export Peserta {{ $jenjang }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h2 {
            margin: 0;
            padding: 0;
            text-transform: uppercase;
        }
        .header p {
            margin: 5px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            text-align: center;
        }
        .footer {
            margin-top: 20px;
            text-align: right;
        }
        .filter-info {
            margin-bottom: 15px;
        }
        .filter-info table {
            border: none;
            width: auto;
        }
        .filter-info td {
            border: none;
            padding: 2px 5px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h3>Data Peserta Penerimaan Siswa Baru @if($jenjang == 'SD'){{ 'Jenjang Sekolah Dasar' }} @else{{ 'Jenjang Sekolah Menengah Pertama' }}@endif</h3>
        <p>Tahun Ajaran: {{ $periode->tahun_ajaran ?? '-' }}</p>
    </div>

    <div class="filter-info">
        <table>
            <tr>
                <td>Sekolah</td>
                <td>:</td>
                <td><strong>{{ $sekolah->nama_sekolah ?? 'Semua Sekolah' }}</strong></td>
            </tr>
            <tr>
                <td>Jalur</td>
                <td>:</td>
                <td><strong>{{ $jalur->nama_jalur ?? 'Semua Jalur' }}</strong></td>
            </tr>
        </table>
    </div>

    <table>
        <thead>
            <tr>
                <th width="30">No</th>
                <th width="100">No. Pendaftaran</th>
                <th>Nama Lengkap</th>
                <th width="120">NIK</th>
                <th width="100">Jalur</th>
                <th>Sekolah Pilihan 1</th>
                <th width="80">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $index => $row)
            <tr>
                <td style="text-align: center;">{{ $index + 1 }}</td>
                <td>{{ $row->nomor_pendaftaran }}</td>
                <td>{{ $row->nama_lengkap }}</td>
                <td>{{ $row->nik }}</td>
                <td>{{ $row->nama_jalur }}</td>
                <td>{{ $row->pilihan_1 }}</td>
                <td style="text-align: center;">{{ $row->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak pada: {{ \Carbon\Carbon::now()->locale('id')->isoFormat('D MMMM YYYY HH:mm') }}</p>
    </div>
</body>
</html>
