<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;
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

        if ($request->ajax()) {
            $periodeId = $request->get('periode_id');
            if (! $periodeId && $periode) {
                $periodeId = $periode->id;
            }

            $data = DB::table('pendaftaran')
                ->join('peserta', 'pendaftaran.peserta_id', '=', 'peserta.id')
                ->join('jalur_pendaftaran', 'pendaftaran.jalur_id', '=', 'jalur_pendaftaran.id')
                ->where('pendaftaran.periode_id', $periodeId)
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

        return view('backend.peserta.index', compact('periode', 'semuaPeriode'));
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
    public function show(Peserta $peserta)
    {
        //
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
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
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

        return redirect(route('dashboard', absolute: false));
    }

    public function login_create()
    {
        return view('backend.peserta.login-peserta');
    }

    public function login_store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'nik' => ['required', 'min:16', 'unique:users,username', 'numeric'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
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

        return redirect(route('dashboard', absolute: false));
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
