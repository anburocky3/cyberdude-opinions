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
    public $slug = '';

    #[Validate(['required', 'numeric'])]
    public $price = '';

    #[Validate(['nullable', 'numeric'])]
    public $discount_price = '';

    #[Validate(['boolean'])]
    public $is_membership = false;

    #[Validate(['nullable', 'image'])]
    public $image = '';

    #[Validate(['required', 'integer'])]
    public $category_id = '';

    #[Validate(['required'])]
    public $duration = '';

    #[Validate(['required'])]
    public $language = 'ta';

    #[Validate(['nullable'])]
    public $tags = '';

    #[Validate(['nullable'])]
    public $color = '';

    #[Validate(['nullable'])]
    public $difficulty_level = '';

    #[Validate(['nullable'])]
    public $prerequisites = '';

    #[Validate(['nullable'])]
    public $learning_objectives = '';

    #[Validate(['boolean'])]
    public $is_published = false;

    public $created_at;
    public $updated_at;

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
