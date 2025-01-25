<?php

use App\Livewire\Actions\Logout;

$logout = function (Logout $logout) {
    $logout();

    $this->redirect('/', navigate: true);
};

?>

<header class="bg-white sticky top-0 z-50 shadow">
    <div class="container mx-auto flex justify-between items-center p-5">
        <div class="flex justify-between lg:justify-start items-center space-x-5 w-full lg:w-auto"><a
                class="text-xl font-bold text-primary mr-3 hover:text-orange-600" href="/" wire:navigate>CYBERDUDE</a>
            <button type="button"
                    class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none">
                <span class="sr-only">Open main menu</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                     xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                          clip-rule="evenodd"></path>
                </svg>
            </button>
            <div class="hidden lg:flex items-center space-x-5">
                <a class="flex items-center text-gray-500 hover:text-primary-hover {{ request()->is('roadmaps') ? '!text-orange-500' : ''  }}"
                   href="{{ route('roadmaps.index') }}" wire:navigate>
                    <svg viewBox="0 0 36 36" width="1.2em" height="1.2em" class=" mr-2">
                        <defs>
                            <path id="svgIDa" fill="none" d="M0 0h36v36H0z"></path>
                        </defs>
                        <path fill="currentColor"
                              d="M22.08 15.06h1.6v3.81h-1.6zm0 6h1.6v3.81h-1.6zm-10-10h1.6v3.81h-1.6zm0 6.07h1.6v3.75h-1.6z"></path>
                        <path fill="currentColor"
                              d="M33.68 15.4H32v11.35l-8.32 2.6v-2.29h-1.6v2l-8.4-4.31v-1.69h-1.6v1.72L4 28.11V9.79l8.08-3.33v2.35h1.6V6.47l5.67 2.9l1-1.76l-6.9-3.5a1 1 0 0 0-.84 0L2.62 8.2a1 1 0 0 0-.62.93v20.48a1 1 0 0 0 1.38.92l9.62-4l9.59 4.92a1 1 0 0 0 .46.11a.76.76 0 0 0 .3 0l10-3.12a1 1 0 0 0 .7-1V15.38Z"></path>
                        <path fill="currentColor"
                              d="m26.85 1.14l-5.72 9.91a1.27 1.27 0 0 0 1.1 1.95h11.45a1.27 1.27 0 0 0 1.1-1.91l-5.72-9.95a1.28 1.28 0 0 0-2.21 0Z"
                              class="clr-i-alert"></path>
                        <use xlink:href="#svgIDa"></use>
                        <use xlink:href="#svgIDa"></use>
                    </svg>
                    <div class="font-medium">Roadmap</div>
                </a>
                <a class="flex items-center text-gray-500 hover:text-primary-hover {{ request()->is(['/', 'suggestion/create']) ? '!text-orange-500' : ''  }}"
                   href="/" wire:navigate>
                    <svg viewBox="0 0 24 24" width="1.2em" height="1.2em" class="mr-2">
                        <path fill="currentColor"
                              d="M1 11h3v2H1v-2m18.1-7.5L17 5.6L18.4 7l2.1-2.1l-1.4-1.4M11 1h2v3h-2V1M4.9 3.5L3.5 4.9L5.6 7L7 5.6L4.9 3.5M10 22c0 .6.4 1 1 1h2c.6 0 1-.4 1-1v-1h-4v1m2-16c-3.3 0-6 2.7-6 6c0 2.2 1.2 4.2 3 5.2V19c0 .6.4 1 1 1h4c.6 0 1-.4 1-1v-1.8c1.8-1 3-3 3-5.2c0-3.3-2.7-6-6-6m1 9.9V17h-2v-1.1c-1.7-.4-3-2-3-3.9c0-2.2 1.8-4 4-4s4 1.8 4 4c0 1.9-1.3 3.4-3 3.9m7-4.9h3v2h-3v-2Z"></path>
                    </svg>
                    <div class="font-medium">Ideas</div>
                </a>
            </div>
        </div>
        <div
            class="hidden lg:flex flex-col lg:flex-row items-center justify-center space-x-4 space-y-3 lg:space-y-0 lg:mt-0">
            <div class="relative">
                <input type="search" placeholder="Search Ideas..."
                       class="w-full border pl-10 pr-4 py-2 rounded outline-none focus:border focus:bg-gray-50"
                       name="search" value="">
                <div class="absolute top-3 left-4 text-gray-500">
                    <svg width="1em" height="1em" viewBox="0 0 24 24">
                        <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                           stroke-width="2">
                            <circle cx="10" cy="10" r="7"></circle>
                            <path d="m21 21l-6-6"></path>
                        </g>
                    </svg>
                </div>
            </div>
            <div class="space-x-4 flex items-center">
                @auth
                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="inline-flex items-center px-3 py-2  leading-4 font-medium rounded-md focus:outline-none transition ease-in-out duration-150">
                                    <div x-data="{{ json_encode(['name' => auth()->user()->name]) }}"
                                         x-text="`Hello ${name}`"
                                         x-on:profile-updated.window="name = $event.detail.name"></div>
                                    <img src="{{ auth()->user()->avatar }}" alt="User Avatar"
                                         class="w-8 h-8 rounded-full mx-2">
                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                             viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                  clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile')" wire:navigate>
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                <!-- Authentication -->
                                <button wire:click="logout" class="w-full text-start">
                                    <x-dropdown-link>
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </button>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @endauth


                @guest
                    <div class="flex items-center justify-center">
                        <a href="{{ route('auth.redirect') }}"
                           class="inline-flex items-center px-4 py-3 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                            <x-simpleicon-github class="w-4 mr-2" /> {{ __('Login with GitHub') }}
                        </a>
                    </div>
                    {{--                     <x-button href="{{ route('login') }}"> --}}
                    {{--                         <x-heroicon-s-lock-open class="w-5 h-5 mr-2" /> --}}
                    {{--                         Login --}}
                    {{--                     </x-button> --}}
                    {{--                     <x-button --}}
                    {{--                         variant="light" :disabled="true" href="{{ route('register') }}"> --}}
                    {{--                         Sign Up --}}
                    {{--                     </x-button> --}}
                @endguest
            </div>
        </div>
    </div>
</header>

