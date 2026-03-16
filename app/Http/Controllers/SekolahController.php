<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Requests\SekolahRequest;
use App\Models\Sekolah;
use Illuminate\Http\Request;
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
                ->addColumn('action', function ($row) {
                    return '<div class="btn-group" role="group">
                                <a href="'.route('sekolah.show', $row->id).'" class="btn btn-sm btn-info">View</a>
                                <a href="'.route('sekolah.edit', $row->id).'" class="btn btn-sm btn-primary">Edit</a>
                                <form action="'.route('sekolah.destroy', $row->id).'" method="POST" style="display: inline;">
                                    '.csrf_field().'
                                    '.method_field('DELETE').'
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Are you sure?\')">Delete</button>
                                </form>
                            </div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('backend.sekolah.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.sekolah.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SekolahRequest $request)
    {
        Sekolah::create($request->validated());

        return redirect()->route('sekolah.index')->with('success', 'Sekolah berhasil ditambahkan');
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
        return view('backend.sekolah.edit', compact('sekolah'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SekolahRequest $request, Sekolah $sekolah)
    {
        $sekolah->update($request->validated());

        return redirect()->route('sekolah.index')->with('success', 'Sekolah berhasil diupdate');
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
