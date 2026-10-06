@extends('layouts.app')

@section('title', 'Tulis Post')

@section('content')
    <div class="max-w-2xl mx-auto bg-white rounded-xl border border-slate-200 p-6 md:p-8">
        <h1 class="text-2xl font-bold mb-6">Tulis Post Baru</h1>

        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            @include('posts._form')

            <div class="flex gap-3 mt-8">
                <button type="submit" class="bg-indigo-600 text-white px-5 py-2.5 rounded-lg hover:bg-indigo-700">Simpan</button>
                <a href="{{ route('posts.index') }}" class="border border-slate-300 px-5 py-2.5 rounded-lg hover:bg-slate-100">Batal</a>
            </div>
        </form>
    </div>
@endsection
