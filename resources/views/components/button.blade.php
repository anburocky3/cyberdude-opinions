@props([
    'variant' => 'primary',  // Default variant
    'size' => 'md',          // Default size
    'type' => 'button',      // Default type
    'icon' => null,
    'href' => null,          // Optional href for anchor tag
    'disabled' => false
])

@php
    $baseClasses = 'inline-flex items-center justify-center font-medium rounded transition duration-150 ease-in-out shadow bg-gradient-to-r text-white hover:shadow-lg';

    // Button variant classes with gradient colors
    $variantClasses = [
        'primary' => 'from-red-500 to-orange-500 hover:from-red-600 hover:to-orange-600',
        'secondary' => 'from-indigo-500 to-indigo-600 hover:from-indigo-600 hover:to-indigo-700',
        'success' => 'from-green-500 to-green-600 hover:from-green-600 hover:to-green-700',
        'danger' => 'from-red-600 to-pink-600 hover:from-red-700 hover:to-pink-700',
        'warning' => 'from-yellow-500 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700',
        'light' => 'bg-white !text-black border hover:bg-gray-50',
        'dark' => 'from-gray-500 to-gray-600 hover:from-gray-600 hover:to-gray-700',
        'o-dark' => '!text-gray-600 border hover:bg-gray-50 !text-xs',
    ][$variant] ?? 'from-red-500 to-orange-500'; // Fallback to 'primary'

    // Button size classes
    $sizeClasses = [
        'sm' => 'px-3 py-1 text-sm',
        'md' => 'px-4 py-2',
        'lg' => 'px-6 py-3 text-lg',
    ][$size] ?? 'px-4 py-2'; // Fallback to 'md'

 // Disabled classes if the button is disabled
    $disabledClasses = $disabled ? 'cursor-not-allowed opacity-50' : '';
@endphp

@if($href)
    <a href="{{ $disabled ? 'javascript:void(0)' : $href }}" {{ $attributes->merge(['class' => "$baseClasses $variantClasses $sizeClasses $disabledClasses"]) }}>
        @if($icon)
            <span class="mr-2">{{ $icon }}</span>  <!-- Add margin between icon and text -->
        @endif
        {{ $slot }}
    </a>
@else
    <button
        type="{{ $type }}"
        {{ $attributes->merge(['class' => "$baseClasses $variantClasses $sizeClasses $disabledClasses"]) }}
        {{ $disabled ? 'disabled' : '' }}>
        @if($icon)
            <span class="mr-2">{{ $icon }}</span>  <!-- Add margin between icon and text -->
        @endif
        {{ $slot }}
    </button>
@endif

{{-- <button {{ $attributes->merge(['type' => 'submit', 'class' => 'px-4 py-2 rounded  font-medium flex items-center text-center shadow bg-gradient-to-r from-red-500 to-orange-500 text-white hover:from-red-600 hover:to-orange-600']) }}> --}}
{{--     s {{ $slot }} --}}
{{-- </button> --}}
