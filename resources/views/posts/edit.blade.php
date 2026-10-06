@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
    <div class="max-w-2xl mx-auto bg-white rounded-xl border border-slate-200 p-6 md:p-8">
        <h1 class="text-2xl font-bold mb-6">Edit Post</h1>

        <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @include('posts._form')

            <div class="flex gap-3 mt-8">
                <button type="submit" class="bg-indigo-600 text-white px-5 py-2.5 rounded-lg hover:bg-indigo-700">Update</button>
                <a href="{{ route('posts.show', $post) }}" class="border border-slate-300 px-5 py-2.5 rounded-lg hover:bg-slate-100">Batal</a>
            </div>
        </form>
    </div>
@endsection
