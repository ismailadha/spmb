<?php

namespace App\Exports;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeSheet;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class HasilSeleksiExport extends DefaultValueBinder implements FromQuery, ShouldAutoSize, WithCustomStartCell, WithCustomValueBinder, WithEvents, WithHeadings, WithMapping, WithStyles
{
    use Exportable;

    public function __construct(
        private $jalurId,
        private $sekolahId,
        private $jenjang = 'SD'
    ) {}

    public function startCell(): string
    {
        return 'A4';
    }

    public function query()
    {
        return DB::table('pendaftaran')
            ->join('peserta', 'pendaftaran.peserta_id', '=', 'peserta.id')
            ->join('jalur_pendaftaran', 'pendaftaran.jalur_id', '=', 'jalur_pendaftaran.id')
            ->leftJoin('sekolah as sek_diterima', 'pendaftaran.sekolah_diterima_id', '=', 'sek_diterima.id')
            ->leftJoin('nilai_seleksi', 'pendaftaran.id', '=', 'nilai_seleksi.pendaftaran_id')
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
                'pendaftaran.tanggal_daftar',
                'pendaftaran.sekolah_pilihan_1',
                'pendaftaran.sekolah_pilihan_2',
                'pendaftaran.sekolah_diterima_id',
                'pendaftaran.jalur_id',
                'nilai_seleksi.skor_usia',
                'nilai_seleksi.skor_jarak',
                'nilai_seleksi.skor_jarak_2',
                'nilai_seleksi.rata_rapor',
                'nilai_seleksi.nilai_tes_akademik',
                'nilai_seleksi.nilai_prestasi',
                'nilai_seleksi.nilai_akhir'
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
            'Skor Usia',
            'Skor Jarak',
            'Rata-rata Rapor',
            'Nilai Tes Akademik',
            'Nilai Prestasi',
            'Skor Nilai Akhir',
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
            $row->jalur_id == 3 ? '-' : ($row->skor_usia ?? '-'),
            $row->jalur_id == 3 ? '-' : (($row->sekolah_diterima_id == $row->sekolah_pilihan_2) ? ($row->skor_jarak_2 ?? '-') : ($row->skor_jarak ?? '-')),
            $row->rata_rapor ?? '-',
            $row->nilai_tes_akademik ?? '-',
            $row->nilai_prestasi ?? '-',
            $row->nilai_akhir ?? '-',
            Carbon::parse($row->tanggal_daftar)->format('d-m-Y'),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            4 => [
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

    public function registerEvents(): array
    {
        return [
            BeforeSheet::class => function (BeforeSheet $event) {
                // Get Tahun Ajaran
                $periode = DB::table('periode_pendaftaran')->where('status_aktif', 1)->first();
                $tahunAjaran = $periode ? $periode->tahun_ajaran : date('Y');

                $event->sheet->mergeCells('A1:M1');
                $event->sheet->setCellValue('A1', "DAFTAR HASIL SELEKSI SISWA BARU - {$this->jenjang}");
                $event->sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
                $event->sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                $event->sheet->mergeCells('A2:M2');
                $event->sheet->setCellValue('A2', "TAHUN AJARAN {$tahunAjaran}");
                $event->sheet->getStyle('A2')->getFont()->setBold(true)->setSize(12);
                $event->sheet->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            },
            AfterSheet::class => function (AfterSheet $event) {
                $highestRow = $event->sheet->getHighestRow();
                $noteRow = $highestRow + 2;

                $event->sheet->mergeCells("A{$noteRow}:M{$noteRow}");
                $event->sheet->setCellValue("A{$noteRow}", 'Informasi Perhitungan: Skor Akhir untuk jalur selain Prestasi dihitung berdasarkan Skor Usia + Skor Jarak. Untuk Jalur Prestasi, skor akhir dihitung berdasarkan komponen penilaian prestasi masing-masing.');

                $event->sheet->getStyle("A{$noteRow}")->getFont()->setItalic(true);
                $event->sheet->getStyle("A{$noteRow}")->getFont()->getColor()->setRGB('4B5563');
            },
        ];
    }
}
