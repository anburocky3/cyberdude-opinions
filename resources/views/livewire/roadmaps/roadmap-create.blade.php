@section('title')
    Create Roadmaps
@endsection

<div class="container mx-auto py-5">
    <div class="flex items-center justify-between">
        <div class="flex items-center space-x-2">
            <a href="{{ route('roadmaps.index') }}">
                <x-fa-s-arrow-left class="w-4 h-4  fill-current text-gray-600 hover:text-orange-500" />
            </a>
            <h1 class="text-xl font-bold">Create Roadmap</h1>
        </div>
    </div>
    <div class="bg-white mt-5 p-5 rounded shadow">
        <form wire:submit.prevent="submit" class="space-y-4">
            <div>
                <x-forms.input-label for="title" value="Title" required />
                <x-forms.input wire:model="title" id="title" class="block mt-1 w-full" type="text"
                               name="title"
                               required placeholder="Roadmap Title" />
                <x-forms.input-error :messages="$errors->get('title')" class="mt-2" />
            </div>

            <div>
                <x-forms.input-label for="description" value="Description" required />
                <x-forms.textarea wire:model="description" id="description" class="block mt-1 w-full" name="title"
                                  required placeholder="Roadmap Title" />
                <x-forms.input-error :messages="$errors->get('description')" class="mt-2" />
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mt-5">
                <div>
                    <x-forms.input-label for="tags" value="Tags" required />
                    <x-forms.input wire:model="tags" id="tags" class="block mt-1 w-full" type="text"
                                   name="tags"
                                   required placeholder="Tags"
                                   oninput="this.value = this.value.split(',').map(tag => tag.trim()).join(', ')" />
                    <x-forms.input-error :messages="$errors->get('tags')" class="mt-2" />
                </div>
                <div>
                    <x-forms.select wire:model="status" id="status" class=""
                                    name="status"
                                    :options="$statusOptions"
                                    label="Status"
                                    required
                                    placeholder="Select status"
                                    required>
                    </x-forms.select>
                    <x-forms.input-error :messages="$errors->get('status')" class="mt-2" />
                </div>
            </div>

            <x-button type="submit">Create</x-button>
        </form>
    </div>

</div>
