<?php

namespace App\Http\Controllers;

use App\Models\JadwalDaftar;
use App\Models\JadwalTahapan;
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
        $jadwal = DB::table('jadwal_pendaftaran')
            ->join('sekolah_jalur', 'jadwal_pendaftaran.sekolah_jalur_id', '=', 'sekolah_jalur.id')
            ->join('sekolah', 'sekolah_jalur.sekolah_id', '=', 'sekolah.id')
            ->join('jalur_pendaftaran', 'sekolah_jalur.jalur_id', '=', 'jalur_pendaftaran.id')
            ->join('periode_pendaftaran', 'sekolah_jalur.periode_id', '=', 'periode_pendaftaran.id')
            ->select('jadwal_pendaftaran.*', 'sekolah.nama_sekolah', 'jalur_pendaftaran.nama_jalur', 'periode_pendaftaran.tahun_ajaran', 'periode_pendaftaran.tanggal_mulai as periode_mulai', 'periode_pendaftaran.tanggal_selesai as periode_selesai', 'sekolah_jalur.kuota')
            ->where('jadwal_pendaftaran.id', $id)
            ->first();

        $tahapan = JadwalTahapan::where('jadwal_id', $id)->orderBy('tanggal_mulai', 'asc')->get();

        return view('backend.pendaftaran.jadwal.detail', compact('jadwal', 'tahapan'));
    }

    // store jadwal tahapan
    public function storeTahapan(Request $request)
    {
        $request->validate([
            'jadwal_id' => 'required',
            'nama_tahapan' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $tahapan = JadwalTahapan::create([
            'jadwal_id' => $request->jadwal_id,
            'nama_tahapan' => $request->nama_tahapan,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('jadwal.show', $request->jadwal_id)->with('success', 'Tahapan berhasil ditambahkan!');
    }

    // hapus jadwal tahapan
    public function destroyTahapan($id)
    {
        $tahapan = JadwalTahapan::find($id);
        $tahapan->delete();

        return redirect()->route('jadwal.show', $tahapan->jadwal_id)->with('success', 'Tahapan berhasil dihapus!');
    }

    // update jadwal tahapan
    public function updateTahapan(Request $request, $id)
    {
        $request->validate([
            'tahapan_id' => 'required',
            'nama_tahapan' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $tahapan = JadwalTahapan::find($request->tahapan_id);
        $tahapan->nama_tahapan = $request->nama_tahapan;
        $tahapan->tanggal_mulai = $request->tanggal_mulai;
        $tahapan->tanggal_selesai = $request->tanggal_selesai;
        $tahapan->keterangan = $request->keterangan;
        $tahapan->save();

        return redirect()->route('jadwal.show', $request->jadwal_id)->with('success', 'Tahapan berhasil diupdate!');
    }
}
