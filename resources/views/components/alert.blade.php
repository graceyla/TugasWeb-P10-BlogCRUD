@if ($message || $slot->isNotEmpty())
    <div {{ $attributes->merge(['class' => 'flex items-start justify-between gap-4 border rounded-lg px-4 py-3 text-sm ' . $classes()]) }} role="alert">
        <div>{{ $message ?? $slot }}</div>
        <button type="button" onclick="this.parentElement.remove()" class="opacity-60 hover:opacity-100 leading-none text-lg">&times;</button>
    </div>
@endif
