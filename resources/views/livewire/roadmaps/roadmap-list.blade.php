<?php

use function Livewire\Volt\{state};

state('roadmap');

?>

<li class="border p-3 mt-5 rounded space-y-3 cursor-pointer hover:bg-gray-50">
    <a href="{{ route('site.suggestion.show', ['suggestion' => $roadmap->slug]) }}" wire:navigate>
        <div class="flex items-center space-x-4">
            <div class="border p-3 rounded">
                {{ $roadmap->votes->count() }}
            </div>
            <div class="flex-1">
                <h4 class="font-medium text-sm">{{ $roadmap->title }}</h4>
            </div>
            {{--                             <div class="flex items-center space-x-4 mt-3"> --}}
            {{--                                 <a :href="`/roadmaps/${roadmap.id}/edit`" class="text-yellow-500" title="Edit"> --}}
            {{--                                     <x-fa-s-pencil class="w-3 h-3 text-yellow-500 fill-current" /> --}}
            {{--                                 </a> --}}
            {{--                                 <button @click="$wire.delete(roadmap.id)" class="text-red-500" title="Delete"> --}}
            {{--                                     <x-fa-s-trash class="w-3 h-3 text-red-500 fill-current" /> --}}
            {{--                                 </button> --}}
            {{--                             </div> --}}
        </div>
        <p class="text-sm text-gray-400 space-x-2">
            @foreach($roadmap->tags as $tag)
                {{--                 <span class="hover:text-orange-600">#{{ $tag }}</span> --}}
                <a href="#" target="_blank">#{{ $tag }}</a>
            @endforeach
        </p>
    </a>
</li>
