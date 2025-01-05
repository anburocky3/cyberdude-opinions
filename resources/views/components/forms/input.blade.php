@props([
    'name',
    'label' => null,     // Optional label for the select input
    'required' => false, // Whether the input is required
    'placeholder' => 'Enter text', // Placeholder option
    'disabled' => false,
])

<div>
    @if ($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 mb-2">{{ $label }}
            @if($required)
                <span class="text-red-500 text-sm">*</span>
            @endif
        </label>
    @endif

    <input
        @disabled($disabled) {{ $attributes->merge(['class' => 'bg-gray-200 px-4 text-sm py-2 rounded outline-none w-full']) }} placeholder="{{ $placeholder }}" />
</div>
