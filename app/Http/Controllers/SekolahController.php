<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Requests\SekolahRequest;
use App\Models\Desa;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Provinsi;
use App\Models\Sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class SekolahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Sekolah::select('*');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status_unggulan', function ($row) {
                    if ($row->status_unggulan == 1) {
                        return '<span class="badge badge-success"><i class="ki-duotone ki-check-circle" style="display: inline; margin-right: 4px;"></i>Unggulan</span>';
                    } elseif ($row->status_unggulan == 0) {
                        return '<span class="badge badge-secondary">Non-Unggulan</span>';
                    } else {
                        return '<span class="badge badge-light text-dark">-</span>';
                    }
                })
                ->addColumn('action', function ($row) {
                    return '
                        <div class="dropdown">
                            <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Action
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="'.route('sekolah.show', $row->id).'">View</a></li>
                                <li><a class="dropdown-item" href="'.route('sekolah.edit', $row->id).'">Edit</a></li>
                                <li>
                                    <form action="'.route('sekolah.destroy', $row->id).'" method="POST" style="margin: 0;">
                                        '.csrf_field().'
                                        '.method_field('DELETE').'
                                        <button type="submit" class="dropdown-item text-danger" onclick="return confirm(\'Are you sure?\')">Delete</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    ';
                })
                ->rawColumns(['status_unggulan', 'action'])
                ->make(true);
        }

        return view('backend.sekolah.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $provinsi = Provinsi::all();

        return view('backend.sekolah.create', compact('provinsi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SekolahRequest $request)
    {
        try {
            DB::table('sekolah')->insert($request->validated());

            return redirect()->route('sekolah.index')->with('success', 'Sekolah berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal menambahkan sekolah: '.$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Sekolah $sekolah)
    {
        $sekolah->load(['provinsi', 'kabupaten', 'kecamatan', 'desa']);

        return view('backend.sekolah.show', compact('sekolah'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sekolah $sekolah)
    {
        $provinsi = Provinsi::all();
        $kabupaten = Kabupaten::where('id_provinsi', $sekolah->id_provinsi)->get();
        $kecamatan = Kecamatan::where('id_kabupaten', $sekolah->id_kabupaten)->get();
        $desa = Desa::where('id_kecamatan', $sekolah->id_kecamatan)->get();

        return view('backend.sekolah.edit', compact('sekolah', 'provinsi', 'kabupaten', 'kecamatan', 'desa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SekolahRequest $request, Sekolah $sekolah)
    {
        try {
            DB::table('sekolah')
                ->where('id', $sekolah->id)
                ->update($request->validated());

            return redirect()->route('sekolah.index')->with('success', 'Sekolah berhasil diupdate');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal mengupdate sekolah: '.$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sekolah $sekolah)
    {
        $sekolah->delete();

        return redirect()->route('sekolah.index')->with('success', 'Sekolah berhasil dihapus');
    }
}
