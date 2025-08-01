@section('title','CyberDude Request - Your Opinions Matters!')
@section('og:title', 'CyberDude Request - Your Opinions Matters!')
@section('og:description', 'CyberDude tutorial is the coding forum for developers, where you can submit your suggestions and vote on ideas from the community.')

<x-app-layout>
    <div class="container mx-auto">
        <div class="p-5 flex flex-col md:flex-row md:space-x-10 space-y-10 md:space-y-0">
            <div class="w-full sm:w-72">
                <div class="bg-white p-5 rounded shadow space-y-3 sm:p-8">
                    <div>
                        <div class="text-xl font-semibold">Statuses</div>
                        <div class="text-gray-600"></div>
                    </div>
                    <div>
                        <ul class="pt-3">
                            <li>
                                <a href="{{ route('site.index', ['status' => 'considering']) }}"
                                   class="flex items-center space-x-2 hover:bg-gray-50 cursor-pointer rounded p-3 {{ $selectedStatus === 'considering' ? 'bg-gray-100' : '' }}">
                                    <div class="w-2 h-2 bg-primary rounded"></div>
                                    <span>Under Consideration</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('site.index', ['status' => 'planned']) }}"
                                   class="flex items-center space-x-2 hover:bg-gray-50 cursor-pointer rounded p-3 {{ $selectedStatus === 'planned' ? 'bg-gray-100' : '' }}">
                                    <div class="w-2 h-2 bg-blue-500 rounded"></div>
                                    <span>Planned</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('site.index', ['status' => 'in-progress']) }}"
                                   class="flex items-center space-x-2 hover:bg-gray-50 cursor-pointer rounded p-3 {{ $selectedStatus === 'in-progress' ? 'bg-gray-100' : '' }}">
                                    <div class="w-2 h-2 bg-green-500 rounded"></div>
                                    <span>In Progress</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('site.index', ['status' => 'completed']) }}"
                                   class="flex items-center space-x-2 hover:bg-gray-50 cursor-pointer rounded p-3 {{ $selectedStatus === 'completed' ? 'bg-gray-100' : '' }}">
                                    <div class="w-2 h-2 bg-indigo-500 rounded"></div>
                                    <span>Ready To Watch</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('site.index') }}"
                                   class="flex items-center space-x-2 hover:bg-gray-50 cursor-pointer rounded p-3 {{ $selectedStatus === 'all' ? 'bg-gray-100' : '' }}">
                                    <div class="w-2 h-2 bg-gray-500 rounded"></div>
                                    <span>All</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="flex-1 max-w-4xl md:p-5">
                @if($selectedStatus !== 'all')
                    <div
                        class="mb-4  px-4 py-3 rounded-md text-sm -m-5 {{ getStatusColor($selectedStatus) }}">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                          d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                          clip-rule="evenodd"></path>
                                </svg>
                                <span>Showing {{ $suggestions->count() }} records of <strong>{{ ucwords($selectedStatus) }}</strong> suggestions</span>
                            </div>
                            <a href="{{ route('site.index') }}" wire:navigate title="Clear Filter">
                                <x-fa-s-xmark class="w-3 h-3 cursor-pointer text-blue-600 hover:text-blue-800" />
                            </a>
                        </div>
                    </div>
                @endif
                <div class="flex justify-between items-center"><h4 class="text-2xl font-bold">Suggestions</h4>
                    @auth()
                        <a
                            href="{{route('site.suggestion.create')}}"
                            class="px-4 py-2 rounded  font-medium flex items-center text-center shadow bg-gradient-to-r from-red-500 to-orange-500 text-white hover:from-red-600 hover:to-orange-600 "
                            wire:navigate>
                            <div class="pr-2">
                                <svg width="1em" height="1em" viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                          d="M18 12.998h-5v5a1 1 0 0 1-2 0v-5H6a1 1 0 0 1 0-2h5v-5a1 1 0 0 1 2 0v5h5a1 1 0 0 1 0 2z"></path>
                                </svg>
                            </div>
                            Submit Idea
                        </a>
                    @endauth
                </div>
                <div><p class="text-gray-600 mt-3 text-sm md:text-base">You can submit your suggestion here, and
                                                                        upvote/downvote on Ideas submitted by the
                                                                        community.</p></div>
                <div class="flex justify-between mt-4">
                    <button
                        class="px-2 py-1 text-sm rounded  font-medium flex items-center text-center bg-white text-black border hover:bg-gray-50 undefined">
                        Trending
                    </button>
                    <button
                        class="px-2 py-1 text-sm rounded  font-medium flex items-center text-center bg-white text-black border hover:bg-gray-50 undefined">
                        Category
                    </button>
                </div>
                @if($suggestions->isEmpty())
                    <div class="mt-5 text-center text-gray-600">No suggestions found</div>
                @else
                    @foreach($suggestions as $suggestion)
                        <livewire:feedback :feedback="$suggestion" :key="$suggestion" />
                    @endforeach
                    <div class="mt-4">
                        {{ $suggestions->links() }} <!-- Pagination links -->
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
