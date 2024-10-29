<?php

namespace App\Livewire;

use Livewire\Component;

class Feedback extends Component
{
    public $votes = 0;

    public function addVote()
    {
        $this->votes++;
    }

    public function render()
    {
        return view('livewire.feedback');
    }
}
