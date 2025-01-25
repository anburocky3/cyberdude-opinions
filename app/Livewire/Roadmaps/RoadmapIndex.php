<?php

namespace App\Livewire\Roadmaps;

use App\Models\Roadmap;
use App\Models\Suggestion;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Layout;
use Livewire\Component;

class RoadmapIndex extends Component
{
    public array $roadmaps;

    public function mount(): void
    {
        // $this->roadmaps = Roadmap::all();
        $this->roadmaps = [
            'suggestions' => Suggestion::where('status', 'considering')->with('votes')->latest()->get(),
            'planned' => Suggestion::where('status', 'planned')->with('votes')->latest()->get(),
            'in-progress' => Suggestion::where('status', 'in-progress')->with('votes')->latest()->get(),
            'completed' => Suggestion::where('status', 'completed')->with('votes')->latest()->get(),
        ];
        // Suggestion::with('votes')->latest()->get();
    }

    // public function delete($id): void
    // {
    //     Roadmap::find($id)->delete();
    //     $this->roadmaps = Roadmap::all();
    // }

    public function render(): Application|Factory|View|\Illuminate\View\View
    {
        return view('livewire.roadmaps.roadmap-index');
    }
}
