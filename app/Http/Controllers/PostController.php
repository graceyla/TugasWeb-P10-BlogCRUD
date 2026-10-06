<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Throwable;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->query('q');

        $posts = Post::search($keyword)
            ->latest()
            ->paginate(6)
            ->withQueryString(); // biar keyword pencarian ga hilang pas pindah halaman

        return view('posts.index', compact('posts', 'keyword'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create', ['kategori' => Post::KATEGORI]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $data = $request->validated();

        try {
            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('posts', 'public');
            }

            $post = Post::create($data);
        } catch (Throwable $e) {
            report($e);

            return back()->withInput()->with('error', 'Post gagal disimpan, coba lagi.');
        }

        return redirect()->route('posts.show', $post)->with('success', 'Post berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('posts.edit', [
            'post' => $post,
            'kategori' => Post::KATEGORI,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->validated();

        try {
            if ($request->hasFile('image')) {
                // hapus gambar lama dulu kalau ada
                if ($post->image) {
                    Storage::disk('public')->delete($post->image);
                }
                $data['image'] = $request->file('image')->store('posts', 'public');
            }

            $post->update($data);
        } catch (Throwable $e) {
            report($e);

            return back()->withInput()->with('error', 'Post gagal diupdate, coba lagi.');
        }

        return redirect()->route('posts.show', $post)->with('success', 'Post berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // soft delete, datanya masih ada di tabel (kolom deleted_at keisi)
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post "' . $post->title . '" dipindah ke sampah.');
    }

    public function trash()
    {
        $posts = Post::onlyTrashed()->latest('deleted_at')->paginate(6);

        return view('posts.trash', compact('posts'));
    }

    public function restore(Post $post)
    {
        $post->restore();

        return redirect()->route('posts.trash')->with('success', 'Post "' . $post->title . '" berhasil dikembalikan.');
    }

    public function forceDelete(Post $post)
    {
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->forceDelete();

        return redirect()->route('posts.trash')->with('success', 'Post "' . $post->title . '" dihapus permanen.');
    }
}
