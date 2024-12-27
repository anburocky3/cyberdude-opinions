@props([
    'disabled' => false,
    'resize' => false
    ])

<textarea
    @disabled($disabled) {{ $attributes->merge(['class' => 'bg-gray-200 text-sm px-4 py-2 rounded outline-none']) }}></textarea>
