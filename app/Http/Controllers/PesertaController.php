<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

        if ($request->ajax()) {
            $data = DB::table('pendaftaran')
                ->join('peserta', 'pendaftaran.peserta_id', '=', 'peserta.id')
                ->join('jalur_pendaftaran', 'pendaftaran.jalur_id', '=', 'jalur_pendaftaran.id')
                ->where('pendaftaran.periode_id', $periode->id)
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
                                    <form action="'.route('peserta.destroy', $row->id).'" method="POST" style="margin: 0;">
                                        '.csrf_field().'
                                        '.method_field('DELETE').'
                                        <button type="submit" class="dropdown-item text-danger" onclick="return confirm(\'Are you sure?\')">Delete</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    ';
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        return view('backend.peserta.index');
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
    public function destroy(Peserta $peserta)
    {
        //
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
