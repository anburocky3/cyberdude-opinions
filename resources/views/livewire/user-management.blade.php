<?php

use function Livewire\Volt\{state};

state();

?>

@section('page-title', 'User Management')


<div class="m-10 p-10 bg-white rounded shadow">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-semibold">User Management</h2>
        <x-button wire:click="create">Create User</x-button>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('message') }}</span>
        </div>
    @endif


    <div class="relative overflow-x-auto ">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 border rounded">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50  ">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Topics
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Votes Given
                    </th>
                    <th scope="col" class="px-6 py-3 w-48">
                        #actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr class="bg-white border-b   border-gray-200">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                            <div class="flex items-center space-x-2">
                                <img src="{{ $user->avatar }}" alt="User Avatar"
                                     class="w-8 h-8 rounded-full mx-2">
                                <div>
                                    <h4>{{ $user->name }}</h4>
                                    <span class="text-xs text-gray-600">&#64;{{ $user->username }}</span>
                                </div>
                            </div>
                        </th>
                        <td class="px-6 py-4">
                            {{ $user->email }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            {{ $user->suggestions()->count() }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            {{ $user->votes()->count() }}
                        </td>
                        <td class="px-6 py-4">
                            <x-button variant="light" size="sm" wire:click="edit({{ $user->id }})">Edit</x-button>
                            <x-button size="sm" wire:click="delete({{ $user->id }})" variant="danger">Delete</x-button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
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
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    {{ $user_id ? 'Edit User' : 'Create User' }}
                                </h3>
                                <div class="mt-2">
                                    <input type="text" wire:model="name" class="w-full border rounded px-3 py-2"
                                           placeholder="Name">
                                    @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
                                    <input type="email" wire:model="email" class="w-full border rounded px-3 py-2 mt-2"
                                           placeholder="Email">
                                    @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <x-button wire:click="store">Save</x-button>
                        <x-button wire:click="closeModal" variant="o-dark">Cancel</x-button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
