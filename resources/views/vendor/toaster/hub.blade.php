<div role="alert" id="toaster" x-data="toasterHub(@js($toasts), @js($config))"
    @class([
        'fixed z-50 flex w-full max-w-xs p-4 mb-4 text-gray-500 rounded-lg pointer-events-none sm:p-6',
        'bottom-5' => $alignment->is('bottom'),
        'top-1/2 -translate-y-1/2' => $alignment->is('middle'),
        'top-0' => $alignment->is('top'),
        'items-start rtl:items-end' => $position->is('left'),
        'items-center' => $position->is('center'),
        // 'items-end rtl:items-start' => $position->is('right'),
        'right-5' => $position->is('right'),
     ])>
    <template x-for="toast in toasts" :key="toast.id">
        <div x-show="toast.isVisible"
             x-init="$nextTick(() => toast.show($el))"
             @if($alignment->is('bottom'))
                 x-transition:enter-start="translate-y-12 opacity-0"
             x-transition:enter-end="translate-y-0 opacity-100"
             @elseif($alignment->is('top'))
                 x-transition:enter-start="-translate-y-12 opacity-0"
             x-transition:enter-end="translate-y-0 opacity-100"
             @else
                 x-transition:enter-start="opacity-0 scale-90"
             x-transition:enter-end="opacity-100 scale-100"
             @endif
             x-transition:leave-end="opacity-0 scale-90"
             @class(['relative duration-300 transform transition ease-in-out max-w-xs w-full pointer-events-auto', 'text-center' => $position->is('center')])
             :class="toast.select({ error: 'text-white', info: 'text-black', success: 'text-white', warning: 'text-white' })"
        >


            <div class=" p-4 flex items-center ms-3 text-sm font-normal rounded-lg shadow-lg w-full space-x-4"
                 :class="toast.select({ error: 'bg-red-800 text-red-100', info: 'bg-gray-800 text-gray-100', success: 'bg-green-800 text-green-100', warning: 'bg-orange-800 text-orange-100' })">

                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                     viewBox="0 0 20 20">
                    <path x-show="toast.type === 'success'"
                          d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                    <path x-show="toast.type === 'error'"
                          d="M10 0C4.477 0 0 4.477 0 10s4.477 10 10 10 10-4.477 10-10S15.523 0 10 0zm3.707 13.707a1 1 0 0 1-1.414 0L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293a1 1 0 0 1 0 1.414z" />
                    <path x-show="toast.type === 'info'"
                          d="M10 0C4.477 0 0 4.477 0 10s4.477 10 10 10 10-4.477 10-10S15.523 0 10 0zm1 15H9v-2h2v2zm0-4H9V5h2v6z" />
                    <path x-show="toast.type === 'warning'"
                          d="M10 0C4.477 0 0 4.477 0 10s4.477 10 10 10 10-4.477 10-10S15.523 0 10 0zm0 15a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm1-4H9V5h2v6z" />
                </svg>
                <span x-text="toast.message"
                ></span>

                @if($closeable)
                    <button @click="toast.dispose()" aria-label="@lang('close')"
                            class="ms-auto -mx-1.5 -my-1.5 inline-flex items-center justify-center h-8 w-8"
                            data-dismiss-target="#toaster">
                        <span class="sr-only">Close</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                @endif
            </div>

        </div>
    </template>
</div>

