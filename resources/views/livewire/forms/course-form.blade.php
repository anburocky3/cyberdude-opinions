<form wire:submit="save" class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="col-span-1">
        <x-forms.input type="text" id="title" name="title" label="Course Title" wire:model="title"
                       placeholder="Course Title" required />
        <x-forms.input-error :messages="$errors->get('title')" class="mt-2" />
    </div>

    <div class="col-span-1">
        <div class="grid grid-cols-2 gap-6 col-span-1 sm:col-span-2">
            <div class="col-span-1">
                <x-forms.input type="text" id="duration" name="duration" label="Duration" wire:model="duration"
                               placeholder="Duration" required />
                <x-forms.input-error :messages="$errors->get('duration')" class="mt-2" />
            </div>

            <div class="col-span-1">
                <x-forms.input type="text" id="difficulty_level" name="difficulty_level" label="Difficulty Level"
                               wire:model="difficulty_level" placeholder="Difficulty Level" required />
                <x-forms.input-error :messages="$errors->get('difficulty_level')" class="mt-2" />
            </div>
        </div>
    </div>


    <div class="md:col-span-2">
        <x-forms.textarea id="description" name="description"
                          wire:model="description"
                          label="Description" placeholder="Course description" rows="8" required />
        <x-forms.input-error :messages="$errors->get('description')" class="mt-2" />
    </div>

    <div class="col-span-1">
        <x-forms.textarea id="prerequisites" name="prerequisites" label="Prerequisites"
                          wire:model="prerequisites" placeholder="Prerequisites" required />
        <x-forms.input-error :messages="$errors->get('prerequisites')" class="mt-2" />
    </div>

    <div class="col-span-1">
        <x-forms.textarea id="learning_objectives" name="learning_objectives" label="Learning Objectives"
                          wire:model="learning_objectives" placeholder="Learning Objectives" required />
        <x-forms.input-error :messages="$errors->get('learning_objectives')" class="mt-2" />
    </div>

    <div class="md:col-span-1">
        <x-forms.input type="text" id="price" name="price" label="Price" wire:model="price" placeholder="Price"
                       required />
        <x-forms.input type="checkbox" id="is_published" name="is_published" label="Is Published"
                       wire:model="is_published" />
        <x-forms.input-error :messages="$errors->get('is_published')" class="mt-2" />
    </div>

    <div class="md:col-span-2 flex justify-end">
        <x-button type="submit" class="mt-4">
            {{ __('Save') }}
        </x-button>
    </div>
</form>
