<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = Slider::all();

        return view('backend.slider.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'caption' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $slider = new Slider;
        $slider->caption = $request->caption;

        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploads/slider'), $filename);
            $slider->gambar = '/uploads/slider/'.$filename;
        }

        $slider->save();

        return redirect()->route('slider.index')->with('success', 'Slider created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $slider = Slider::findOrFail($id);

        return view('backend.slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'caption' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $slider = Slider::findOrFail($id);

        $slider->caption = $request->caption;

        if ($request->hasFile('gambar')) {
            if ($slider->gambar && file_exists(public_path(ltrim($slider->gambar, '/')))) {
                @unlink(public_path(ltrim($slider->gambar, '/')));
            }

            $image = $request->file('gambar');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploads/slider'), $filename);
            $slider->gambar = '/uploads/slider/'.$filename;
        }

        $slider->save();

        return redirect()->route('slider.index')->with('success', 'Slider updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);

        if ($slider->gambar && file_exists(public_path(ltrim($slider->gambar, '/')))) {
            @unlink(public_path(ltrim($slider->gambar, '/')));
        }

        $slider->delete();

        return redirect()->route('slider.index')->with('success', 'Slider deleted successfully.');
    }
}
