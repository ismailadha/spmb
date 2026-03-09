<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $sliders = \App\Models\Slider::all();
        $posts = \App\Models\Post::where('status', 'published')->latest()->take(3)->get();
        return view('frontend.index', compact('sliders', 'posts'));
    }
}
