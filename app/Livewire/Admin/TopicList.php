<?php

namespace App\Livewire\Admin;

use App\Models\Topic;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class TopicList extends Component
{
    public $section;
    public $topic;
    public $editingTopicId = null;
    public $topicDescription = '';

    public function mount($section, $topic): void
    {
        $this->section = $section;
        $this->topic = $topic;

        $this->editingTopicId = $topic->id;
        $this->topicDescription = $topic->description;
    }

    public function editTopic($topicId)
    {
        $this->editingTopicId = $topicId;
        $this->topicDescription = Topic::find($topicId)->description;
    }

    public function updateTopic(): void
    {
        $this->validate([
            'topicDescription' => 'required|min:3',
        ]);

        $topic = Topic::find($this->editingTopicId);
        $topic->description = $this->topicDescription;
        $topic->save();

        Toaster::success('Topic has been updated');

        $this->editingTopicId = null;
        // $this->topicDescription = '';
        // $this->topics = $this->section->topics; // Refresh the topics list
    }

    public function render(): Factory|Application|\Illuminate\Contracts\View\View|View
    {
        return view('livewire.admin.topic-list');
    }
}
