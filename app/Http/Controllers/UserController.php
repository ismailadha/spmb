<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select('*');

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
                                        <button type="button" class="dropdown-item text-danger btn-delete" data-nama="'.$row->name.'">Delete</button>
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

        return view('backend.user.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $role = $request->role;
        $username = $role === 'peserta' ? $request->nik : $request->username;
        $nik = $role === 'peserta' ? $request->nik : null;

        User::create([
            'name' => $request->name,
            'nik' => $nik,
            'username' => $username,
            'password' => Hash::make($request->password),
            'role' => $role,
        ]);

        return redirect()->route('pengguna.index')->with('success', 'Data pengguna berhasil ditambahkan.');
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
        return view('backend.user.edit', ['user' => $pengguna]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $pengguna)
    {
        $role = $request->role;
        $username = $role === 'peserta' ? $request->nik : $request->username;
        $nik = $request->nik;

        $data = [
            'name' => $request->name,
            'nik' => $nik,
            'username' => $username,
            'role' => $role,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $pengguna->update($data);

        return redirect()->route('pengguna.index')->with('success', 'Data pengguna berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $pengguna)
    {
        $pengguna->delete();

        return redirect()->route('pengguna.index')->with('success', 'Data pengguna berhasil dihapus.');
    }
}
