@props([
    'name',              // Name of the select input
    'options' => [],     // Options for the select input, should be an associative array with key-value pairs
    'selected' => null,  // Default selected option
    'label' => null,     // Optional label for the select input
    'required' => false, // Whether the input is required
    'placeholder' => 'Select an option', // Placeholder option
])

<div>
    @if ($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 mb-2">{{ $label }}
            @if($required)
                <span class="text-red-500 text-sm">*</span>
            @endif
        </label>
    @endif

    <select
        name="{{ $name }}"
        id="{{ $name }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes->merge(['class' => '$block w-full bg-gray-200 px-4 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md']) }}
    >
        <option value="" disabled {{ $selected ? '' : 'selected' }}>{{ $placeholder }}</option>

        @foreach ($options as $groupLabel => $groupOptions)
            @if (is_array($groupOptions))
                {{-- Render optgroup if options are grouped --}}
                <optgroup label="{{ $groupLabel }}">
                    @foreach ($groupOptions as $value => $text)
                        <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>
                            {{ $text }}
                        </option>
                    @endforeach
                </optgroup>
            @else
                {{-- Render a single option if no optgroup --}}
                <option value="{{ $groupLabel }}" {{ $selected == $groupLabel ? 'selected' : '' }}>
                    {{ $groupOptions }}
                </option>
            @endif
        @endforeach
    </select>
</div>
