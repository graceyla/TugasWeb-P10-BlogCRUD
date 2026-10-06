<div {{ $attributes->merge(['class' => 'bg-white rounded-xl border border-slate-200 overflow-hidden flex flex-col']) }}>
    @if ($image)
        <img src="{{ $image }}" alt="{{ $title }}" class="w-full h-44 object-cover">
    @else
        <div class="w-full h-44 bg-gradient-to-br from-sky-100 to-indigo-100 flex items-center justify-center text-4xl font-bold text-indigo-300">
            {{ strtoupper(substr($title ?? '?', 0, 1)) }}
        </div>
    @endif

    <div class="p-5 flex-1">
        @if ($badge)
            <span class="inline-block text-xs font-medium bg-indigo-50 text-indigo-700 px-2.5 py-0.5 rounded-full mb-2">{{ $badge }}</span>
        @endif

        @if ($title)
            <h3 class="font-semibold text-lg leading-snug mb-2">
                @if ($url)
                    <a href="{{ $url }}" class="hover:text-indigo-600">{{ $title }}</a>
                @else
                    {{ $title }}
                @endif
            </h3>
        @endif

        <div class="text-sm text-slate-600">
            {{ $slot }}
        </div>
    </div>

    @isset($footer)
        <div class="px-5 py-3 border-t border-slate-100 text-sm">
            {{ $footer }}
        </div>
    @endisset
</div>
