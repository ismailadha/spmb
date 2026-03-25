<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $sliders = \App\Models\Slider::all();
        $sambutans = \App\Models\Sambutan::where('is_active', 1)->orderBy('sort_order', 'asc')->take(2)->get();
        $posts = \App\Models\Post::whereIn('status', ['Publish', 'Published'])->orderBy('tanggal', 'desc')->take(3)->get();
        
        return view('frontend.index', compact('sliders', 'sambutans', 'posts'));
    }

    public function showPost($slug)
    {
        $post = \App\Models\Post::where('slug', $slug)->firstOrFail();
        $recent_posts = \App\Models\Post::whereIn('status', ['Publish', 'Published'])
            ->where('id', '!=', $post->id)
            ->orderBy('tanggal', 'desc')
            ->take(5)
            ->get();
            
        return view('frontend.detail_post', compact('post', 'recent_posts'));
    }
}
