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
                ->addColumn('status_perbatasan', function ($row) {
                    if ($row->status_perbatasan == 1) {
                        return '<span class="badge badge-success"><i class="ki-duotone ki-check-circle" style="display: inline; margin-right: 4px;"></i>Perbatasan</span>';
                    } elseif ($row->status_perbatasan == 0) {
                        return '<span class="badge badge-secondary">Non-Perbatasan</span>';
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
                ->rawColumns(['status_perbatasan', 'action'])
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
