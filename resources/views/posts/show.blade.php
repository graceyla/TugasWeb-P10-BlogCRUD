@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <article class="max-w-3xl mx-auto bg-white rounded-xl border border-slate-200 overflow-hidden">
        @if ($post->image_url)
            <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="w-full max-h-96 object-cover">
        @endif

        <div class="p-6 md:p-10">
            <span class="inline-block text-xs font-medium bg-indigo-50 text-indigo-700 px-2.5 py-0.5 rounded-full mb-3">{{ $post->category }}</span>
            <h1 class="text-3xl font-bold leading-tight mb-2">{{ $post->title }}</h1>
            <p class="text-sm text-slate-400 mb-8">
                Diposting {{ $post->created_at->translatedFormat('d F Y, H:i') }}
                @if ($post->updated_at->ne($post->created_at))
                    &middot; diedit {{ $post->updated_at->diffForHumans() }}
                @endif
            </p>

            <div class="leading-relaxed text-slate-700">
                {!! nl2br(e($post->content)) !!}
            </div>

            <div class="flex flex-wrap items-center gap-3 mt-10 pt-6 border-t border-slate-100">
                <a href="{{ route('posts.index') }}" class="text-slate-600 hover:underline mr-auto">&larr; Kembali</a>
                <a href="{{ route('posts.edit', $post) }}" class="bg-amber-500 text-white px-4 py-2 rounded-lg hover:bg-amber-600">Edit</a>

                <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Yakin mau hapus post ini? Post akan dipindah ke sampah.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">Hapus</button>
                </form>
            </div>
        </div>
    </article>
@endsection
