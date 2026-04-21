<?php

namespace App\Http\Controllers;

use App\Models\JalurDaftar;
use App\Models\PeriodeDaftar;
use App\Models\PeriodeJalur;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class PeriodeDaftarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = PeriodeDaftar::all();

        return view('backend.pendaftaran.periode.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jalur = JalurDaftar::all();

        return view('backend.pendaftaran.periode.create', compact('jalur'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tahun_ajaran' => 'required|string|max:255',
            'peserta_daftar_mulai' => 'required|date',
            'peserta_daftar_selesai' => 'required|date',
            'verifikasi_mulai' => 'nullable|date',
            'verifikasi_selesai' => 'nullable|date',
            'tanggal_pengumuman_seleksi' => 'nullable|date',
            'daftar_ulang_mulai' => 'nullable|date',
            'daftar_ulang_selesai' => 'nullable|date',
            'tanggal_masuk_sekolah' => 'nullable|date',
            'tanggal_batas_usia_sd' => 'nullable|date',
            'usia_min_sd' => 'nullable|integer|min:0',
            'usia_max_sd' => 'nullable|integer|min:0',
            'tanggal_batas_usia_smp' => 'nullable|date',
            'usia_max_smp' => 'nullable|integer|min:0',
            'status_aktif' => 'required|boolean',
            'jalur_id' => 'required|array',
            'jalur_id.*' => 'exists:jalur_pendaftaran,id',
        ]);

        $periode = PeriodeDaftar::create($request->except('jalur_id'));

        if ($request->has('jalur_id')) {
            foreach ($request->jalur_id as $jalurId) {
                PeriodeJalur::create([
                    'periode_id' => $periode->id,
                    'jalur_id' => $jalurId,
                ]);
            }
        }

        return redirect()->route('periode.index')->with('success', 'Periode Pendaftaran berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(PeriodeDaftar $periodeDaftar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $periode = PeriodeDaftar::findOrFail($id);
        $jalur = JalurDaftar::all();

        // Ambil array jalur_id yang sudah dipilih oleh periode ini
        $selectedJalur = PeriodeJalur::where('periode_id', $id)->pluck('jalur_id')->toArray();

        return view('backend.pendaftaran.periode.edit', compact('periode', 'jalur', 'selectedJalur'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tahun_ajaran' => 'required|string|max:255',
            'peserta_daftar_mulai' => 'required|date',
            'peserta_daftar_selesai' => 'required|date',
            'verifikasi_mulai' => 'nullable|date',
            'verifikasi_selesai' => 'nullable|date',
            'tanggal_pengumuman_seleksi' => 'nullable|date',
            'daftar_ulang_mulai' => 'nullable|date',
            'daftar_ulang_selesai' => 'nullable|date',
            'tanggal_masuk_sekolah' => 'nullable|date',
            'tanggal_batas_usia_sd' => 'nullable|date',
            'usia_min_sd' => 'nullable|integer|min:0',
            'usia_max_sd' => 'nullable|integer|min:0',
            'tanggal_batas_usia_smp' => 'nullable|date',
            'usia_max_smp' => 'nullable|integer|min:0',
            'status_aktif' => 'required|boolean',
            'jalur_id' => 'required|array',
            'jalur_id.*' => 'exists:jalur_pendaftaran,id',
        ]);

        $periode = PeriodeDaftar::findOrFail($id);
        $periode->update($request->except('jalur_id'));

        if ($request->has('jalur_id')) {
            // Hapus jalur lama yang berelasi
            PeriodeJalur::where('periode_id', $id)->delete();

            // Insert jalur baru
            foreach ($request->jalur_id as $jalurId) {
                PeriodeJalur::create([
                    'periode_id' => $periode->id,
                    'jalur_id' => $jalurId,
                ]);
            }
        }

        return redirect()->route('periode.index')->with('success', 'Periode Pendaftaran berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $periode = PeriodeDaftar::findOrFail($id);
            // Hapus data relasi
            PeriodeJalur::where('periode_id', $id)->delete();

            $periode->delete();

            return redirect()->route('periode.index')->with('success', 'Periode Pendaftaran berhasil dihapus!');
        } catch (QueryException $e) {
            // Check for foreign key constraint violation
            if ($e->getCode() == '23000') {
                // Foreign key constraint violation
                return redirect()->route('periode.index')->with('error', 'Tidak dapat menghapus periode pendaftaran karena masih ada data pendaftaran yang terkait. Silakan hapus data pendaftaran terlebih dahulu.');
            }

            // Other database errors
            return redirect()->route('periode.index')->with('error', 'Terjadi kesalahan saat menghapus data: '.$e->getMessage());
        } catch (\Exception $e) {
            return redirect()->route('periode.index')->with('error', 'Terjadi kesalahan yang tidak terduga.');
        }
    }
}
