<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Blog') - {{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 text-slate-800 min-h-screen flex flex-col">

    <nav class="bg-white border-b border-slate-200">
        <div class="max-w-5xl mx-auto px-4 py-4 flex flex-wrap items-center justify-between gap-3">
            <a href="{{ route('posts.index') }}" class="text-xl font-bold text-indigo-600">Blog TR10</a>
            <div class="flex items-center gap-5 text-sm font-medium">
                <a href="{{ route('posts.index') }}" class="{{ request()->routeIs('posts.index') ? 'text-indigo-600' : 'text-slate-600 hover:text-indigo-600' }}">Semua Post</a>
                <a href="{{ route('posts.trash') }}" class="{{ request()->routeIs('posts.trash') ? 'text-indigo-600' : 'text-slate-600 hover:text-indigo-600' }}">Sampah</a>
                <a href="{{ route('posts.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">+ Tulis Post</a>
            </div>
        </div>
    </nav>

    <main class="flex-1 max-w-5xl w-full mx-auto px-4 py-8">
        {{-- flash message dari controller --}}
        <x-alert type="success" :message="session('success')" class="mb-6" />
        <x-alert type="error" :message="session('error')" class="mb-6" />

        @yield('content')
    </main>

    <footer class="text-center text-sm text-slate-400 py-6">
        Tugas Rutin 10 - Blog CRUD Laravel &copy; {{ date('Y') }}
    </footer>

</body>
</html>
