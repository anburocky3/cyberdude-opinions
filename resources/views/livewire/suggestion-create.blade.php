@section('page-title')
    Create Suggestions
@endsection

<div class="container mx-auto my-5">
    <x-card>
        <x-card.header>
            Create suggestion
        </x-card.header>

        <x-card.body>
            <form action="" class="space-y-4" wire:submit="save">
                <div class="grid grid-cols-3 gap-4">
                    <div class="col-span-1">
                        <div>
                            <x-forms.input-label for="title" value="Title" required />
                            <x-forms.input wire:model="title" id="title" class="block mt-1 w-full" type="text"
                                           name="title"
                                           required placeholder="Suggestion Title" />
                            <x-forms.input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-span-1">
                        <x-forms.select wire:model="technology" id="technology" class=""
                                        name="technology"
                                        :options="getAllTechCategories()"
                                        label="Technology"
                                        required
                                        placeholder="Choose a Technology"
                                        required />
                        <x-forms.input-error :messages="$errors->get('technology')" class="mt-2" />
                    </div>
                    <div class="col-span-1">
                        <x-forms.select wire:model="status" id="status" class=""
                                        name="status"
                                        :options="$statusOptions"
                                        label="Status"
                                        required
                                        placeholder="Select status"
                                        required />
                        <x-forms.input-error :messages="$errors->get('status')" class="mt-2" />
                    </div>
                </div>

                <div>
                    <x-forms.input-label for="tags" value="Tags" required />
                    <x-forms.input wire:model="tags" id="tags" class="block mt-1 w-full" type="text"
                                   name="tags"
                                   required placeholder="Tags" />
                    <x-forms.input-error :messages="$errors->get('tags')" class="mt-2" />
                </div>

                <div>
                    <x-forms.input-label for="desc" value="Description" required />
                    <x-forms.textarea wire:model="desc" id="desc" class="block mt-1 w-full" type="text"
                                      name="desc"
                                      required placeholder="Suggestion Description" rows="4" />
                    <x-forms.input-error :messages="$errors->get('desc')" class="mt-2" />
                </div>

                <div>
                    <x-button type="submit">Create</x-button>
                </div>
            </form>
        </x-card.body>
    </x-card>
</div>
