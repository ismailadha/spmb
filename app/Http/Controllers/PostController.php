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
            'thumbnail' => 'required',
            'content' => 'required',
        ]);

        $thumbnailName = time().'_'.$request->file('thumbnail')->getClientOriginalName();
        // store to public/storage/thumbnails
        $request->file('thumbnail')->storeAs('thumbnails', $thumbnailName, 'public');

        DB::beginTransaction();

        try {
            $post = Post::create([
                'title' => $request->title,
                'slug' => $request->slug,
                'thumbnail' => $thumbnailName,
                'content' => $request->content,
                'tanggal' => $request->published_at,
                'status' => $request->status,
                'user_name' => auth()->user()->name,
            ]);

            return redirect()->route('posts.index')->with('success', 'Post created successfully.');
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->route('posts.index')
                ->with('error', 'Failed to create post: '.$e->getMessage());
        } finally {
            DB::commit();
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
            $post->update([
                'title' => $request->title,
                'slug' => $request->slug,
                'content' => $request->content,
                'tanggal' => $request->published_at,
                'status' => $request->status,
            ]);

            if ($request->hasFile('thumbnail')) {
                // delete old thumbnail from public/storage/thumbnails
                \Storage::disk('public')->delete('thumbnails/'.$post->thumbnail);

                $thumbnailName = time().'_'.$request->file('thumbnail')->getClientOriginalName();
                // store to public/storage/thumbnails
                $request->file('thumbnail')->storeAs('thumbnails', $thumbnailName, 'public');

                $post->update(['thumbnail' => $thumbnailName]);
            }

            return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->route('posts.index')
                ->with('error', 'Failed to update post: '.$e->getMessage());
        } finally {
            DB::commit();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // delete thumbnail from public/storage/thumbnails
        \Storage::disk('public')->delete('thumbnails/'.$post->thumbnail);
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}
