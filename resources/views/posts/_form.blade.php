{{-- form dipakai bareng di create & edit, $post kosong waktu create --}}
@php($post = $post ?? null)

<div class="space-y-5">
    <div>
        <label for="title" class="block text-sm font-medium mb-1">Judul</label>
        <input type="text" id="title" name="title" value="{{ old('title', $post?->title) }}"
            class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-300 @error('title') border-red-400 @else border-slate-300 @enderror">
        @error('title')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="category" class="block text-sm font-medium mb-1">Kategori</label>
        <select id="category" name="category"
            class="w-full border rounded-lg px-3 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-indigo-300 @error('category') border-red-400 @else border-slate-300 @enderror">
            <option value="">-- Pilih kategori --</option>
            @foreach ($kategori as $k)
                <option value="{{ $k }}" @selected(old('category', $post?->category) === $k)>{{ $k }}</option>
            @endforeach
        </select>
        @error('category')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="content" class="block text-sm font-medium mb-1">Isi Post</label>
        <textarea id="content" name="content" rows="10"
            class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-300 @error('content') border-red-400 @else border-slate-300 @enderror">{{ old('content', $post?->content) }}</textarea>
        @error('content')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="image" class="block text-sm font-medium mb-1">Gambar <span class="text-slate-400 font-normal">(opsional, maks 2 MB)</span></label>

        @if ($post?->image_url)
            <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="w-48 h-32 object-cover rounded-lg mb-2 border border-slate-200">
            <p class="text-xs text-slate-500 mb-2">Pilih file baru kalau mau ganti gambar.</p>
        @endif

        <input type="file" id="image" name="image" accept="image/*"
            class="block w-full text-sm text-slate-600 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
        @error('image')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>
