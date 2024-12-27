<?php

namespace App\Livewire;

use App\Models\Suggestion;
use Livewire\Component;

class Feedback extends Component
{
    public Suggestion $feedback;
    public $votes = 0;

    public function mount(Suggestion $feedback)
    {
        $this->feedback = $feedback;
    }

    public function addVote()
    {
        $this->votes++;
    }

    public function render()
    {
        return view('livewire.feedback');
    }
}
