<?php

namespace App\Livewire;

use App\Livewire\Forms\CourseForm;
use Livewire\Component;

class CreateCourse extends Component
{
    public CourseForm $form;


    public function render()
    {
        return view('livewire.create-course');
    }
}
