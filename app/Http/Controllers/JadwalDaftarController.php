<?php

namespace App\Http\Controllers;

use App\Models\JadwalDaftar;
use App\Models\JalurDaftar;
use App\Models\PeriodeDaftar;
use App\Models\Sekolah;
use App\Models\SekolahJalur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JadwalDaftarController extends Controller
{
    public function index()
    {
        // Simple join to get schedule list. In real-world, might use Eloquent relations heavily
        $jadwals = DB::table('jadwal_pendaftaran')
            ->join('sekolah_jalur', 'jadwal_pendaftaran.sekolah_jalur_id', '=', 'sekolah_jalur.id')
            ->join('sekolah', 'sekolah_jalur.sekolah_id', '=', 'sekolah.id')
            ->join('jalur_pendaftaran', 'sekolah_jalur.jalur_id', '=', 'jalur_pendaftaran.id')
            ->join('periode_pendaftaran', 'sekolah_jalur.periode_id', '=', 'periode_pendaftaran.id')
            ->select('jadwal_pendaftaran.*', 'sekolah.nama_sekolah', 'jalur_pendaftaran.nama_jalur', 'periode_pendaftaran.tahun_ajaran', 'periode_pendaftaran.tanggal_mulai as periode_mulai', 'periode_pendaftaran.tanggal_selesai as periode_selesai', 'sekolah_jalur.kuota')
            ->get();

        return view('backend.pendaftaran.jadwal.index', compact('jadwals'));
    }

    public function create()
    {
        $periodes = PeriodeDaftar::all()->where('status_aktif', 1);
        $sekolahs = Sekolah::all();
        $jalurs = JalurDaftar::all();

        return view('backend.pendaftaran.jadwal.create', compact('periodes', 'sekolahs', 'jalurs'));
    }

    public function store(Request $request)
    {
        // Find or create SekolahJalur
        $sekolahJalur = SekolahJalur::firstOrCreate([
            'sekolah_id' => $request->sekolah_id,
            'jalur_id' => $request->jalur_id,
            'periode_id' => $request->periode_id,
        ], [
            'kuota' => $request->kuota ?? 0,
            'status' => 1,
        ]);

        // If exists, make sure kuota is updated if requested
        if ($request->filled('kuota')) {
            $sekolahJalur->update(['kuota' => $request->kuota]);
        }

        // Store Jadwal Pendaftaran
        JadwalDaftar::create([
            'sekolah_jalur_id' => $sekolahJalur->id,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'status' => 'draft',
        ]);

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil disimpan!');
    }

    public function show($id)
    {
        return view('backend.pendaftaran.jadwal.detail');
    }
}
