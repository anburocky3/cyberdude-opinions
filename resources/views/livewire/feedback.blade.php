<a class="bg-white border rounded p-5 mt-4 flex flex-col md:flex-row space-x-4 space-y-4 md:space-y-0 hover:bg-gray-50 "
   href="#">
    <div class="border rounded flex flex-col items-center px-5 py-5 md:py-0 hover:bg-white">
        <svg width="1em" height="1em" viewBox="0 0 24 24" class="w-10 h-10 text-gray-400" wire:click.debounce="addVote">
            <path fill="currentColor" d="m7 14l5-5l5 5H7z"></path>
        </svg>
        <div class="text-xl font-semibold">{{ $votes }}</div>
    </div>
    <div class="space-y-2 flex-1"><h4 class="font-bold text-xl">PHP Course</h4>
        <p class="text-gray-500 text-sm">By the end of this course, you will have an in-depth
                                         understanding of PHP and how it can work with HTML and
                                         databases in the creation of dynamic web applications.
                                         Start
                                         Learning For FREE.</p>
        <div class="flex flex-col md:flex-row justify-between items-center space-x-4 pt-3">
            <div class="flex  md:items-center space-x-4"><h4
                        class="text-sm font-semibold text-gray-600">Anbuselvan Rocky</h4>
                <div class="text-gray-500 space-x-4 text-sm"><span>5 Nov, 2023</span><span
                            class="space-x-2"><span class="hover:text-orange-600">#course</span><span
                                class="hover:text-orange-600">#programming</span></span></div>
            </div>
            <div class="flex items-center space-x-4">
                <button
                        class="px-4 py-1 rounded  text-white uppercase text-xs bg-gray-400 hover:bg-gray-600">
                    suggestions
                </button>
                <div class="flex items-center space-x-2">
                    <svg width="1em" height="1em" viewBox="0 0 24 24">
                        <path fill="currentColor"
                              d="M20 17.17L18.83 16H4V4h16v13.17zM20 2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h14l4 4V4c0-1.1-.9-2-2-2z"></path>
                    </svg>
                    <span>4</span></div>
            </div>
        </div>
    </div>
</a>
