<?php

namespace App\Http\Controllers;

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
            $data = Sekolah::query();
            if (auth()->user()->role == 'admin_sekolah') {
                $data->where('id', auth()->user()->sekolah_id);
            }

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('sekolah_info', function ($row) {
                    $badgeArr = [
                        'TK' => 'badge-light-primary',
                        'SD' => 'badge-light-success',
                        'SMP' => 'badge-light-info',
                        'SMA' => 'badge-light-warning',
                    ];
                    $badge = $badgeArr[$row->jenjang] ?? 'badge-light-secondary';

                    return '
                        <div class="d-flex flex-column">
                            <a href="'.route('sekolah.show', $row->id).'" class="text-gray-800 text-hover-primary mb-1 fw-bolder">'.$row->nama_sekolah.'</a>
                            <div class="d-flex align-items-center">
                                <span class="badge '.$badge.' fs-9 px-2 py-1 me-2">'.$row->jenjang.'</span>
                                <span class="text-muted fs-7">NPSN: '.$row->npsn.'</span>
                            </div>
                        </div>
                    ';
                })
                ->addColumn('total_daya_tampung', function ($row) {
                    return $row->total_daya_tampung;
                })
                ->addColumn('status_pilihan_1', function ($row) {
                    if ($row->status_pilihan_1 == 1) {
                        return '<span class="badge badge-light-primary fw-bolder">Pilihan 1</span>';
                    } elseif ($row->status_pilihan_1 == 0 && $row->status_pilihan_1 !== null) {
                        return '<span class="badge badge-light-secondary fw-bolder">Pilihan 2</span>';
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
                                        <button type="button" class="dropdown-item text-danger btn-delete" data-nama="'.$row->nama_sekolah.'">Delete</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    ';
                })
                ->rawColumns(['sekolah_info', 'status_pilihan_1', 'action'])
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
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'nama_sekolah' => 'required|string|max:255',
                'npsn' => 'nullable|string|max:255|unique:sekolah,npsn',
                'jenjang' => 'required|in:TK,SD,SMP,SMA',
                'id_provinsi' => 'nullable|exists:provinsi,id',
                'id_kabupaten' => 'nullable|exists:kabupaten,id',
                'id_kecamatan' => 'nullable|exists:kecamatan,id',
                'id_desa' => 'nullable|exists:desa,id',
                'alamat' => 'nullable|string',
                'email' => 'nullable|email|max:255',
                'kode_pos' => 'nullable|string|max:10',
                'website' => 'nullable|url|max:255',
                'telepon' => 'nullable|string|max:20',
                'latitude' => 'nullable|numeric|between:-90,90',
                'longitude' => 'nullable|numeric|between:-180,180',
                'status_perbatasan' => 'nullable|boolean',
                'status_unggulan' => 'nullable|boolean',
                'status_pilihan_1' => 'nullable|boolean',
                'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'daya_tampung_prestasi' => 'required|integer|min:0',
                'daya_tampung_domisili' => 'required|integer|min:0',
                'daya_tampung_afirmasi' => 'required|integer|min:0',
                'daya_tampung_mutasi' => 'required|integer|min:0',
            ], [
                'nama_sekolah.required' => 'Nama sekolah wajib diisi.',
                'npsn.unique' => 'NPSN sudah digunakan.',
                'email.email' => 'Format email tidak valid.',
                'website.url' => 'Format website tidak valid.',
            ]);

            if ($request->hasFile('thumbnail')) {
                $file = $request->file('thumbnail');
                $filename = time().'.'.$file->getClientOriginalExtension();

                // Ensure directory exists
                $uploadDir = public_path('uploads/sekolah');
                if (! file_exists($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }

                $file->move($uploadDir, $filename);
                $data['thumbnail'] = 'uploads/sekolah/'.$filename;
            }

            DB::table('sekolah')->insert($data);

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
    public function update(Request $request, Sekolah $sekolah)
    {
        try {
            $data = $request->validate([
                'nama_sekolah' => 'required|string|max:255',
                'npsn' => 'nullable|string|max:255|unique:sekolah,npsn,'.$sekolah->id,
                'jenjang' => 'required|in:TK,SD,SMP,SMA',
                'id_provinsi' => 'nullable|exists:provinsi,id',
                'id_kabupaten' => 'nullable|exists:kabupaten,id',
                'id_kecamatan' => 'nullable|exists:kecamatan,id',
                'id_desa' => 'nullable|exists:desa,id',
                'alamat' => 'nullable|string',
                'email' => 'nullable|email|max:255',
                'kode_pos' => 'nullable|string|max:10',
                'website' => 'nullable|url|max:255',
                'telepon' => 'nullable|string|max:20',
                'latitude' => 'nullable|numeric|between:-90,90',
                'longitude' => 'nullable|numeric|between:-180,180',
                'status_perbatasan' => 'nullable|boolean',
                'status_unggulan' => 'nullable|boolean',
                'status_pilihan_1' => 'nullable|boolean',
                'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'daya_tampung_prestasi' => 'required|integer|min:0',
                'daya_tampung_domisili' => 'required|integer|min:0',
                'daya_tampung_afirmasi' => 'required|integer|min:0',
                'daya_tampung_mutasi' => 'required|integer|min:0',
            ], [
                'nama_sekolah.required' => 'Nama sekolah wajib diisi.',
                'npsn.unique' => 'NPSN sudah digunakan.',
                'email.email' => 'Format email tidak valid.',
                'website.url' => 'Format website tidak valid.',
            ]);

            if ($request->hasFile('thumbnail')) {
                // Delete old thumbnail
                if ($sekolah->thumbnail && file_exists(public_path($sekolah->thumbnail))) {
                    unlink(public_path($sekolah->thumbnail));
                }

                $file = $request->file('thumbnail');
                $filename = time().'.'.$file->getClientOriginalExtension();

                // Ensure directory exists
                $uploadDir = public_path('uploads/sekolah');
                if (! file_exists($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }

                $file->move($uploadDir, $filename);
                $data['thumbnail'] = 'uploads/sekolah/'.$filename;
            } else {
                // Remove thumbnail from data to prevent overwriting with null
                unset($data['thumbnail']);
            }

            DB::table('sekolah')->where('id', $sekolah->id)->update($data);

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
        try {
            // Delete old thumbnail if exists
            if ($sekolah->thumbnail && file_exists(public_path($sekolah->thumbnail))) {
                unlink(public_path($sekolah->thumbnail));
            }

            $sekolah->delete();

            return redirect()->route('sekolah.index')->with('success', 'Sekolah berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus sekolah: '.$e->getMessage());
        }
    }
}
