<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::orderBy('tanggal', 'desc')->get();

        return view('backend.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:120',
            'slug' => 'required|unique:posts,slug',
            'thumbnail' => 'required|string',
            'content' => 'required',
        ]);

        DB::beginTransaction();

        try {
            Post::create([
                'title' => $request->title,
                'slug' => $request->slug,
                'thumbnail' => $request->thumbnail,
                'content' => $request->content,
                'tanggal' => $request->published_at,
                'status' => $request->status,
                'user_name' => auth()->user()->name,
            ]);

            DB::commit();

            return redirect()->route('posts.index')->with('success', 'Post created successfully.');
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->route('posts.index')
                ->with('error', 'Failed to create post: '.$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('backend.post.detail', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('backend.post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:120',
            'slug' => 'required|unique:posts,slug,'.$post->id,
            'content' => 'required',
        ]);

        DB::beginTransaction();

        try {
            $data = [
                'title' => $request->title,
                'slug' => $request->slug,
                'content' => $request->content,
                'tanggal' => $request->published_at,
                'status' => $request->status,
            ];

            if ($request->filled('thumbnail')) {
                $data['thumbnail'] = $request->thumbnail;
            }

            $post->update($data);

            DB::commit();

            return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->route('posts.index')
                ->with('error', 'Failed to update post: '.$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}
