@extends('layouts.app')

@section('title', 'Sampah')

@section('content')
    <h1 class="text-3xl font-bold mb-1">Sampah</h1>
    <p class="text-slate-500 text-sm mb-6">Post yang dihapus masuk ke sini dulu (soft delete), masih bisa dikembalikan.</p>

    @if ($posts->isEmpty())
        <x-alert type="info">Sampah kosong.</x-alert>
    @else
        <div class="bg-white rounded-xl border border-slate-200 overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-slate-500 border-b border-slate-200">
                        <th class="px-5 py-3">Judul</th>
                        <th class="px-5 py-3">Kategori</th>
                        <th class="px-5 py-3">Dihapus</th>
                        <th class="px-5 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr class="border-b border-slate-100 last:border-0">
                            <td class="px-5 py-3 font-medium">{{ $post->title }}</td>
                            <td class="px-5 py-3">{{ $post->category }}</td>
                            <td class="px-5 py-3 text-slate-500">{{ $post->deleted_at->diffForHumans() }}</td>
                            <td class="px-5 py-3">
                                <div class="flex justify-end gap-2">
                                    <form action="{{ route('posts.restore', $post) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="bg-green-600 text-white px-3 py-1.5 rounded-lg hover:bg-green-700">Kembalikan</button>
                                    </form>
                                    <form action="{{ route('posts.force-delete', $post) }}" method="POST" onsubmit="return confirm('Hapus permanen? Data tidak bisa dikembalikan lagi.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-600 text-white px-3 py-1.5 rounded-lg hover:bg-red-700">Hapus Permanen</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $posts->links() }}
        </div>
    @endif
@endsection
