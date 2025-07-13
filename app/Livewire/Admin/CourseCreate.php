<?php

namespace App\Livewire\Admin;

use App\Livewire\Forms\CourseForm;
use App\Models\Category;
use App\Models\Course;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector;
use Masmerise\Toaster\Toaster;

class CourseCreate extends Component
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

    public $categories = [];

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

    public function mount(): void
    {
        $this->categories = Category::pluck('title', 'id')->toArray();
    }

    public function updatedTitle($value): void
    {
        $this->slug = $this->generateUniqueSlug($value);
    }

    protected function generateUniqueSlug($title): string
    {
        $slug = Str::slug($title);

        $count = Course::where('slug', 'LIKE', "{$slug}%")->count();
        return $count ? "{$slug}-{$count}" : $slug;
    }

    public function save(): RedirectResponse|Redirector
    {
        $data = $this->validate();

        // dd($data);

        if ($this->image) {
            $data['image'] = $this->image->store('courses', 'public');
        }

        Course::create($data);
        
        Toaster::success('Course created successfully.');

        return redirect()->route('admin.courses.index');
    }

    public function render(): Factory|Application|\Illuminate\Contracts\View\View|View
    {
        return view('livewire.admin.create-course');
    }
}
