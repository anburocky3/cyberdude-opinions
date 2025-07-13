<ul x-data="{ isOpen: false }" class="bg-gray-100  rounded border  mb-3">
    <li class="px-5 py-3  flex justify-between items-center "
        :class="isOpen ? 'border-b' : ''"
        @click="isOpen = !isOpen">
        <div class="flex items-center space-x-3 text-sm">
            <span>#{{ $topic->order }} - {{ $topic->title }}</span>
        </div>
        <div class="flex space-x-3 items-center">
            <div class="text-xs">{{ $topic->duration }} mins</div>
            <div :class="isOpen ? 'rotate-180' : ''" class="transition-transform duration-300">
                <x-fa-s-chevron-down class="w-3 h-3" />
            </div>
        </div>
    </li>

    <div x-show="isOpen" class=" space-y-3">
        {{--         <x-forms.textarea wire:model="topicDescription" placeholder="Update Topic Description" --}}
        {{--                           class="w-full border rounded p-2" /> --}}
        {{--        <p class="text-sm text-gray-500">{{ $topic->description }}</p>--}}

        {{--        @if($editingTopicId)--}}
        <div class="mt-3 space-y-2 mb-2">
            <x-input-tinymce wire:model="topicDescription" class="w-full border rounded p-2" />

            @error('topicDescription') <span class="text-red-500">{{ $message }}</span> @enderror
            <div class="flex justify-end">
                <x-button size="sm" variant="success" wire:click="updateTopic">
                    <x-fa-s-floppy-disk class="w-3 fill-current text-white mr-2" />
                    Save Changes
                </x-button>
            </div>
        </div>
        {{--        @endif--}}
    </div>
</ul>

<script src="https://cdn.tiny.cloud/1/8e0tvf552q63voxxewspqlsr5xhp69qpnysx71n7cx7f507c/tinymce/7/tinymce.min.js"
        referrerpolicy="origin"></script>
