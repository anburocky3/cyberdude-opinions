<?php

namespace App\Livewire\Admin;

use App\Models\Course;
use App\Models\Section;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector;
use Masmerise\Toaster\Toaster;

class CourseShow extends Component
{
    public Course $course;

    public string $sectionTitle;
    public string $sectionDescription = '';

    public bool $isOpen = false;

    public $sections = [];

    public string $modalType = '';


    public function mount(Course $course): void
    {
        $this->course = $course;
        $this->sections = $course->sections()->with('topics')->get();
    }

    public function createSection(): void
    {
        $this->modalType = 'section';
        $this->openModal();

    }

    public function openModal(): void
    {
        $this->isOpen = true;
    }

    public function addSection(): void
    {
        $this->sections[] = ['title' => '', 'topics' => []];
    }

    public function addTopic($sectionIndex): void
    {
        $this->sections[$sectionIndex]['topics'][] = '';
    }

    public function createTopic($sectionIndex): void
    {
        $this->modalType = 'topic';
        $this->openModal();
    }

    public function storeSection(): RedirectResponse|Redirector
    {
        $this->validate([
            'sectionTitle' => 'required|min:6',
            'sectionDescription' => 'nullable|min:6',
        ]);

        $maxOrder = Section::where('course_id', $this->course->id)->max('order');
        $newOrder = $maxOrder ? $maxOrder + 1 : 1;

        Section::create([
            'title' => $this->sectionTitle,
            'description' => $this->sectionDescription,
            'course_id' => $this->course->id,
            'order' => $newOrder,
        ]);


        // Section::updateOrCreate(['id' => $this->user_id], [
        //     'name' => $this->name,
        //     'email' => $this->email,
        // ]);

        Toaster::success('Section created successfully.');

        $this->closeModal();
        // $this->resetInputFields();


        return redirect()->route('admin.courses.show', $this->course->slug);
    }

    public function closeModal(): void
    {
        $this->isOpen = false;
    }

    public function getTotalTopics(): int
    {
        $totalTopics = 0;
        foreach ($this->sections as $section) {
            $totalTopics += $section->topics->count();
        }
        return $totalTopics;
    }

    public function updateSectionOrder($orderedIds): void
    {
        foreach ($orderedIds as $index => $id) {
            Section::where('id', $id)->update(['order' => $index + 1]);
        }

        // Force a fresh reload of the sections
        $this->course->refresh();
        $this->sections = $this->course->sections()->with('topics')->orderBy('order')->get();

        $this->reset(['isOpen', 'modalType', 'sectionTitle', 'sectionDescription']);

        Toaster::success('Sections order changed.');

    }

    public function render(): Factory|Application|\Illuminate\Contracts\View\View|View
    {
        return view('livewire.admin.course-show');
    }
}
