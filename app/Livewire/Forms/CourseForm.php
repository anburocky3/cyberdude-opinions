<?php

namespace App\Livewire\Forms;

use App\Models\Course;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Form;

class CourseForm extends Component
{
    #[Validate(['required'])]
    public $title = '';

    #[Validate(['nullable'])]
    public $description = '';

    #[Validate(['required'])]
    public $duration = '';

    #[Validate(['nullable'])]
    public $difficulty_level = '';

    #[Validate(['nullable'])]
    public $prerequisites = '';

    #[Validate(['nullable'])]
    public $learning_objectives = '';

    #[Validate(['boolean'])]
    public $is_published = '';

    public function save(): RedirectResponse
    {
        $data = $this->validate();

        Course::create($data);

        session()->flash('message', 'Course created successfully.');

        return redirect()->route('admin.index');
    }

    public function render(): Application|Factory|View|\Illuminate\View\View
    {
        return view('livewire.forms.course-form');
    }
}
