<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class KelulusanController extends Controller
{
    /**
     * Display a listing of SD graduation.
     */
    public function kelulusan_sd()
    {
        $periode = DB::table('periode_pendaftaran')
            ->where('status_aktif', 1)
            ->first();

        $semuaPeriode = DB::table('periode_pendaftaran')
            ->orderBy('id', 'desc')
            ->get();

        $semuaJalur = DB::table('jalur_pendaftaran')->get();

        return view('backend.kelulusan.kelulusan_sd', compact('periode', 'semuaPeriode', 'semuaJalur'));
    }

    /**
     * Get data for SD graduation DataTable.
     */
    public function data_sd(Request $request)
    {
        $periode = DB::table('periode_pendaftaran')
            ->where('status_aktif', 1)
            ->first();

        $periodeId = $request->get('periode_id') ?: ($periode->id ?? null);
        $jalurId = $request->get('jalur_id');

        $data = DB::table('pendaftaran')
            ->join('peserta', 'pendaftaran.peserta_id', '=', 'peserta.id')
            ->join('jalur_pendaftaran', 'pendaftaran.jalur_id', '=', 'jalur_pendaftaran.id')
            ->where('pendaftaran.periode_id', $periodeId)
            ->where('pendaftaran.jenjang', 'SD')
            ->where('pendaftaran.status', 'verifikasi')
            ->when($jalurId, function ($query, $jalurId) {
                return $query->where('pendaftaran.jalur_id', $jalurId);
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
                if ($row->status == 'Selesai') {
                    return '<span class="badge badge-light-success fw-bolder px-4 py-3">Selesai</span>';
                } elseif ($row->status == 'Draft') {
                    return '<span class="badge badge-light-warning fw-bolder px-4 py-3">Draft</span>';
                } else {
                    return '<span class="badge badge-light-info fw-bolder px-4 py-3">'.$row->status.'</span>';
                }
            })
            ->addColumn('action', function ($row) {
                return '<button type="button" class="btn btn-sm btn-primary btn-luluskan" data-id="'.$row->id.'">Luluskan</button>';
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    /**
     * Display a listing of SMP graduation.
     */
    public function kelulusan_smp()
    {
        $periode = DB::table('periode_pendaftaran')
            ->where('status_aktif', 1)
            ->first();

        $semuaPeriode = DB::table('periode_pendaftaran')
            ->orderBy('id', 'desc')
            ->get();

        $semuaJalur = DB::table('jalur_pendaftaran')->get();

        return view('backend.kelulusan.kelulusan_smp', compact('periode', 'semuaPeriode', 'semuaJalur'));
    }

    /**
     * Get data for SMP graduation DataTable.
     */
    public function data_smp(Request $request)
    {
        $periode = DB::table('periode_pendaftaran')
            ->where('status_aktif', 1)
            ->first();

        $periodeId = $request->get('periode_id') ?: ($periode->id ?? null);
        $jalurId = $request->get('jalur_id');

        $data = DB::table('pendaftaran')
            ->join('peserta', 'pendaftaran.peserta_id', '=', 'peserta.id')
            ->join('jalur_pendaftaran', 'pendaftaran.jalur_id', '=', 'jalur_pendaftaran.id')
            ->where('pendaftaran.periode_id', $periodeId)
            ->where('pendaftaran.jenjang', 'SMP')
            ->where('pendaftaran.status', 'verifikasi')
            ->when($jalurId, function ($query, $jalurId) {
                return $query->where('pendaftaran.jalur_id', $jalurId);
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
                if ($row->status == 'Selesai') {
                    return '<span class="badge badge-light-success fw-bolder px-4 py-3">Selesai</span>';
                } elseif ($row->status == 'Draft') {
                    return '<span class="badge badge-light-warning fw-bolder px-4 py-3">Draft</span>';
                } else {
                    return '<span class="badge badge-light-info fw-bolder px-4 py-3">'.$row->status.'</span>';
                }
            })
            ->addColumn('action', function ($row) {
                return '<button type="button" class="btn btn-sm btn-primary btn-luluskan" data-id="'.$row->id.'">Luluskan</button>';
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }
}
