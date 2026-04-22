<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Sekolah;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $role_filter = $request->get('role');

        if (! $role_filter && ! $request->ajax()) {
            return redirect()->route('pengguna.administrator');
        }

        if ($request->ajax()) {
            $data = User::query();

            if ($role_filter === 'administrator') {
                $data->whereIn('role', ['admin_dinas', 'admin_sekolah']);
            } elseif ($role_filter === 'operator') {
                $data->where('role', 'operator_sekolah');
            } elseif ($role_filter === 'peserta') {
                $data->where('role', 'peserta');
            }

            if (auth()->user()->role === 'admin_sekolah') {
                $data->where('sekolah_id', auth()->user()->sekolah_id);
            }

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('name', function ($row) {
                    return '<div class="fw-bolder text-dark">'.$row->name.'</div>';
                })
                ->addColumn('action', function ($row) {
                    return '
                        <div class="dropdown">
                            <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Action
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="'.route('pengguna.edit', $row->id).'">Edit</a></li>
                                <li>
                                    <form action="'.route('pengguna.destroy', $row->id).'" method="POST" style="margin: 0;" class="form-delete">
                                        '.csrf_field().'
                                        '.method_field('DELETE').'
                                        <button type="button" class="dropdown-item text-danger btn-delete" data-nama="'.$row->name.'" data-role="'.$row->role.'">Delete</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    ';
                })
                ->editColumn('username', function ($row) {
                    return '<div class="badge badge-light-dark">'.$row->username.'</div>';
                })
                ->editColumn('role', function ($row) {
                    $role = strtolower($row->role ?? '');
                    switch ($role) {
                        case 'admin_dinas':
                            $class = 'badge-light-primary';
                            $text = 'Admin Dinas';
                            break;
                        case 'admin_sekolah':
                            $class = 'badge-light-warning';
                            $text = 'Admin Sekolah';
                            break;
                        case 'operator_sekolah':
                            $class = 'badge-light-info';
                            $text = 'Operator Sekolah';
                            break;
                        case 'peserta':
                            $class = 'badge-light-success';
                            $text = 'Peserta';
                            break;
                        default:
                            $class = 'badge-light-secondary';
                            $text = ucfirst($role);
                            break;
                    }

                    return '<span class="badge '.$class.' fw-bolder px-4 py-2">'.$text.'</span>';
                })
                ->rawColumns(['action', 'name', 'username', 'role'])
                ->make(true);
        }

        return view('backend.user.index', compact('role_filter'));
    }

    /**
     * Display a listing of administrator users.
     */
    public function administrator(Request $request)
    {
        $request->merge(['role' => 'administrator']);

        return $this->index($request);
    }

    /**
     * Display a listing of peserta users.
     */
    public function peserta(Request $request)
    {
        $request->merge(['role' => 'peserta']);

        return $this->index($request);
    }

    /**
     * Display a listing of operator sekolah users.
     */
    public function operator(Request $request)
    {
        $request->merge(['role' => 'operator']);

        return $this->index($request);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sekolah = auth()->user()->role === 'admin_sekolah'
            ? Sekolah::where('id', auth()->user()->sekolah_id)->get()
            : Sekolah::orderBy('nama_sekolah')->get();

        return view('backend.user.create', compact('sekolah'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $role = auth()->user()->role === 'admin_sekolah' ? 'operator_sekolah' : $request->role;
        $username = $role === 'peserta' ? $request->nik : $request->username;
        $nik = $role === 'peserta' ? $request->nik : null;
        $sekolah_id = auth()->user()->role === 'admin_sekolah' ? auth()->user()->sekolah_id : $request->sekolah_id;

        $user = User::create([
            'name' => $request->name,
            'nik' => $nik,
            'username' => $username,
            'password' => Hash::make($request->password),
            'role' => $role,
            'sekolah_id' => in_array($role, ['admin_sekolah', 'operator_sekolah']) ? $sekolah_id : null,
        ]);

        $redirectRoute = 'pengguna.peserta';
        if (in_array($role, ['admin_dinas', 'admin_sekolah'])) {
            $redirectRoute = 'pengguna.administrator';
        } elseif ($role === 'operator_sekolah') {
            $redirectRoute = 'pengguna.operator';
        }

        return redirect()->route($redirectRoute)->with('success', 'Data pengguna berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $pengguna)
    {
        if (auth()->user()->role === 'admin_sekolah' && ($pengguna->role !== 'operator_sekolah' || $pengguna->sekolah_id !== auth()->user()->sekolah_id)) {
            abort(403, 'Akses ditolak.');
        }

        $sekolah = auth()->user()->role === 'admin_sekolah'
            ? Sekolah::where('id', auth()->user()->sekolah_id)->get()
            : Sekolah::orderBy('nama_sekolah')->get();

        return view('backend.user.edit', [
            'user' => $pengguna,
            'sekolah' => $sekolah,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $pengguna)
    {
        if (auth()->user()->role === 'admin_sekolah' && ($pengguna->role !== 'operator_sekolah' || $pengguna->sekolah_id !== auth()->user()->sekolah_id)) {
            abort(403, 'Akses ditolak.');
        }

        $role = auth()->user()->role === 'admin_sekolah' ? 'operator_sekolah' : $request->role;
        $username = $role === 'peserta' ? $request->nik : $request->username;
        $nik = $request->nik;
        $sekolah_id = auth()->user()->role === 'admin_sekolah' ? auth()->user()->sekolah_id : $request->sekolah_id;

        $data = [
            'name' => $request->name,
            'nik' => $nik,
            'username' => $username,
            'role' => $role,
            'sekolah_id' => in_array($role, ['admin_sekolah', 'operator_sekolah']) ? $sekolah_id : null,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $pengguna->update($data);

        $redirectRoute = 'pengguna.peserta';
        if (in_array($role, ['admin_dinas', 'admin_sekolah'])) {
            $redirectRoute = 'pengguna.administrator';
        } elseif ($role === 'operator_sekolah') {
            $redirectRoute = 'pengguna.operator';
        }

        return redirect()->route($redirectRoute)->with('success', 'Data pengguna berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $pengguna)
    {
        if (auth()->user()->role === 'admin_sekolah' && ($pengguna->role !== 'operator_sekolah' || $pengguna->sekolah_id !== auth()->user()->sekolah_id)) {
            abort(403, 'Akses ditolak.');
        }

        // Hapus direktori berkas jika user adalah peserta
        if ($pengguna->role === 'peserta' && $pengguna->peserta) {
            $pendaftaran = $pengguna->peserta->pendaftaran;
            if ($pendaftaran) {
                $path = storage_path('app/berkas/'.$pendaftaran->id);
                if (File::isDirectory($path)) {
                    File::deleteDirectory($path);
                }
            }
        }

        $role = $pengguna->role;
        $pengguna->delete();

        $redirectRoute = 'pengguna.peserta';
        if (in_array($role, ['admin_dinas', 'admin_sekolah'])) {
            $redirectRoute = 'pengguna.administrator';
        } elseif ($role === 'operator_sekolah') {
            $redirectRoute = 'pengguna.operator';
        }

        return redirect()->route($redirectRoute)->with('success', 'Data pengguna berhasil dihapus.');
    }
}
