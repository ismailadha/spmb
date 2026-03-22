<?php

namespace App\Http\Controllers;

use App\Models\Sambutan;
use Illuminate\Http\Request;

class SambutanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sambutans = Sambutan::orderBy('sort_order', 'asc')->get();

        return view('backend.sambutan.index', compact('sambutans'));
    }

    public function create()
    {
        return view('backend.sambutan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'nama_pejabat' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|string',
            'isi_sambutan' => 'required|string',
            'is_active' => 'required|boolean',
            'sort_order' => 'required|integer',
        ]);

        Sambutan::create($request->all());

        return redirect()->route('sambutan.index')->with('success', 'Sambutan created successfully.');
    }

    public function show($id)
    {
        $sambutan = Sambutan::findOrFail($id);

        return view('backend.sambutan.show', compact('sambutan'));
    }

    public function edit($id)
    {
        $sambutan = Sambutan::findOrFail($id);

        return view('backend.sambutan.edit', compact('sambutan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pejabat' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|string',
            'isi_sambutan' => 'required|string',
            'is_active' => 'required|boolean',
            'sort_order' => 'required|integer',
        ]);

        $sambutan = Sambutan::findOrFail($id);
        $sambutan->update($request->except(['id'])); // Prevent changing ID

        return redirect()->route('sambutan.index')->with('success', 'Sambutan updated successfully.');
    }

    public function destroy($id)
    {
        $sambutan = Sambutan::findOrFail($id);
        $sambutan->delete();

        return redirect()->route('sambutan.index')->with('success', 'Sambutan deleted successfully.');
    }
}
