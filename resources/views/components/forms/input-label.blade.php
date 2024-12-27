@props(['value', 'required' => false])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-800 mb-2']) }}>
    {{ $value ?? $slot }}
    @if($required)
        <span class="text-red-500 text-sm">*</span>
    @endif
</label>
