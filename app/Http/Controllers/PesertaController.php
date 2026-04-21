<?php

namespace App\Http\Controllers;

use App\Exports\PesertaExport;
use App\Models\Peserta;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class PesertaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $periode = DB::table('periode_pendaftaran')
            ->where('status_aktif', 1)
            ->first();

        $semuaPeriode = DB::table('periode_pendaftaran')
            ->orderBy('id', 'desc')
            ->get();

        $semuaJalur = DB::table('jalur_pendaftaran')->get();
        $semuaSekolah = DB::table('sekolah')
            ->when(auth()->user()->role == 'admin_sekolah', function ($query) {
                return $query->where('id', auth()->user()->sekolah_id);
            })
            ->get();

        if ($request->ajax()) {
            $periodeId = $request->get('periode_id') ?: ($periode->id ?? null);
            $jalurId = $request->get('jalur_id');
            $sekolahId = $request->get('sekolah_id');

            if (auth()->user()->role == 'admin_sekolah') {
                $sekolahId = auth()->user()->sekolah_id;
            }

            $data = DB::table('pendaftaran')
                ->join('peserta', 'pendaftaran.peserta_id', '=', 'peserta.id')
                ->join('jalur_pendaftaran', 'pendaftaran.jalur_id', '=', 'jalur_pendaftaran.id')
                ->where('pendaftaran.periode_id', $periodeId)
                ->when($jalurId, function ($query, $jalurId) {
                    return $query->where('pendaftaran.jalur_id', $jalurId);
                })
                ->when($sekolahId, function ($query, $sekolahId) {
                    return $query->where(function ($q) use ($sekolahId) {
                        $q->where('pendaftaran.sekolah_pilihan_1', $sekolahId)
                            ->orWhere('pendaftaran.sekolah_pilihan_2', $sekolahId);
                    });
                })
                ->select(
                    'pendaftaran.id as pendaftaran_id',
                    'peserta.id as id',
                    'pendaftaran.nomor_pendaftaran',
                    'peserta.nama_lengkap',
                    'jalur_pendaftaran.nama_jalur',
                    'pendaftaran.jenjang',
                    'pendaftaran.status'
                );

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function ($row) {
                    if ($row->status == 'verifikasi') {
                        return '<span class="badge badge-light-info fw-bolder px-4 py-3" style="background-color: #f3f1ff; color: #7239ea;">Terverifikasi</span>';
                    } elseif ($row->status == 'lulus') {
                        return '<span class="badge badge-light-success fw-bolder px-4 py-3" style="background-color: #e8fff3; color: #50cd89;">Lulus</span>';
                    } elseif ($row->status == 'perbaikan') {
                        return '<span class="badge badge-light-warning fw-bolder px-4 py-3" style="background-color: #fff4e1; color: #ff8c00;">Perbaikan</span>';
                    } elseif ($row->status == 'submit') {
                        return '<span class="badge badge-light-warning fw-bolder px-4 py-3">Proses Verifikasi</span>';
                    } elseif ($row->status == 'draft') {
                        return '<span class="badge badge-light-primary fw-bolder px-4 py-3">Draft</span>';
                    } else {
                        return '<span class="badge badge-light-secondary fw-bolder px-4 py-3">'.ucfirst($row->status).'</span>';
                    }
                })
                ->addColumn('action', function ($row) {
                    return '
                        <div class="dropdown">
                            <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Action
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="'.route('peserta.verifikasi', $row->id).'">Verifikasi</a></li>
                                <li><a class="dropdown-item" href="'.route('peserta.edit', $row->id).'">Edit</a></li>
                                <li>
                                    <form action="'.route('peserta.destroy', $row->id).'" method="POST" id="delete-form-'.$row->id.'" style="margin: 0;">
                                        '.csrf_field().'
                                        '.method_field('DELETE').'
                                        <button type="button" class="dropdown-item text-danger btn-delete" data-id="'.$row->id.'">Delete</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    ';
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        return view('backend.peserta.index', compact('periode', 'semuaPeriode', 'semuaJalur', 'semuaSekolah'));
    }

    /**
     * Display a listing of SD participants.
     */
    public function peserta_sd(Request $request)
    {
        $periode = DB::table('periode_pendaftaran')
            ->where('status_aktif', 1)
            ->first();

        $semuaPeriode = DB::table('periode_pendaftaran')
            ->orderBy('id', 'desc')
            ->get();

        $semuaJalur = DB::table('jalur_pendaftaran')->get();
        $semuaSekolah = DB::table('sekolah')->where('jenjang', 'SD')
            ->when(auth()->user()->role == 'admin_sekolah', function ($query) {
                return $query->where('id', auth()->user()->sekolah_id);
            })
            ->get();

        if ($request->ajax()) {
            $periodeId = $request->get('periode_id') ?: ($periode->id ?? null);
            $jalurId = $request->get('jalur_id');
            $sekolahId = $request->get('sekolah_id');
            $status = $request->get('status');

            if (auth()->user()->role == 'admin_sekolah') {
                $sekolahId = auth()->user()->sekolah_id;
            }

            $data = DB::table('pendaftaran')
                ->join('peserta', 'pendaftaran.peserta_id', '=', 'peserta.id')
                ->join('jalur_pendaftaran', 'pendaftaran.jalur_id', '=', 'jalur_pendaftaran.id')
                ->where('pendaftaran.periode_id', $periodeId)
                ->where('pendaftaran.jenjang', 'SD')
                ->when($jalurId, function ($query, $jalurId) {
                    return $query->where('pendaftaran.jalur_id', $jalurId);
                })
                ->when($sekolahId, function ($query, $sekolahId) {
                    return $query->where(function ($q) use ($sekolahId) {
                        $q->where('pendaftaran.sekolah_pilihan_1', $sekolahId)
                            ->orWhere('pendaftaran.sekolah_pilihan_2', $sekolahId);
                    });
                })
                ->when($status, function ($query, $status) {
                    return $query->where('pendaftaran.status', $status);
                })
                ->select(
                    'pendaftaran.id as pendaftaran_id',
                    'peserta.id as id',
                    'pendaftaran.nomor_pendaftaran',
                    'peserta.nama_lengkap',
                    'jalur_pendaftaran.nama_jalur',
                    'pendaftaran.jenjang',
                    'pendaftaran.status',
                    'pendaftaran.tanggal_daftar'
                )
                ->orderByRaw("CASE WHEN pendaftaran.status = 'submit' THEN 0 WHEN pendaftaran.status = 'verifikasi' THEN 1 ELSE 2 END")
                ->orderBy('pendaftaran.tanggal_daftar', 'asc');

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function ($row) {
                    if ($row->status == 'verifikasi') {
                        return '<span class="badge badge-light-info fw-bolder px-4 py-3" style="background-color: #f3f1ff; color: #7239ea;">Terverifikasi</span>';
                    } elseif ($row->status == 'lulus') {
                        return '<span class="badge badge-light-success fw-bolder px-4 py-3" style="background-color: #e8fff3; color: #50cd89;">Lulus</span>';
                    } elseif ($row->status == 'perbaikan') {
                        return '<span class="badge badge-light-warning fw-bolder px-4 py-3" style="background-color: #fff4e1; color: #ff8c00;">Perbaikan</span>';
                    } elseif ($row->status == 'submit') {
                        return '<span class="badge badge-light-warning fw-bolder px-4 py-3">Proses Verifikasi</span>';
                    } elseif ($row->status == 'draft') {
                        return '<span class="badge badge-light-primary fw-bolder px-4 py-3">Draft</span>';
                    } else {
                        return '<span class="badge badge-light-secondary fw-bolder px-4 py-3">'.ucfirst($row->status).'</span>';
                    }
                })
                ->addColumn('action', function ($row) {
                    return '
                        <div class="btn-group" role="group">
                            '.(in_array($row->status, ['submit', 'verifikasi', 'perbaikan']) ? '
                            <a href="'.route('peserta.verifikasi', $row->id).'" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" title="Verifikasi">
                                <i class="bi bi-check-circle fs-3"></i>
                            </a>' : '').'
                            <form action="'.route('peserta.destroy', $row->id).'" method="POST" id="delete-form-'.$row->id.'" class="d-inline">
                                '.csrf_field().'
                                '.method_field('DELETE').'
                                <button type="button" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm btn-delete" data-id="'.$row->id.'" title="Hapus">
                                    <i class="bi bi-trash fs-3"></i>
                                </button>
                            </form>
                        </div>
                    ';
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        return view('backend.peserta.peserta_sd', compact('periode', 'semuaPeriode', 'semuaJalur', 'semuaSekolah'));
    }

    /**
     * Export Peserta SD to Excel.
     */
    public function exportExcel_sd(Request $request)
    {
        $periodeId = $request->get('periode_id');
        $jalurId = $request->get('jalur_id');
        $sekolahId = $request->get('sekolah_id');
        $status = $request->get('status');

        if (auth()->user()->role == 'admin_sekolah') {
            $sekolahId = auth()->user()->sekolah_id;
        }

        $filename = 'data_peserta_sd_'.date('YmdHis').'.xlsx';

        return (new PesertaExport($periodeId, $jalurId, $sekolahId, 'SD', $status))->download($filename);
    }

    /**
     * Export Peserta SD to PDF.
     */
    public function exportPdf_sd(Request $request)
    {
        $periodeId = $request->get('periode_id');
        $jalurId = $request->get('jalur_id');
        $sekolahId = $request->get('sekolah_id');
        $status = $request->get('status');

        if (auth()->user()->role == 'admin_sekolah') {
            $sekolahId = auth()->user()->sekolah_id;
        }

        $data = DB::table('pendaftaran')
            ->join('peserta', 'pendaftaran.peserta_id', '=', 'peserta.id')
            ->join('jalur_pendaftaran', 'pendaftaran.jalur_id', '=', 'jalur_pendaftaran.id')
            ->leftJoin('sekolah as sek1', 'pendaftaran.sekolah_pilihan_1', '=', 'sek1.id')
            ->leftJoin('sekolah as sek2', 'pendaftaran.sekolah_pilihan_2', '=', 'sek2.id')
            ->where('pendaftaran.periode_id', $periodeId)
            ->where('pendaftaran.jenjang', 'SD')
            ->when($jalurId, function ($query, $jalurId) {
                return $query->where('pendaftaran.jalur_id', $jalurId);
            })
            ->when($sekolahId, function ($query, $sekolahId) {
                return $query->where(function ($q) use ($sekolahId) {
                    $q->where('pendaftaran.sekolah_pilihan_1', $sekolahId)
                        ->orWhere('pendaftaran.sekolah_pilihan_2', $sekolahId);
                });
            })
            ->when($status, function ($query, $status) {
                return $query->where('pendaftaran.status', $status);
            })
            ->select(
                'pendaftaran.nomor_pendaftaran',
                'peserta.nama_lengkap',
                'peserta.nik',
                'jalur_pendaftaran.nama_jalur',
                'sek1.nama_sekolah as pilihan_1',
                'pendaftaran.status'
            )
            ->get();

        $periode = DB::table('periode_pendaftaran')->where('id', $periodeId)->first();
        $sekolah = $sekolahId ? DB::table('sekolah')->where('id', $sekolahId)->first() : null;
        $jalur = $jalurId ? DB::table('jalur_pendaftaran')->where('id', $jalurId)->first() : null;

        $pdf = Pdf::loadView('backend.peserta.export_pdf', [
            'data' => $data,
            'periode' => $periode,
            'sekolah' => $sekolah,
            'jalur' => $jalur,
            'jenjang' => 'SD',
        ]);

        return $pdf->setPaper('a4', 'landscape')->download('data_peserta_sd_'.date('YmdHis').'.pdf');
    }

    /**
     * Display a listing of SMP participants.
     */
    public function peserta_smp(Request $request)
    {
        $periode = DB::table('periode_pendaftaran')
            ->where('status_aktif', 1)
            ->first();

        $semuaPeriode = DB::table('periode_pendaftaran')
            ->orderBy('id', 'desc')
            ->get();

        $semuaJalur = DB::table('jalur_pendaftaran')->get();
        $semuaSekolah = DB::table('sekolah')->where('jenjang', 'SMP')
            ->when(auth()->user()->role == 'admin_sekolah', function ($query) {
                return $query->where('id', auth()->user()->sekolah_id);
            })
            ->get();

        if ($request->ajax()) {
            $periodeId = $request->get('periode_id') ?: ($periode->id ?? null);
            $jalurId = $request->get('jalur_id');
            $sekolahId = $request->get('sekolah_id');
            $status = $request->get('status');

            if (auth()->user()->role == 'admin_sekolah') {
                $sekolahId = auth()->user()->sekolah_id;
            }

            $data = DB::table('pendaftaran')
                ->join('peserta', 'pendaftaran.peserta_id', '=', 'peserta.id')
                ->join('jalur_pendaftaran', 'pendaftaran.jalur_id', '=', 'jalur_pendaftaran.id')
                ->where('pendaftaran.periode_id', $periodeId)
                ->where('pendaftaran.jenjang', 'SMP')
                ->when($jalurId, function ($query, $jalurId) {
                    return $query->where('pendaftaran.jalur_id', $jalurId);
                })
                ->when($sekolahId, function ($query, $sekolahId) {
                    return $query->where(function ($q) use ($sekolahId) {
                        $q->where('pendaftaran.sekolah_pilihan_1', $sekolahId)
                            ->orWhere('pendaftaran.sekolah_pilihan_2', $sekolahId);
                    });
                })
                ->when($status, function ($query, $status) {
                    return $query->where('pendaftaran.status', $status);
                })
                ->select(
                    'pendaftaran.id as pendaftaran_id',
                    'peserta.id as id',
                    'pendaftaran.nomor_pendaftaran',
                    'peserta.nama_lengkap',
                    'jalur_pendaftaran.nama_jalur',
                    'pendaftaran.jenjang',
                    'pendaftaran.status',
                    'pendaftaran.tanggal_daftar'
                )
                ->orderByRaw("CASE WHEN pendaftaran.status = 'submit' THEN 0 WHEN pendaftaran.status = 'verifikasi' THEN 1 ELSE 2 END")
                ->orderBy('pendaftaran.tanggal_daftar', 'asc');

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function ($row) {
                    if ($row->status == 'verifikasi') {
                        return '<span class="badge badge-light-info fw-bolder px-4 py-3" style="background-color: #f3f1ff; color: #7239ea;">Terverifikasi</span>';
                    } elseif ($row->status == 'lulus') {
                        return '<span class="badge badge-light-success fw-bolder px-4 py-3" style="background-color: #e8fff3; color: #50cd89;">Lulus</span>';
                    } elseif ($row->status == 'perbaikan') {
                        return '<span class="badge badge-light-warning fw-bolder px-4 py-3" style="background-color: #fff4e1; color: #ff8c00;">Perbaikan</span>';
                    } elseif ($row->status == 'submit') {
                        return '<span class="badge badge-light-warning fw-bolder px-4 py-3">Proses Verifikasi</span>';
                    } elseif ($row->status == 'draft') {
                        return '<span class="badge badge-light-primary fw-bolder px-4 py-3">Draft</span>';
                    } else {
                        return '<span class="badge badge-light-secondary fw-bolder px-4 py-3">'.ucfirst($row->status).'</span>';
                    }
                })
                ->addColumn('action', function ($row) {
                    return '
                        <div class="btn-group" role="group">
                            '.(in_array($row->status, ['submit', 'verifikasi', 'perbaikan']) ? '
                            <a href="'.route('peserta.verifikasi', $row->id).'" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" title="Verifikasi">
                                <i class="bi bi-check-circle fs-3"></i>
                            </a>' : '').'
                            <form action="'.route('peserta.destroy', $row->id).'" method="POST" id="delete-form-'.$row->id.'" class="d-inline">
                                '.csrf_field().'
                                '.method_field('DELETE').'
                                <button type="button" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm btn-delete" data-id="'.$row->id.'" title="Hapus">
                                    <i class="bi bi-trash fs-3"></i>
                                </button>
                            </form>
                        </div>
                    ';
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        return view('backend.peserta.peserta_smp', compact('periode', 'semuaPeriode', 'semuaJalur', 'semuaSekolah'));
    }

    /**
     * Export Peserta SMP to Excel.
     */
    public function exportExcel_smp(Request $request)
    {
        $periodeId = $request->get('periode_id');
        $jalurId = $request->get('jalur_id');
        $sekolahId = $request->get('sekolah_id');
        $status = $request->get('status');

        if (auth()->user()->role == 'admin_sekolah') {
            $sekolahId = auth()->user()->sekolah_id;
        }

        $filename = 'data_peserta_smp_'.date('YmdHis').'.xlsx';

        return (new PesertaExport($periodeId, $jalurId, $sekolahId, 'SMP', $status))->download($filename);
    }

    /**
     * Export Peserta SMP to PDF.
     */
    public function exportPdf_smp(Request $request)
    {
        $periodeId = $request->get('periode_id');
        $jalurId = $request->get('jalur_id');
        $sekolahId = $request->get('sekolah_id');
        $status = $request->get('status');

        if (auth()->user()->role == 'admin_sekolah') {
            $sekolahId = auth()->user()->sekolah_id;
        }

        $data = DB::table('pendaftaran')
            ->join('peserta', 'pendaftaran.peserta_id', '=', 'peserta.id')
            ->join('jalur_pendaftaran', 'pendaftaran.jalur_id', '=', 'jalur_pendaftaran.id')
            ->leftJoin('sekolah as sek1', 'pendaftaran.sekolah_pilihan_1', '=', 'sek1.id')
            ->leftJoin('sekolah as sek2', 'pendaftaran.sekolah_pilihan_2', '=', 'sek2.id')
            ->where('pendaftaran.periode_id', $periodeId)
            ->where('pendaftaran.jenjang', 'SMP')
            ->when($jalurId, function ($query, $jalurId) {
                return $query->where('pendaftaran.jalur_id', $jalurId);
            })
            ->when($sekolahId, function ($query, $sekolahId) {
                return $query->where(function ($q) use ($sekolahId) {
                    $q->where('pendaftaran.sekolah_pilihan_1', $sekolahId)
                        ->orWhere('pendaftaran.sekolah_pilihan_2', $sekolahId);
                });
            })
            ->when($status, function ($query, $status) {
                return $query->where('pendaftaran.status', $status);
            })
            ->select(
                'pendaftaran.nomor_pendaftaran',
                'peserta.nama_lengkap',
                'peserta.nik',
                'jalur_pendaftaran.nama_jalur',
                'sek1.nama_sekolah as pilihan_1',
                'pendaftaran.status'
            )
            ->get();

        $periode = DB::table('periode_pendaftaran')->where('id', $periodeId)->first();
        $sekolah = $sekolahId ? DB::table('sekolah')->where('id', $sekolahId)->first() : null;
        $jalur = $jalurId ? DB::table('jalur_pendaftaran')->where('id', $jalurId)->first() : null;

        $pdf = Pdf::loadView('backend.peserta.export_pdf', [
            'data' => $data,
            'periode' => $periode,
            'sekolah' => $sekolah,
            'jalur' => $jalur,
            'jenjang' => 'SMP',
        ]);

        return $pdf->setPaper('a4', 'landscape')->download('data_peserta_smp_'.date('YmdHis').'.pdf');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pendaftaran = DB::table('pendaftaran')
            ->join('peserta', 'pendaftaran.peserta_id', '=', 'peserta.id')
            ->leftJoin('provinsi', 'peserta.provinsi_id', '=', 'provinsi.id')
            ->leftJoin('kabupaten', 'peserta.kabupaten_id', '=', 'kabupaten.id')
            ->leftJoin('kecamatan', 'peserta.kecamatan_id', '=', 'kecamatan.id')
            ->leftJoin('desa', 'peserta.desa_id', '=', 'desa.id')
            ->leftJoin('jalur_pendaftaran', 'pendaftaran.jalur_id', '=', 'jalur_pendaftaran.id')
            ->leftJoin('sekolah as sek1', 'pendaftaran.sekolah_pilihan_1', '=', 'sek1.id')
            ->leftJoin('sekolah as sek2', 'pendaftaran.sekolah_pilihan_2', '=', 'sek2.id')
            ->leftJoin('sekolah as sek_diterima', 'pendaftaran.sekolah_diterima_id', '=', 'sek_diterima.id')
            ->leftJoin('nilai_seleksi', 'pendaftaran.id', '=', 'nilai_seleksi.pendaftaran_id')
            ->leftJoin('orang_tua_wali', 'orang_tua_wali.peserta_id', '=', 'peserta.id')
            ->where('pendaftaran.id', $id)
            ->select(
                'pendaftaran.*',
                'peserta.*',
                'provinsi.nama_provinsi',
                'kabupaten.nama_kabupaten',
                'kecamatan.nama_kecamatan',
                'desa.nama_desa',
                'jalur_pendaftaran.nama_jalur',
                'sek1.nama_sekolah as pilihan_1',
                'sek2.nama_sekolah as pilihan_2',
                'sek_diterima.nama_sekolah as sekolah_diterima',
                'nilai_seleksi.skor_jarak',
                'nilai_seleksi.skor_jarak_2',
                'nilai_seleksi.skor_usia',
                'nilai_seleksi.rata_rapor',
                'nilai_seleksi.nilai_tes_akademik',
                'nilai_seleksi.nilai_prestasi',
                'nilai_seleksi.nilai_akhir',
                'orang_tua_wali.nama_wali',
                'orang_tua_wali.alamat_wali',
                'orang_tua_wali.pekerjaan_wali',
                'orang_tua_wali.no_hp'
            )
            ->first();

        if (! $pendaftaran) {
            abort(404);
        }

        $berkas = DB::table('berkas_pendaftaran')
            ->where('pendaftaran_id', $id)
            ->get();

        return view('backend.peserta.detail', compact('pendaftaran', 'berkas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Peserta $peserta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Peserta $peserta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            // 1. Ambil data pendaftaran untuk mendapatkan ID pendaftaran
            $pendaftaran = DB::table('pendaftaran')->where('peserta_id', $id)->first();

            if ($pendaftaran) {
                // 2. Hapus direktori berkas secara keseluruhan
                $path = storage_path('app/berkas/'.$pendaftaran->id);
                if (File::isDirectory($path)) {
                    File::deleteDirectory($path);
                }

                // 3. Hapus data berkas, nilai, dan hasil seleksi
                DB::table('berkas_pendaftaran')->where('pendaftaran_id', $pendaftaran->id)->delete();
                DB::table('nilai_seleksi')->where('pendaftaran_id', $pendaftaran->id)->delete();
                DB::table('hasil_seleksi')->where('pendaftaran_id', $pendaftaran->id)->delete();

                // 4. Hapus data pendaftaran
                DB::table('pendaftaran')->where('id', $pendaftaran->id)->delete();
            }

            // 6. Hapus data orang tua / wali
            DB::table('orang_tua_wali')->where('peserta_id', $id)->delete();

            // 7. Hapus data peserta
            DB::table('peserta')->where('id', $id)->delete();

            DB::commit();

            return redirect()->route('peserta.index')->with('success', 'Data peserta berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('peserta.index')->with('error', 'Terjadi kesalahan saat menghapus data: '.$e->getMessage());
        }
    }

    public function register_create()
    {
        return view('backend.peserta.register');
    }

    public function register_store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'nik' => ['required', 'min:16', 'unique:users,username', 'numeric'],
            'password' => ['required', 'min:6', 'confirmed'],
            'terms' => ['accepted'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'username' => $request->nik,
            'nik' => $request->nik,
            'role' => 'peserta',
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('pendaftaran.index'));
    }

    public function login_create()
    {
        return view('backend.peserta.login-peserta');
    }

    public function login_store(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->route('pendaftaran.index');
        }

        return back()->withErrors([
            'username' => 'NIK atau password yang Anda masukkan salah.',
        ])->onlyInput('username');
    }

    public function detail_verifikasi($id)
    {
        $peserta = Peserta::with([
            'pendaftaran.jalur',
            'pendaftaran.sekolahPilihan1',
            'pendaftaran.sekolahPilihan2',
            'pendaftaran.berkas',
            'provinsi',
            'kabupaten',
            'kecamatan',
            'desa',
            'orang_tua',
        ])->findOrFail($id);

        return view('backend.peserta.detail_verifikasi', compact('peserta'));
    }
}
