<div>
    <h1>Edit Roadmap Item</h1>
    <form wire:submit.prevent="submit">
        <div>
            <label>Title</label>
            <input type="text" wire:model="title">
            @error('title') <span>{{ $message }}</span> @enderror
        </div>
        <div>
            <label>Description</label>
            <textarea wire:model="description"></textarea>
            @error('description') <span>{{ $message }}</span> @enderror
        </div>
        <div>
            <label>Status</label>
            <select wire:model="status">
                <option value="suggestions">Suggestions</option>
                <option value="planned">Planned</option>
                <option value="in_development">In Development</option>
                <option value="ready_to_watch">Ready to Watch</option>
            </select>
            @error('status') <span>{{ $message }}</span> @enderror
        </div>
        <button type="submit">Update</button>
    </form>
</div>
