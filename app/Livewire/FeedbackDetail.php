<?php

namespace App\Livewire;

use App\Models\Comment;
use App\Models\Suggestion;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class FeedbackDetail extends Component
{
    public Suggestion $suggestion;

    public string $comment;

    public string $reason;
    public $replyContent = '';
    public $replyingTo = null;

    public $editingReplyId = null;
    public $editingReplyContent = '';


    public ?Comment $editingComment = null;

    public string $editingContent = '';

    public $editingSuggestion = false;
    public string $editingTitle;
    public string $editingDesc;
    public string $editingTags;
    public string $editingStatus;
    public bool $editingShowRoadmap = false;


    public function mounted(Suggestion $suggestion)
    {
        $this->suggestion = $suggestion;
    }

    public function addComment(): void
    {
        $this->validate([
            'comment' => 'required|string|min:10|max:255',
        ]);

        $this->suggestion->comments()->create([
            'user_id' => auth()->id(),
            'content' => $this->comment,
        ]);

        $this->comment = '';
        $this->suggestion->refresh();

        session()->flash('flash', 'Comment added successfully!');

        $this->dispatch('flashSuccess', 'Comment added successfully!');
    }

    public function editComment(Comment $comment): void
    {
        $this->editingComment = $comment;
        $this->editingContent = $comment->content;
    }

    public function updateComment(): void
    {
        $this->validate([
            'editingContent' => 'required|string|min:10|max:255',
        ]);

        $this->editingComment->update([
            'content' => $this->editingContent,
        ]);

        $this->editingComment = null;
        $this->editingContent = '';
        $this->suggestion->refresh();

        session()->flash('flash', 'Comment updated successfully!');
    }

    public function deleteComment(Comment $comment): void
    {
        $comment->delete();
        $this->suggestion->refresh();

        session()->flash('flash', 'Comment deleted successfully!');
    }

    #[On('reportComment')]
    public function reportComment($commentId, $reason): void
    {
        $comment = Comment::findOrFail($commentId);
        $comment->reports()->create([
            'user_id' => auth()->id(),
            'reason' => $reason,
        ]);

        session()->flash('flash', 'Comment reported successfully!');

        $this->dispatch('flashSuccess', 'Comment reported successfully!');
    }

    public function startReplying($commentId): void
    {
        $this->replyingTo = $commentId;
    }

    public function addReply(): void
    {
        $this->validate([
            'replyContent' => 'required|string|min:10|max:255',
        ]);

        Comment::create([
            'user_id' => auth()->id(),
            'content' => $this->replyContent,
            'parent_id' => $this->replyingTo,
            'suggestion_id' => $this->suggestion->id,
        ]);

        $this->replyContent = '';
        $this->replyingTo = null;
        $this->suggestion->refresh();

        session()->flash('flash', 'Reply added successfully!');
        $this->dispatch('replyAdded');
    }

    public function startEditingReply($replyId, $content): void
    {
        $this->editingReplyId = $replyId;
        $this->editingReplyContent = $content;
    }

    public function updateReply(): void
    {
        $this->validate([
            'editingReplyContent' => 'required|string|min:10|max:255',
        ]);

        $reply = Comment::find($this->editingReplyId);
        $reply->update([
            'content' => $this->editingReplyContent,
        ]);

        $this->editingReplyId = null;
        $this->editingReplyContent = '';
        $this->suggestion->refresh();

        session()->flash('flash', 'Reply updated successfully!');
        $this->dispatch('replyUpdated');
    }

    public function deleteReply($replyId): void
    {
        $reply = Comment::find($replyId);
        $reply->delete();

        $this->suggestion->refresh();

        session()->flash('flash', 'Reply deleted successfully!');
        $this->dispatch('replyDeleted');
    }

    public function vote()
    {
        $existingVote = $this->suggestion->votes()->where('user_id', auth()->id())->first();

        if ($existingVote) {
            $existingVote->delete();
        } else {
            $this->suggestion->votes()->create(['user_id' => auth()->id()]);
        }

        $this->suggestion->refresh();
    }

    public function userHasVoted()
    {
        return $this->suggestion->votes()->where('user_id', auth()->id())->exists();
    }

    public function editSuggestion(): void
    {
        $this->editingSuggestion = true;
        $this->editingTitle = $this->suggestion->title;
        $this->editingDesc = $this->suggestion->desc;
        $this->editingTags = implode(',', $this->suggestion->tags);
        $this->editingStatus = $this->suggestion->status;
        $this->editingShowRoadmap = $this->suggestion->show_roadmap;
    }

    public function deleteSuggestion()
    {
        // only admin should able to delete the suggestion
        if (!auth()->user()->isAdmin()) {
            session()->flash('flash', 'You are not authorized to delete this suggestion.');
            return redirect()->route('site.index');
        }

        $this->suggestion->delete();

        session()->flash('flash', 'Suggestion deleted successfully!');

        return redirect()->route('site.index');
    }

    public function updateSuggestion(): void
    {

        $this->validate([
            'editingTitle' => 'required|string|max:255',
            'editingDesc' => 'required|string|max:1000',
            'editingTags' => 'required|string|max:1000',
            'editingShowRoadmap' => 'nullable|boolean',
            'editingStatus' => 'nullable|string|in:' . implode(',', array_keys(Suggestion::STATUS)),
        ]);


        $updateData = [
            'title' => $this->editingTitle,
            'desc' => $this->editingDesc,
            'tags' => explode(',', $this->editingTags),
        ];

        if (auth()->user()->isAdmin()) {
            $updateData['status'] = $this->editingStatus;
            $updateData['show_roadmap'] = $this->editingShowRoadmap;
        }

        $this->suggestion->update($updateData);

        $this->editingSuggestion = false;

        session()->flash('flashPost', 'Post updated successfully!');
    }


    public function render(): Application|Factory|\Illuminate\Contracts\View\View|View
    {
        return view('livewire.feedback-detail');
    }
}
