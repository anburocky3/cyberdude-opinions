<a class="bg-white border rounded p-5 mt-4 flex flex-col md:flex-row space-x-4 space-y-4 md:space-y-0 hover:bg-gray-50"
   href="{{ route('site.suggestion.show', ['suggestion' => $feedback->slug])  }}">
    <div
        class="border h-fit rounded flex flex-col items-center px-5 py-5 md:py-0  {{ $this->userHasVoted() ? 'bg-orange-500  text-white' : '' }}"
        title="{{ $this->userHasVoted() ? 'Remove Vote' : 'Vote for this suggestion' }}">

        <!-- Loading state -->
        <div wire:loading wire:target="addVote" class="w-10 h-10 flex items-center justify-center">
            <svg class="mt-3 ml-3 animate-spin w-5 h-5 {{ $this->userHasVoted() ? 'text-white' : 'text-orange-500' }}"
                 width="1em" height="1em" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor"
                      d="m4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </div>

        <!-- Normal state -->
        <svg width="1em" height="1em" viewBox="0 0 24 24"
             class="w-10 h-10 {{ $this->userHasVoted() ? 'text-white' : 'text-gray-400' }}"
             wire:click.debounce.stop="addVote"
             wire:loading.remove wire:target="addVote"
             @click.stop.prevent>
            <path fill="currentColor" d="m7 14l5-5l5 5H7z"></path>
        </svg>

        <div class="text-xl font-semibold mb-5">{{ $feedback->votes->count() }}</div>
    </div>
    <div class="space-y-2 flex-1">
        <h4 class="font-bold text-xl">{{ $feedback->title }}</h4>
        <p class="text-gray-500 text-sm line-clamp-3 ">{{ $feedback->desc }}</p>
        <div class="flex flex-col md:flex-row sm:justify-between sm:items-center sm:space-x-4 pt-2">
            <div class="flex flex-col sm:flex-row md:items-center sm:space-x-4">
                <h4 class="text-sm font-semibold flex items-center ">
                    <x-fa-s-user class="w-3 h-3 fill-current text-orange-500 inline-block mr-2 " />
                    <span class="text-gray-600">{{ $feedback->user->name }}</span></h4>
                <div class="flex flex-col sm:flex-row text-gray-500 sm:space-x-4 text-sm">
                    <span>
                        <x-heroicon-o-clock class="w-4 h-4 inline-block" />
                        {{ $feedback->created_at->diffForHumans() }}
                    </span>
                </div>
            </div>
            <div class="flex items-center justify-end space-x-4 mt-3 sm:mt-0">
                <button
                    class="px-4 py-1 rounded text-white uppercase text-xs font-semibold {{ getStatusColor($feedback->status) }}">
                    {{ $feedback->status }}
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
        <p class="text-orange-400 text-sm line-clamp-1 sm:space-x-2">
            @foreach($feedback->tags as $tag)
                <span class="text-xs sm:text-sm hover:text-orange-600">#{{ $tag }}</span>
            @endforeach
        </p>
    </div>
</a>
