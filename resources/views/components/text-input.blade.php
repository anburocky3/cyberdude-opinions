@props([
    'disabled' => false
    ])

<input
    @disabled($disabled) {{ $attributes->merge(['class' => 'bg-gray-700 px-4 py-2 rounded outline-none text-white']) }} />
