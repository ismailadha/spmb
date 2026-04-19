<?php

namespace App\Exports;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class HasilSeleksiExport extends DefaultValueBinder implements FromQuery, ShouldAutoSize, WithCustomValueBinder, WithHeadings, WithMapping, WithStyles
{
    use Exportable;

    public function __construct(
        private $jalurId,
        private $sekolahId,
        private $jenjang = 'SD'
    ) {}

    public function query()
    {
        return DB::table('pendaftaran')
            ->join('peserta', 'pendaftaran.peserta_id', '=', 'peserta.id')
            ->join('jalur_pendaftaran', 'pendaftaran.jalur_id', '=', 'jalur_pendaftaran.id')
            ->leftJoin('sekolah as sek_diterima', 'pendaftaran.sekolah_diterima_id', '=', 'sek_diterima.id')
            ->where('pendaftaran.jenjang', $this->jenjang)
            ->where('pendaftaran.status', 'Lulus')
            ->when($this->jalurId, function ($query, $jalurId) {
                return $query->where('pendaftaran.jalur_id', $jalurId);
            })
            ->when($this->sekolahId, function ($query, $sekolahId) {
                return $query->where('pendaftaran.sekolah_diterima_id', $sekolahId);
            })
            ->select(
                'pendaftaran.nomor_pendaftaran',
                'peserta.nama_lengkap',
                'peserta.nik',
                'peserta.nisn',
                'jalur_pendaftaran.nama_jalur',
                'sek_diterima.nama_sekolah as sekolah_penerima',
                'pendaftaran.tanggal_daftar'
            )
            ->orderBy('pendaftaran.nomor_pendaftaran', 'asc');
    }

    public function headings(): array
    {
        return [
            'No. Pendaftaran',
            'Nama Lengkap',
            'NIK',
            'NISN',
            'Jalur Seleksi',
            'Sekolah Diterima',
            'Tanggal Daftar',
        ];
    }

    public function map($row): array
    {
        return [
            $row->nomor_pendaftaran,
            $row->nama_lengkap,
            $row->nik,
            $row->nisn,
            $row->nama_jalur,
            $row->sekolah_penerima,
            Carbon::parse($row->tanggal_daftar)->format('d-m-Y'),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '1E1E2D'],
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ],
        ];
    }

    public function bindValue(Cell $cell, $value)
    {
        // Force NIK (C) and NISN (D) as explicitly STRING
        // Using column letters: A=NoPen, B=Nama, C=NIK, D=NISN
        if ($cell->getColumn() == 'C' || $cell->getColumn() == 'D') {
            $cell->setValueExplicit($value, DataType::TYPE_STRING);
            return true;
        }

        return parent::bindValue($cell, $value);
    }
}
