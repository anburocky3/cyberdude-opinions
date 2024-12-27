<?php

namespace App\Livewire;

use App\Models\Suggestion;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

class SuggestionCreate extends Component
{
    #[Validate('required')]
    public string $title = '';
    #[Validate('required')]
    public string $technology = '';
    #[Validate('required')]
    public string $tags = '';
    #[Validate('required')]
    public string $desc = '';
    #[Validate('required')]
    public string $status = '';

    public array $statusOptions = [];

    public function mount()
    {
        $this->statusOptions = Suggestion::STATUS;
    }

    public function save()
    {
        $this->validate();

        Suggestion::create([
            'title' => $this->title,
            'technology' => $this->technology,
            'tags' => explode(',', $this->tags),
            'desc' => $this->desc,
            'status' => $this->status,
            'user_id' => auth()->id(),
        ]);

        session()->flash('status', 'Suggestion successfully posted.');

        return $this->redirect(route('siteindex'));
    }

    #[Layout('layouts.site-layout')]
    public function render()
    {
        return view('livewire.suggestion-create');
    }
}
