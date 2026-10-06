@extends('layouts.app')

@section('title', 'Semua Post')

@section('content')
    <div class="flex flex-wrap items-end justify-between gap-4 mb-6">
        <div>
            <h1 class="text-3xl font-bold">Semua Post</h1>
            <p class="text-slate-500 text-sm mt-1">Total {{ $posts->total() }} post</p>
        </div>

        <form action="{{ route('posts.index') }}" method="GET" class="flex gap-2 w-full sm:w-auto">
            <input type="text" name="q" value="{{ $keyword }}" placeholder="Cari judul, isi, atau kategori..."
                class="flex-1 sm:w-72 border border-slate-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
            <button type="submit" class="bg-slate-800 text-white px-4 py-2 rounded-lg text-sm hover:bg-slate-700">Cari</button>
            @if ($keyword)
                <a href="{{ route('posts.index') }}" class="border border-slate-300 px-4 py-2 rounded-lg text-sm hover:bg-slate-100">Reset</a>
            @endif
        </form>
    </div>

    @if ($keyword)
        <p class="text-sm text-slate-600 mb-4">Hasil pencarian untuk "<strong>{{ $keyword }}</strong>"</p>
    @endif

    @if ($posts->isEmpty())
        <x-alert type="info">
            @if ($keyword)
                Tidak ada post yang cocok dengan pencarian kamu.
            @else
                Belum ada post. Yuk tulis post pertama!
            @endif
        </x-alert>
    @else
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach ($posts as $post)
                <x-card :title="$post->title" :image="$post->image_url" :url="route('posts.show', $post)" :badge="$post->category">
                    <p>{{ Str::limit($post->content, 110) }}</p>

                    <x-slot:footer>
                        <div class="flex items-center justify-between">
                            <span class="text-slate-400 text-xs">{{ $post->created_at->translatedFormat('d M Y') }}</span>
                            <a href="{{ route('posts.show', $post) }}" class="text-indigo-600 hover:underline">Baca &rarr;</a>
                        </div>
                    </x-slot:footer>
                </x-card>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $posts->links() }}
        </div>
    @endif
@endsection
