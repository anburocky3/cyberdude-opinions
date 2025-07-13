@section('title', 'Create Courses')

<div class="container mx-auto p-5 py-10">
    <div class="flex items-center mb-5">
        <a href="{{route('admin.courses.index')}}" wire:navigate>
            <x-fa-s-arrow-left class="w-4 fill-current text-blue-700 hover:text-blue-800 mr-3" />
        </a>
        <h2 class="text-xl font-bold">Create courses</h2>
    </div>
    <div class="bg-white p-10 rounded">
        <form wire:submit.prevent="save" class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="col-span-1">
                <x-forms.input type="text" id="title" name="title" label="Course Title"
                               wire:model.live.debounce.150ms="title"
                               placeholder="Course Title" required />
                @if(strlen($title) > 0)
                    <small class="text-xs text-gray-500">{{config('app.url')}}/courses/{{ $slug }}</small>
                @endif
                <x-forms.input-error :messages="$errors->get('title')" class="mt-2" />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="col-span-1">
                    <x-forms.select wire:model="category_id" id="category_id" class=""
                                    name="category_id"
                                    :options="$categories"
                                    label="Category"
                                    required
                                    placeholder="Choose a Category"
                                    required />
                    <x-forms.input-error :messages="$errors->get('category_id')" class="mt-2" />
                </div>
                <div class="col-span-1">
                    <x-forms.select wire:model="difficulty_level" id="difficulty_level" class=""
                                    name="difficulty_level"
                                    :options="['beginner' => 'Beginner', 'intermediate' => 'Intermediate', 'advanced' => 'Advanced']"
                                    label="Difficulty Level"
                                    required
                                    placeholder="Choose a Difficulty Level"
                                    required />
                    <x-forms.input-error :messages="$errors->get('difficulty_level')" class="mt-2" />
                </div>
            </div>

            <div class="col-span-1">
                <x-forms.input type="text" id="slug" name="slug" label="Slug" wire:model="slug" placeholder="Slug"

                               required />
                <x-forms.input-error :messages="$errors->get('slug')" class="mt-2" />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="col-span-1">
                    <x-forms.select wire:model="language" id="language" class=""
                                    name="language"
                                    :options="['tamil' => 'Tamil', 'english' => 'English']"
                                    label="Language"
                                    required
                                    placeholder="Choose a Language"
                                    required />
                    <x-forms.input-error :messages="$errors->get('language')" class="mt-2" />
                </div>
                <div class="col-span-1">
                    <x-forms.input type="number" id="duration" name="duration" label="Duration (Mins)"
                                   wire:model="duration"
                                   placeholder="Duration in minutes" required />
                    <x-forms.input-error :messages="$errors->get('duration')" class="mt-2" />
                </div>
            </div>

            <div class="col-span-1">
                <x-forms.textarea id="prerequisites" name="prerequisites" label="Prerequisites"
                                  wire:model="prerequisites"
                                  placeholder="Prerequisites separated by semi-color;" rows="5" />
                <x-forms.input-error :messages="$errors->get('prerequisites')" class="mt-2" />
            </div>

            <div class="col-span-1">
                <x-forms.textarea id="learning_objectives" name="learning_objectives" label="Learning Objectives"
                                  wire:model="learning_objectives"
                                  placeholder="Learning Objectives separated by semi-color;"
                                  rows="5" />
                <x-forms.input-error :messages="$errors->get('learning_objectives')" class="mt-2" />
            </div>

            <div class="col-span-2">
                <x-forms.textarea id="description" name="description" wire:model="description" label="Description"
                                  placeholder="Course description" rows="8" />
                <x-forms.input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <div class="col-span-1">
                <x-forms.input type="text" id="tags" name="tags" label="Tags" wire:model="tags" placeholder="Tags" />
                <x-forms.input-error :messages="$errors->get('tags')" class="mt-2" />
            </div>

            <div class="col-span-1">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <x-forms.input type="color" id="color" name="color" label="Color" wire:model="color"
                                       placeholder="Color" />
                        <x-forms.input-error :messages="$errors->get('color')" class="mt-2" />
                    </div>
                    <div class="col-span-1 flex items-center justify-center">
                        <label for="is_membership" class="text-sm text-gray-600 font-medium">
                            <input type="checkbox" id="is_membership" name="is_membership" class="mr-1"
                                   wire:model="is_membership" /> Is Membership
                        </label>
                        <x-forms.input-error :messages="$errors->get('is_membership')" class="mt-2" />
                    </div>

                    <div class="col-span-1 flex items-center justify-center">
                        <label for="is_published" class="text-sm text-gray-600 font-medium">
                            <input type="checkbox" id="is_published" name="is_published" class="mr-1"
                                   wire:model="is_published" /> Is Published
                        </label>
                        <x-forms.input-error :messages="$errors->get('is_published')" class="mt-2" />
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="col-span-1">
                    <x-forms.input type="number" id="price" name="price" label="Price" wire:model="price"
                                   placeholder="Price"
                                   required />
                    <x-forms.input-error :messages="$errors->get('price')" class="mt-2" />
                </div>

                <div class="col-span-1">
                    <x-forms.input type="number" id="discount_price" name="discount_price" label="Discount Price"
                                   wire:model="discount_price" placeholder="Discount Price" />
                    <x-forms.input-error :messages="$errors->get('discount_price')" class="mt-2" />
                </div>
            </div>


            <div class="col-span-1">
                <x-forms.input type="file" id="image" name="image" label="Image" wire:model="image" />
                <x-forms.input-error :messages="$errors->get('image')" class="mt-2" />
            </div>


            <div class="md:col-span-2 flex justify-end">
                <x-button type="submit" class="mt-4">
                    {{ __('Save') }}
                </x-button>
            </div>
        </form>
    </div>
</div>
