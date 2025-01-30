<?php

namespace App\Livewire;

use App\Models\Suggestion;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

class SuggestionCreate extends Component
{
    public string $title = '';
    public string $technology = '';
    public string $tags = '';
    public string $desc = '';

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

        return $this->redirect(route('site.index'));
    }

    public function render(): Application|Factory|\Illuminate\Contracts\View\View|View
    {
        return view('livewire.suggestion-create');
    }

    protected function rules(): array
    {
        return [
            'title' => 'required|min:3',
            'technology' => 'required',
            'tags' => 'required',
            'desc' => 'required',
            'status' => 'required|in:' . implode(',', Suggestion::STATUS),
        ];
    }
}
