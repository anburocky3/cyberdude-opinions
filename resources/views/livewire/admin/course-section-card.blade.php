<div x-data="{ isSectionOpen: false, isTopicOpen: false, isEditing: false }"
     class="shadow-lg bg-white p-5 rounded-lg mb-5 section"
     x-init="$wire.on('sectionUpdated', () => { isEditing = false; })">
    <div class="flex items-center justify-between">
        <div class="flex-1 mr-5">
            <template x-if="!isEditing">
                <h1 class="my-auto">
                    Session {{ $section->order }} : <span class="font-bold">{{ $section->title }}</span>

                    @if($section->topics->count() > 0)
                        <span class="text-xs">({{ $section->topics->count() }} topics | {{ $section->topics->sum('duration') }} mins)</span>
                    @endif
                </h1>
            </template>
            <template x-if="isEditing">
                <div class="space-y-3 w-full">
                    <div>
                        <x-forms.input type="text" name="sectionTitle" wire:model="sectionTitle" label="Section Title"
                                       class="border rounded p-2 w-full" />
                        @error('sectionTitle')
                        <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <x-forms.input type="text" name="sectionDescription" wire:model="sectionDescription"
                                       label="Section Description"
                                       class="border rounded p-2 w-full" />
                        @error('sectionDescription') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                </div>
            </template>
        </div>
        <div class="flex items-center space-x-4">
            <x-button size="sm" variant="light" x-on:click="isEditing = !isEditing">
                <x-fa-s-pencil class="w-3 fill-current " />
            </x-button>
            <x-button size="sm" variant="danger" wire:click="deleteSection({{ $section->id }})">
                <x-heroicon-m-trash class="w-3 fill-current text-white" />
            </x-button>
            <div class="  transition-transform duration-300" :class="isSectionOpen ? 'rotate-180' : ''"
                 x-on:click="isSectionOpen = !isSectionOpen">
                <x-fa-s-chevron-down class="w-3 fill-current text-gray-500 cursor-pointer" />
            </div>
        </div>
    </div>

    <div x-show="isSectionOpen" class="mt-3 space-y-3">
        {{--         <p class="text-gray-500 text-sm">some info</p> --}}

        {{-- Topics --}}
        <div x-data="{ topicOrderIds: [] }"
             data-section-id="{{ $section->id }}"
             x-init="
              let draggedTopic = null;

                document.addEventListener('x-sort:start', event => {
                    // Store the topic ID that's being dragged when drag starts
                    if (event.detail && event.detail.item) {
                        draggedTopic = event.detail.item.getAttribute('x-sort:item');
                    }
                });

                $watch('topicOrderIds', value => {
                    if (value.length > 0) {
                        const targetSectionId = $el.dataset.sectionId;

                        // Use the stored draggedTopic instead of just the first item
                        $wire.updateTopicOrder(value, targetSectionId, draggedTopic)
                             .then(() => $wire.$refresh());

                        // Reset after handling
                        draggedTopic = null;
                    }
                })">
            <div x-sort="
                topicOrderIds = Array.from($el.children).map((child, index) => {
                    return { id: child.getAttribute('x-sort:item'), order: index + 1 };
                }).map(item => item.id);
            " class="space-y-3"
                 x-sort:group="topics">
                @foreach($section->topics->sortBy('order') as $topic)
                    <div x-sort:item="{{ $topic->id }}"
                         wire:key="topic-{{ $topic->id }}-{{ $topic->updated_at }}">
                        <livewire:admin.topic-list
                            :section="$section"
                            :topic="$topic"
                            :key="'topic-list-' . $topic->id . '-' . $topic->updated_at" />
                    </div>
                @endforeach
            </div>
        </div>

        <div class="text-end">
            <x-button size="sm" variant="secondary"
                      x-on:click="isSectionOpen = true; isTopicOpen = !isTopicOpen">
                <x-heroicon-m-plus class="w-5 fill-current text-white mr-2" />
                Add Topic
            </x-button>
        </div>

        <template x-if="isTopicOpen">
            <div class="mt-3 space-y-3 bg-purple-50 p-3 rounded-lg">
                <x-forms.input type="text" wire:model="topicTitle" placeholder="Topic Title"
                               class="w-full border rounded p-2" />
                @error('topicTitle') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                <x-forms.textarea type="text" wire:model="topicDescription" placeholder="Topic Description"
                                  class="w-full border rounded p-2" />
                @error('topicDescription') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                <x-forms.input type="number" wire:model="topicDuration" placeholder="Duration (mins)"
                               class="w-full border rounded p-2" />
                @error('topicDuration') <span class="text-sm text-red-500">{{ $message }}</span> @enderror

                <div class="flex justify-end">
                    <x-button size="sm" variant="dark" wire:click="storeTopic({{ $section->id }})">
                        <x-heroicon-s-plus-small class="w-5 fill-current text-white mr-2" />
                        Save Topic
                    </x-button>
                </div>
            </div>
        </template>
    </div>

    <template x-if="isEditing">
        <div class="mt-3 space-y-3">
            <x-button size="sm" variant="success" wire:click="updateSection({{ $section->id }})">
                <x-fa-s-floppy-disk class="w-3 fill-current text-white mr-2" />
                Save Changes
            </x-button>
        </div>
    </template>
</div>
