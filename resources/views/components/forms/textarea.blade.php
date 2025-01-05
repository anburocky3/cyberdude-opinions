@props([
     'name',
    'label' => null,
    'required' => false,
    'placeholder' => 'Enter text',
    'resize' => false,
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

    <textarea
        @disabled($disabled) {{ $attributes->merge(['class' => 'bg-gray-200 text-sm px-4 py-2 rounded outline-none w-full '. ($resize ? '' : 'resize-none')]) }} placeholder="{{ $placeholder }}"></textarea>
</div>
