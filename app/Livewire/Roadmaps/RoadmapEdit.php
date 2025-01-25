<?php

namespace App\Livewire\Roadmaps;

use App\Models\Roadmap;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Livewire\Component;

class RoadmapEdit extends Component
{
    public $roadmap;
    public $title;
    public $description;
    public $status;

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'status' => 'required|in:suggestions,planned,in_development,ready_to_watch',
    ];

    public function mount(Roadmap $roadmap): void
    {
        $this->roadmap = $roadmap;
        $this->title = $roadmap->title;
        $this->description = $roadmap->description;
        $this->status = $roadmap->status;
    }

    public function submit(): RedirectResponse
    {
        $this->validate();

        $this->roadmap->update([
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
        ]);

        return redirect()->route('roadmaps.index')->with('success', 'Roadmap item updated successfully.');
    }

    public function render(): Application|Factory|\Illuminate\Contracts\View\View|View
    {
        return view('livewire.roadmaps.roadmap-edit');
    }
}
