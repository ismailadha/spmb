<?php

namespace App\Http\Controllers;

use App\Models\JalurDaftar;
use App\Models\Pendaftaran;
use App\Models\Sekolah;
use App\Exports\HasilSeleksiExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class HasilSeleksiController extends Controller
{
    /**
     * Export Hasil Seleksi SD to Excel.
     */
    public function exportExcel_sd(Request $request)
    {
        $jalurId = $request->get('jalur_id');
        $sekolahId = $request->get('sekolah_id');

        if (auth()->user()->role == 'admin_sekolah') {
            $sekolahId = auth()->user()->sekolah_id;
        }

        $filename = 'hasil_seleksi_sd_'.date('YmdHis').'.xlsx';

        return (new HasilSeleksiExport($jalurId, $sekolahId, 'SD'))->download($filename);
    }

    /**
     * Export Hasil Seleksi SD to PDF.
     */
    public function exportPdf_sd(Request $request)
    {
        $jalurId = $request->get('jalur_id');
        $sekolahId = $request->get('sekolah_id');

        if (auth()->user()->role == 'admin_sekolah') {
            $sekolahId = auth()->user()->sekolah_id;
        }

        $jenjang = 'SD';
        $sekolah_filter = $sekolahId ? Sekolah::find($sekolahId) : null;
        $jalur_filter = $jalurId ? JalurDaftar::find($jalurId) : null;

        $data = DB::table('pendaftaran')
            ->join('peserta', 'pendaftaran.peserta_id', '=', 'peserta.id')
            ->join('jalur_pendaftaran', 'pendaftaran.jalur_id', '=', 'jalur_pendaftaran.id')
            ->leftJoin('sekolah as sek_diterima', 'pendaftaran.sekolah_diterima_id', '=', 'sek_diterima.id')
            ->where('pendaftaran.jenjang', $jenjang)
            ->where('pendaftaran.status', 'Lulus')
            ->when($jalurId, function ($query, $jalurId) {
                return $query->where('pendaftaran.jalur_id', $jalurId);
            })
            ->when($sekolahId, function ($query, $sekolahId) {
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
            ->orderBy('pendaftaran.nomor_pendaftaran', 'asc')
            ->get();

        $pdf = Pdf::loadView('backend.hasil_seleksi.export_pdf', compact('data', 'jenjang', 'sekolah_filter', 'jalur_filter'));
        
        return $pdf->download('hasil_seleksi_sd_'.date('YmdHis').'.pdf');
    }

    public function hasil_seleksi_sd(Request $request)
    {
        if ($request->ajax()) {
            $data = Pendaftaran::with(['peserta', 'jalur', 'sekolahDiterima'])
                ->where('jenjang', 'SD')
                ->where('status', 'Lulus');

            if (auth()->user()->role == 'admin_sekolah') {
                $data->where('sekolah_diterima_id', auth()->user()->sekolah_id);
            }

            if ($request->jalur_id) {
                $data->where('jalur_id', $request->jalur_id);
            }

            if ($request->sekolah_id) {
                $data->where('sekolah_diterima_id', $request->sekolah_id);
            }

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('peserta_info', function ($row) {
                    return '
                        <div class="d-flex flex-column">
                            <span class="text-gray-800 fw-bolder">'.($row->peserta->nama_lengkap ?? '-').'</span>
                            <span class="text-muted fs-7">NISN: '.($row->peserta->nisn ?? '-').'</span>
                        </div>
                    ';
                })
                ->addColumn('jalur_info', function ($row) {
                    return $row->jalur->nama_jalur ?? '-';
                })
                ->addColumn('sekolah_info', function ($row) {
                    return $row->sekolahDiterima->nama_sekolah ?? '-';
                })
                ->addColumn('action', function ($row) {
                    return '
                        <div class="d-flex justify-content-end">
                            <a href="'.route('peserta.detail', $row->id).'" class="btn btn-icon btn-light-primary btn-sm me-1" title="Detail">
                                <i class="bi bi-eye fs-3"></i>
                            </a>
                            <a href="#" class="btn btn-icon btn-light-danger btn-sm me-1" title="Download">
                                <i class="bi bi-file-earmark-pdf fs-3"></i>
                            </a>
                            <a href="#" class="btn btn-icon btn-light-dark btn-sm me-1" title="Cetak">
                                <i class="bi bi-printer fs-3"></i>
                            </a>
                        </div>
                    ';
                })
                ->rawColumns(['peserta_info', 'action'])
                ->make(true);
        }

        $jalur = JalurDaftar::all();
        $sekolah = Sekolah::where('jenjang', 'SD')
            ->when(auth()->user()->role == 'admin_sekolah', function ($query) {
                return $query->where('id', auth()->user()->sekolah_id);
            })
            ->get();

        return view('backend.hasil_seleksi.hasil_seleksi_sd', compact('jalur', 'sekolah'));
    }

    public function hasil_seleksi_smp()
    {
        return view('backend.hasil_seleksi.hasil_seleksi_smp');
    }
}
