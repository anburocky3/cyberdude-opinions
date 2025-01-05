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
        $existingVote = $this->feedback->votes()->where('user_id', auth()->id())->first();

        if ($existingVote) {
            $existingVote->delete();
        } else {
            $this->feedback->votes()->create(['user_id' => auth()->id()]);
        }

        $this->feedback->refresh();
    }

    public function userHasVoted()
    {
        return $this->feedback->votes()->where('user_id', auth()->id())->exists();
    }

    public function render()
    {
        return view('livewire.feedback');
    }
}
