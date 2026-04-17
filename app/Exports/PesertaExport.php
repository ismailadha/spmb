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

class PesertaExport extends DefaultValueBinder implements FromQuery, ShouldAutoSize, WithCustomValueBinder, WithHeadings, WithMapping, WithStyles
{
    use Exportable;

    private $periodeId;

    private $jalurId;

    private $sekolahId;

    private $jenjang;

    public function __construct($periodeId, $jalurId, $sekolahId, $jenjang = 'SD')
    {
        $this->periodeId = $periodeId;
        $this->jalurId = $jalurId;
        $this->sekolahId = $sekolahId;
        $this->jenjang = $jenjang;
    }

    public function query()
    {
        return DB::table('pendaftaran')
            ->join('peserta', 'pendaftaran.peserta_id', '=', 'peserta.id')
            ->join('jalur_pendaftaran', 'pendaftaran.jalur_id', '=', 'jalur_pendaftaran.id')
            ->leftJoin('sekolah as sek1', 'pendaftaran.sekolah_pilihan_1', '=', 'sek1.id')
            ->leftJoin('sekolah as sek2', 'pendaftaran.sekolah_pilihan_2', '=', 'sek2.id')
            ->where('pendaftaran.periode_id', $this->periodeId)
            ->where('pendaftaran.jenjang', $this->jenjang)
            ->when($this->jalurId, function ($query, $jalurId) {
                return $query->where('pendaftaran.jalur_id', $jalurId);
            })
            ->when($this->sekolahId, function ($query, $sekolahId) {
                return $query->where(function ($q) use ($sekolahId) {
                    $q->where('pendaftaran.sekolah_pilihan_1', $sekolahId)
                        ->orWhere('pendaftaran.sekolah_pilihan_2', $sekolahId);
                });
            })
            ->select(
                'pendaftaran.nomor_pendaftaran',
                'peserta.nama_lengkap',
                'peserta.nik',
                'peserta.nisn',
                'jalur_pendaftaran.nama_jalur',
                'sek1.nama_sekolah as pilihan_1',
                'sek2.nama_sekolah as pilihan_2',
                'pendaftaran.status',
                'pendaftaran.tanggal_daftar'
            )
            ->orderBy('pendaftaran.tanggal_daftar', 'desc');
    }

    public function headings(): array
    {
        return [
            'No. Pendaftaran',
            'Nama Lengkap',
            'NIK',
            'NISN',
            'Jalur',
            'Sekolah Pilihan 1',
            'Sekolah Pilihan 2',
            'Status',
            'Tanggal Daftar',
        ];
    }

    public function map($pendaftaran): array
    {
        return [
            $pendaftaran->nomor_pendaftaran,
            $pendaftaran->nama_lengkap,
            $pendaftaran->nik,
            $pendaftaran->nisn,
            $pendaftaran->nama_jalur,
            $pendaftaran->pilihan_1,
            $pendaftaran->pilihan_2,
            $pendaftaran->status,
            Carbon::parse($pendaftaran->tanggal_daftar)->format('d-m-Y H:i'),
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
        if ($cell->getColumn() == 'C' || $cell->getColumn() == 'D') {
            $cell->setValueExplicit($value, DataType::TYPE_STRING);

            return true;
        }

        // Return default behavior for other columns
        return parent::bindValue($cell, $value);
    }
}
