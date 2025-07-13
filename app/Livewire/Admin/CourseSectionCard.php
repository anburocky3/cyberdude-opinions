<?php

namespace App\Livewire\Admin;

use App\Models\Section;
use App\Models\Topic;
use DB;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\View\View;
use Livewire\Component;
use Masmerise\Toaster\Toaster;
use Throwable;

class CourseSectionCard extends Component
{
    public $section;
    public $course;
    public bool $isTopicOpen = false;
    public $sectionTitle;
    public $sectionDescription;

    public string $topicTitle;
    public string $topicDescription;
    public int $topicDuration;


    public function mount($section, $course): void
    {
        $this->section = $section;
        $this->course = $course;
        $this->sectionTitle = $section->title;
        $this->sectionDescription = $section->description;

    }

    public function openTopicSection(): void
    {
        $this->isTopicOpen = true;
    }

    public function updateSection($sectionId): void
    {
        $section = Section::find($sectionId);
        if ($section) {
            $section->title = $this->sectionTitle;
            $section->description = $this->sectionDescription;
            $section->save();

            $this->section = $section;
            $this->dispatch('sectionUpdated');

            Toaster::success('Section has been updated');
        }
    }

    public function deleteSection($sectionId): void
    {
        $section = Section::find($sectionId);
        if ($section) {
            $section->delete();
            Toaster::success('Section deleted successfully.');
        }
    }

    public function storeTopic(): void
    {
        $this->validate([
            'topicTitle' => 'required|min:3',
            'topicDescription' => 'required|min:3',
            'topicDuration' => 'required|numeric',
            // 'sectionId' => 'required|exists:sections,id',
        ]);

        $maxOrder = Topic::where('section_id', $this->section->id)->max('order');
        $newOrder = $maxOrder ? $maxOrder + 1 : 1;

        Topic::create([
            'title' => $this->topicTitle,
            'description' => $this->topicDescription,
            'duration' => $this->topicDuration,
            'section_id' => $this->section->id,
            'order' => $newOrder,
        ]);

        Toaster::success('Topic created successfully.');

        $this->reset(['topicTitle', 'topicDescription', 'topicDuration']);


        // $this->closeModal();

    }

    /**
     * @throws Throwable
     */
    public function updateTopicOrder($orderedIds, $newSectionId, $draggedTopicId): void
    {
        DB::transaction(function () use ($orderedIds, $newSectionId, $draggedTopicId) {

            // Get the dragged topic
            $movedTopic = Topic::find($draggedTopicId);

            if (!$movedTopic) {
                return;
            }

            // Get the original section ID of the topic
            $originalSectionId = $movedTopic->section_id;
            $newSectionId = (int)$newSectionId;

            // Determine if we're moving between sections
            $isSameSection = $originalSectionId === $newSectionId;

            // dd($movedTopic, $originalSectionId, $newSectionId, $isSameSection);

            if ($isSameSection) {
                dd('same section');
                // Same section reordering - just update order
                foreach ($orderedIds as $index => $id) {
                    Topic::where('section_id', $newSectionId)->where('id', $id)->update(['order' => $index + 1]);
                }
            } else {
                dd('different section');
                // Moving to different section
                $targetSection = Section::find($newSectionId);
                $sourceSection = Section::find($originalSectionId);

                // Update moved topic
                $movedTopic->update([
                    'section_id' => $newSectionId,
                    'order' => $targetSection->topics()->max('order') + 1
                ]);

                // Reorder source section
                $this->reorderTopics($originalSectionId);

                // Reorder target section
                $this->reorderTopics($newSectionId);
            }
        });

        // $this->dispatch('topics-reordered')->to('admin.course-section-card');
        Toaster::success('Topics order updated successfully.');
    }

    private function reorderTopics($sectionId): void
    {
        $topics = Topic::where('section_id', $sectionId)
            ->orderBy('order')
            ->get();

        foreach ($topics as $index => $topic) {
            $topic->update(['order' => $index + 1]);
        }
    }

    public function render(): Factory|Application|\Illuminate\Contracts\View\View|View
    {
        return view('livewire.admin.course-section-card');
    }
}
