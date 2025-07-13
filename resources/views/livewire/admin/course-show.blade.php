@section('title', $course->title)
<div>
    <div class="h-48 mb-10 flex items-center" style="background-color: {{$course->color}};">
        <div class="container mx-auto flex justify-between items-center ">
            <div class="flex space-x-4"><img
                    src="https://ui-avatars.com/api/?name={{ $course->title }}&amp;background=0D8ABC&amp;color=fff"
                    alt=""
                    class="rounded-full">
                <div class="text-white space-y-2"><h3 class="text-lg font-semibold text-white">{{ $course->title }}</h3>
                    <p>{{ $course->description }}</p></div>
            </div>
            <div>
                <button
                    class="px-4 py-2 rounded  font-medium flex items-center text-center shadow bg-gradient-to-r from-red-500 to-orange-500 text-white hover:from-red-600 hover:to-orange-600"
                    wire:click="createSection()">
                    <x-heroicon-m-plus class="w-6 fill-current text-white  mr-2" />
                    Add Section
                </button>
            </div>
        </div>
    </div>

    <div class=" mx-10 lg:flex gap-5 space-y-8 lg:space-y-0 mb-10">
        <div class="lg:w-[40rem] bg-white rounded p-5 shadow h-fit">
            <div><h3 class="font-semibold text-base">Table of contents</h3>
                <p class="text-gray-600 mt-1 text-sm">Last updated
                                                      on {{ $course->last_updated_on->format('F j, Y') }}</p></div>
            <div class="my-5">
                <ul class="">
                    @foreach($sections as $section)
                        <li class="bg-gray-100 rounded border px-2 py-1 flex justify-between items-center mb-3">
                            <div class="text-sm">#{{ $loop->iteration }} - {{ $section->title }}</div>
                            <div class="text-xs">{{ $section->topics->count() }} topics
                                                                                 | {{ $section->topics->sum('duration') }}
                                                                                 mins
                            </div>
                        </li>
                    @endforeach

                    <li class="px-2 py-1">
                        <div><span class="font-bold italic float-right ">Total<span
                                    class="font-normal text-xs not-italic ml-5">{{ $this->getTotalTopics() }} topics | {{ number_format($sections->sum(fn($section) => $section->topics->sum('duration')) / 60, 1) }} hrs</span></span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="w-full mb-5 h-fit" x-data="{ orderedIds: [] }"
             x-init="
                    $watch('orderedIds', value => {
                        if (value.length > 0) {
                            $wire.updateSectionOrder(value).catch(error => {
                                console.error('Error updating section order:', error);
                            });
                        }
                    });
            ">
            <div x-sort="
                        orderedIds = Array.from($el.children).map((child, index) => {
                            return { id: child.getAttribute('x-sort:item'), order: index + 1 };
                        }).map(item => item.id);
                        " class="space-y-5">
                @forelse($sections as $section)
                    <div x-sort:item="{{ $section->id }}"
                         wire:key="section-{{ $section->id }}-{{ $section->updated_at }}">
                        <livewire:admin.course-section-card :course="$course" :section="$section"
                                                            :key="'section-card-' . $section->id . '-' . $section->updated_at" />
                    </div>
                @empty
                    <div class="text-center text-gray-500 bg-white p-5 rounded shadow">
                        <p class="text-lg">No data available</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    @if($isOpen)
        <div class="fixed z-10 inset-0 overflow-y-auto">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div
                    class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="">
                            <div class="mt-3 text-center sm:mt-0 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    {{ $modalType === 'section' ? 'Create Section' : 'Create Topic' }}
                                </h3>
                                <div class="mt-3 space-y-3">
                                    @if($modalType === 'section')
                                        <x-forms.input wire:model="sectionTitle" placeholder="Section Title"
                                                       class="w-full" />
                                        @error('sectionTitle') <span
                                            class="text-red-500">{{ $message }}</span> @enderror
                                        <x-forms.textarea wire:model="sectionDescription" placeholder="Description" />
                                        @error('sectionDescription') <span
                                            class="text-red-500">{{ $message }}</span> @enderror
                                    @elseif($modalType === 'topic')
                                        <x-forms.input wire:model="topicTitle" placeholder="Topic Title"
                                                       class="w-full" />
                                        @error('topicTitle') <span class="text-red-500">{{ $message }}</span> @enderror
                                        <x-forms.textarea wire:model="topicDescription" placeholder="Topic Description"
                                                          class="w-full" />
                                        @error('topicDescription') <span
                                            class="text-red-500">{{ $message }}</span> @enderror
                                        <x-forms.input wire:model="topicDuration" placeholder="Duration (mins)"
                                                       class="w-full" />
                                        @error('topicDuration') <span
                                            class="text-red-500">{{ $message }}</span> @enderror
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse sm:space-x-reverse space-x-3">
                        <x-button wire:click="{{ $modalType === 'section' ? 'storeSection' : 'storeTopic' }}">
                            Save
                        </x-button>
                        <x-button wire:click="closeModal" variant="o-dark">Cancel</x-button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
