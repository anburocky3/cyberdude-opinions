<a class="bg-white border rounded p-5 mt-4 flex flex-col md:flex-row space-x-4 space-y-4 md:space-y-0 hover:bg-gray-50"
   href="{{ route('site.suggestion.show', ['suggestion' => $feedback->slug])  }}" wire:navigate>
    <div class="border rounded flex flex-col items-center px-5 py-5 md:py-0 hover:bg-white !pointer-events-none">
        <svg width="1em" height="1em" viewBox="0 0 24 24"
             class="w-10 h-10 {{ $this->userHasVoted() ? 'text-orange-500' : 'text-gray-400' }}"
             wire:click.debounce="addVote">
            <path fill="currentColor" d="m7 14l5-5l5 5H7z"></path>
        </svg>
        <div class="text-xl font-semibold">{{ $feedback->votes->count() }}</div>
    </div>
    <div class="space-y-2 flex-1">
        <h4 class="font-bold text-xl">{{ $feedback->title }}</h4>
        <p class="text-gray-500 text-sm">{{ $feedback->desc }}</p>
        <div class="flex flex-col md:flex-row sm:justify-between sm:items-center sm:space-x-4 pt-3">
            <div class="flex flex-col sm:flex-row md:items-center sm:space-x-4">
                <h4 class="text-sm font-semibold text-gray-600">{{ $feedback->user->name }}</h4>
                <div class="flex flex-col sm:flex-row text-gray-500 sm:space-x-4 text-sm">
                    <span>{{ $feedback->created_at->format('d M, Y') }}</span>
                    <span class="sm:space-x-2">
                        @foreach($feedback->tags as $tag)
                            <span class="text-xs sm:text-sm hover:text-orange-600">#{{ $tag }}</span>
                        @endforeach
                    </span>
                </div>
            </div>
            <div class="flex items-center justify-end space-x-4 mt-3 sm:mt-0">
                <button class="px-4 py-1 rounded text-white uppercase text-xs bg-gray-400 hover:bg-gray-600">
                    {{$feedback->status}}
                </button>
                <div class="flex items-center space-x-2">
                    <svg width="1em" height="1em" viewBox="0 0 24 24">
                        <path fill="currentColor"
                              d="M20 17.17L18.83 16H4V4h16v13.17zM20 2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h14l4 4V4c0-1.1-.9-2-2-2z"></path>
                    </svg>
                    <span>{{ $feedback->comments->count() }}</span>
                </div>
            </div>
        </div>
    </div>
</a>
