<div class="">
    <div
        class="flex z-10 flex-col px-10 py-14  bg-gradient-to-b from-[#F2994A] to-[#FF7800]"
        role="region"
        aria-label="Project Details">
        <div class="flex flex-wrap gap-5 justify-between w-full container mx-auto ">
            <div class="">
                <div class="flex flex-wrap gap-5 self-start mt-2.5">
                    <div
                        class="bg-white rounded flex flex-col items-center font-black px-5 pb-5 hover:bg-white">
                        @auth
                            <button wire:click="vote" class="focus:outline-none">
                                <svg width="1em" height="1em" viewBox="0 0 24 24"
                                     class="w-10 h-10 {{ $this->userHasVoted() ? 'text-orange-500' : 'text-gray-400' }}">
                                    <path fill="currentColor" d="m7 14l5-5l5 5H7z"></path>
                                </svg>
                            </button>
                        @else
                            <button onclick="alert('Please log in to vote.')" class="focus:outline-none">
                                <svg width="1em" height="1em" viewBox="0 0 24 24"
                                     class="w-10 h-10 text-gray-400">
                                    <path fill="currentColor" d="m7 14l5-5l5 5H7z"></path>
                                </svg>
                            </button>
                        @endauth
                        <div class="text-xl font-semibold">{{ $suggestion->votes->count() }}</div>
                    </div>
                    <div class="flex flex-col grow shrink-0 self-start mt-2 basis-0 w-fit max-md:max-w-full">
                        <h1 class="self-start text-xl font-bold text-yellow-950">{{$suggestion->title}}</h1>
                        <p class="mt-2 text-base leading-6 text-white max-md:max-w-full">{{ $suggestion->desc }}</p>
                    </div>
                </div>

                <div class="flex gap-7 items-center self-start mt-5 ml-24 text-sm text-white">
                    <div class="grow self-stretch my-auto font-semibold">{{ $suggestion->user->name }}</div>
                    <time datetime="2023-07-20"
                          class="self-stretch my-auto">{{ $suggestion->created_at->format('d M, Y') }}</time>
                    @foreach($suggestion->tags as $tag)
                        <a href="#" class="hover:text-orange-600" wire:navigate>#{{ $tag }}</a>
                    @endforeach
                    <div class="self-start px-2.5 py-1.5 mt-1 text-xs whitespace-nowrap bg-indigo-600 rounded"
                         role="status">
                        {{$suggestion->status}}
                    </div>
                </div>
            </div>
            <div class="flex flex-col px-14 py-6 bg-white rounded-xl shadow-sm max-md:px-5" role="region"
                 aria-label="Communication Channels">
                <h2 class="self-center text-base font-medium text-black">Ask your doubts here:</h2>
                <div class="flex gap-5 justify-between mt-6">
                    <button
                        class="focus:outline-none focus:ring-2"
                        aria-label="Discord Communication channel">
                        <x-simpleicon-discord
                            class="text-blue-600 hover:text-blue-700 object-contain shrink-0 w-9 aspect-square" />
                    </button>
                    <button class="focus:outline-none focus:ring-2 focus:ring-blue-500"
                            aria-label="Telegram communication channel">
                        <x-simpleicon-telegram
                            class="text-blue-400 hover:text-blue-500 object-contain shrink-0 w-8 aspect-square" />
                    </button>
                    <button class="focus:outline-none focus:ring-2 focus:ring-blue-500"
                            aria-label="YouTube communication channel">
                        <x-simpleicon-youtube
                            class="text-red-600 hover:text-red-700 object-contain shrink-0 w-10" />
                    </button>
                    <button class="focus:outline-none focus:ring-2 focus:ring-blue-500"
                            aria-label="Instagram communication channel">
                        <x-simpleicon-instagram
                            class="text-pink-600 hover:text-pink-700 object-contain shrink-0 w-8 aspect-square" />
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{--  Comments --}}
    <section class="container mx-auto grid grid-cols-3 gap-10 my-10">
        <div class="col-span-2">
            <div class="bg-white p-5 rounded shadow-lg " x-data="{ comment: '', maxChars: 255 }">
                <x-forms.textarea
                    class="w-full"
                    placeholder="Add a comment"
                    x-model="comment"
                    wire:model="comment"
                    wire:keydown.ctrl.enter="addComment"
                    rows="5"
                    maxlength="255"
                />
                @error('comment') <span class="text-red-500">{{ $message }}</span> @enderror
                <div class="flex justify-end" :class="{'justify-between': comment.length >= 3}">
                    <div class="text-sm text-gray-600 mt-1 " x-show="comment.length >= 3"
                         x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
                         x-transition:enter-end="opacity-100">
                        <span x-text="comment.length"></span> / <span x-text="maxChars"></span> characters used
                                                              (<span x-text="maxChars - comment.length"></span>
                                                              remaining)
                    </div>
                    <div class="flex justify-end mt-3">
                        <x-button wire:click="addComment">Add comment</x-button>
                    </div>
                </div>
            </div>

            @if (session('flash'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 my-3"
                     role="alert">
                    <x-heroicon-c-check-circle class="w-5 h-5 inline mr-2" />
                    {{session('flash')}}
                </div>
            @endif

            <div class="mt-5 space-y-3" x-data="{ showModal: false, commentId: null, reason: '' }">
                @foreach($suggestion->comments as $comment)
                    <div
                        class="flex flex-wrap gap-5 items-start px-6 pt-5 pb-11 bg-white rounded-xl border border-solid border-neutral-200 max-md:pr-5 max-md:mt-10 max-md:mr-2.5"
                        role="article">
                        <img src="{{ $comment->user->avatar }}"
                             class="object-contain shrink-0 w-12 rounded-full aspect-square"
                             alt="Profile picture of {{ $comment->user->name }}" />
                        <div class="flex flex-col grow shrink-0 mt-2 basis-0 w-fit max-md:max-w-full">
                            <div class="flex gap-5 justify-between max-md:max-w-full">
                                <div class="flex justify-between items-center">
                                    <div class="text-sm font-semibold text-neutral-800" role="heading"
                                         aria-level="3">{{ $comment->user->name }}</div>
                                    @if($comment->user_id === $suggestion->user_id)
                                        <span
                                            class="ml-2 px-2 py-0.5 text-xs font-semibold text-white bg-indigo-500 rounded">OP</span>
                                    @endif
                                </div>
                                <time
                                    class="text-xs leading-loose text-zinc-600">{{ $comment->created_at->diffForHumans() }}</time>
                            </div>

                            @if($editingComment && $editingComment->id === $comment->id)
                                <div class="mt-2.5 mr-3 text-sm leading-5 text-zinc-600 max-md:mr-2.5">
                                    <x-forms.textarea
                                        class="w-full"
                                        name="editingContent"
                                        wire:model="editingContent"
                                        rows="3"
                                    />
                                    @error('editingContent') <span class="text-red-500">{{ $message }}</span> @enderror
                                    <div class="flex justify-end mt-3">
                                        <x-button wire:click="updateComment">Update comment</x-button>
                                    </div>
                                </div>
                            @else
                                <div class="mt-2.5 mr-3 text-sm leading-5 text-zinc-600 max-md:mr-2.5">
                                    {{ $comment->content }}
                                </div>
                                @if($comment->user_id === auth()->id())
                                    <div class="flex justify-end mt-3">
                                        <x-button wire:click="editComment({{ $comment->id }})" variant="o-dark"
                                                  size="sm">
                                            <x-heroicon-o-pencil-square class="w-3 mr-2" />
                                            <span>Edit</span>
                                        </x-button>
                                        <x-button wire:click="deleteComment({{ $comment->id }})" variant="danger"
                                                  size="sm" class="ml-2"
                                                  onclick="return confirm('Are you sure you want to delete this comment?')">
                                            <x-heroicon-o-trash class="w-3" />
                                        </x-button>
                                    </div>
                                @else
                                    <div class="flex justify-end mt-3 space-x-2">
                                        <x-button @click="showModal = true; commentId = {{ $comment->id }}"
                                                  variant="o-dark"
                                                  size="sm">
                                            <x-heroicon-o-flag class="w-3 mr-2" />
                                            <span>Report</span>
                                        </x-button>
                                        <x-button wire:click="startReplying({{ $comment->id }})" variant="o-dark"
                                                  size="sm">
                                            <x-heroicon-o-pencil class="w-3 mr-2" />
                                            <span>Reply</span>
                                        </x-button>
                                    </div>
                                @endif
                            @endif

                            @if($replyingTo === $comment->id)
                                <div class="mt-3">
                                    <x-forms.textarea class="w-full" placeholder="Add a reply" wire:model="replyContent"
                                                      rows="3" maxlength="255" />
                                    @error('replyContent') <span class="text-red-500">{{ $message }}</span> @enderror
                                    <div class="flex justify-end mt-3">
                                        <x-button wire:click="addReply">Add reply</x-button>
                                    </div>
                                </div>
                            @endif
                            @foreach($comment->replies as $reply)
                                <div
                                    class="mt-5 ml-10 flex flex-wrap gap-5 items-start px-6 pt-5 pb-11 bg-gray-100 rounded-xl border border-solid border-neutral-200 max-md:pr-5 max-md:mt-10 max-md:mr-2.5"
                                    role="article">
                                    <img src="{{ $reply->user->avatar }}"
                                         class="object-contain shrink-0 w-12 rounded-full aspect-square"
                                         alt="Profile picture of {{ $reply->user->name }}" />
                                    <div class="flex flex-col grow shrink-0 mt-2 basis-0 w-fit max-md:max-w-full">
                                        <div class="flex gap-5 justify-between max-md:max-w-full">
                                            <div class="flex justify-between items-center">
                                                <div class="text-sm font-semibold text-neutral-800" role="heading"
                                                     aria-level="3">{{ $reply->user->name }}</div>
                                                @if($reply->user_id === $suggestion->user_id)
                                                    <span
                                                        class="ml-2 px-2 py-0.5 text-xs font-semibold text-white bg-indigo-500 rounded">OP</span>
                                                @endif
                                            </div>
                                            <time
                                                class="text-xs leading-loose text-zinc-600">{{ $reply->created_at->diffForHumans() }}</time>
                                        </div>
                                        <div class="mt-2.5 mr-0 text-sm leading-5 text-zinc-600 max-md:mr-2.5">
                                            @if($editingReplyId === $reply->id)
                                                <x-forms.textarea class="w-full" wire:model="editingReplyContent"
                                                                  rows="3" maxlength="255" />
                                                @error('editingReplyContent') <span
                                                    class="text-red-500">{{ $message }}</span> @enderror
                                                <div class="flex justify-end mt-3 space-x-3">
                                                    <x-button wire:click="updateReply" size="sm">Update</x-button>
                                                    <x-button wire:click="$set('editingReplyId', null)" variant="o-dark"
                                                              size="sm">Cancel
                                                    </x-button>
                                                </div>
                                            @else
                                                {{ $reply->content }}
                                                <div class="flex justify-end mt-3 space-x-2">
                                                    <x-button
                                                        wire:click="startEditingReply({{ $reply->id }}, '{{ $reply->content }}')"
                                                        variant="o-dark" size="sm">
                                                        <x-heroicon-o-pencil class="w-3 mr-2" />
                                                        <span>Edit</span>
                                                    </x-button>
                                                    <x-button wire:click="deleteReply({{ $reply->id }})"
                                                              variant="danger"
                                                              size="sm"
                                                              title="Delete this comment">
                                                        <x-heroicon-o-trash class="w-3" />
                                                    </x-button>
                                                </div>
                                            @endif
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <x-card class="h-fit">
            <x-card.body>
                <div class="pb-5">
                    <h4 class="text-lg font-semibold">Similar videos:</h4>
                </div>
                <div>
                    <div class="flex flex-col md:flex-row space-x-4 space-y-4 md:space-y-0 hover:bg-gray-50">
                        <div>
                            <img src="https://img.youtube.com/vi/aGHVddspRq0/mqdefault.jpg" alt=""
                                 class="object-cover rounded-xl w-40">
                        </div>
                        <div class="space-y-2 flex-1">
                            <h4 class="font-bold text-xl">HTML From scratch</h4>
                            <p class="text-gray-500 text-sm">This series has 26 videos, you can learn all about HTML
                                                             here.</p>
                        </div>
                    </div>
                </div>
            </x-card.body>
        </x-card>
    </section>
</div>


<script>
    function reportComment() {
        // Livewire.emit('reportComment', this.commentId, this.reason);
        Livewire.dispatch('reportComment', {commentId: this.commentId, reason: this.reason});
        this.showModal = false;
    }
</script>
