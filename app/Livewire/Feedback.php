<?php

namespace App\Livewire;

use App\Models\Suggestion;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\View\View;
use Livewire\Component;

class Feedback extends Component
{
    public Suggestion $feedback;
    public $votes = 0;

    public function mount(Suggestion $feedback): void
    {
        $this->feedback = $feedback;
    }

    public function addVote(): void
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

    public function render(): Application|Factory|\Illuminate\Contracts\View\View|View
    {
        return view('livewire.feedback');
    }
}
