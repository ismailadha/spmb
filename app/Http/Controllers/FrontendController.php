<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Sambutan;
use App\Models\Slider;

class FrontendController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        $sambutans = Sambutan::where('is_active', 1)->orderBy('sort_order', 'asc')->take(2)->get();
        $posts = Post::whereIn('status', ['Publish', 'Published'])->orderBy('tanggal', 'desc')->take(3)->get();

        return view('frontend.index', compact('sliders', 'sambutans', 'posts'));
    }

    public function showPost($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $recent_posts = Post::whereIn('status', ['Publish', 'Published'])
            ->where('id', '!=', $post->id)
            ->orderBy('tanggal', 'desc')
            ->take(5)
            ->get();

        return view('frontend.detail_post', compact('post', 'recent_posts'));
    }
}
