@props([
    'href' => null,
    'color' => 'blue',
    'type' => 'button', // 👈 allow changing type
])

@php
    $classes = "px-4 py-2 rounded font-semibold text-white bg-{$color}-600 hover:bg-{$color}-700 focus:outline-none focus:ring-2 focus:ring-{$color}-500 focus:ring-opacity-50 transition";
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif

