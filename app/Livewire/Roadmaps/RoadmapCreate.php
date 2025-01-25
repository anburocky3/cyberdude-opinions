<?php

namespace App\Livewire\Roadmaps;

use AllowDynamicProperties;
use App\Models\Roadmap;
use App\Models\Suggestion;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector;

#[AllowDynamicProperties] class RoadmapCreate extends Component
{
    public $title;
    public $description;
    public $tags;
    public $status;
    public array $statusOptions = [];

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'tags' => 'nullable|string',
        'status' => 'required|in:suggestions,planned,in-development,ready-to-watch',
    ];

    public function mount(): void
    {
        $this->statusOptions = Roadmap::STATUS;
    }


    public function submit(): RedirectResponse|Redirector
    {
        $this->validate();

        Roadmap::create([
            'title' => $this->title,
            'description' => $this->description,
            'tags' => explode(',', $this->tags),
            'status' => $this->status,
        ]);

        session()->flash('success', 'Roadmap item created successfully.');

        return redirect()->route('roadmaps.index');
    }

    public function render(): Application|Factory|\Illuminate\Contracts\View\View|View
    {
        return view('livewire.roadmaps.roadmap-create');
    }
}
