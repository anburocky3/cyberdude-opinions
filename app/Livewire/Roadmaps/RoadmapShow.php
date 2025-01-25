<?php

namespace App\Livewire\Roadmaps;

use App\Models\Roadmap;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\View\View;
use Livewire\Component;

class RoadmapShow extends Component
{
    public $roadmap;

    public function mount(Roadmap $roadmap): void
    {
        $this->roadmap = $roadmap;
    }

    public function render(): Application|Factory|\Illuminate\Contracts\View\View|View
    {
        return view('livewire.roadmaps.roadmap-show');
    }
}
