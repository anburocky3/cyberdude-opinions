<?php

namespace App\Livewire;

use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\View\View;
use Livewire\Component;
use App\Models\User;

class UserManagement extends Component
{
    public $users, $name, $email, $user_id;
    public $isOpen = 0;

    public function mount(): void
    {
        $this->users = User::with('votes', 'suggestions')->latest()->get();
    }

    public function create(): void
    {
        $this->resetInputFields();
        $this->openModal();
    }

    private function resetInputFields(): void
    {
        $this->name = '';
        $this->email = '';
        $this->user_id = '';
    }

    public function openModal(): void
    {
        $this->isOpen = true;
    }

    public function store(): void
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        User::updateOrCreate(['id' => $this->user_id], [
            'name' => $this->name,
            'email' => $this->email,
        ]);

        session()->flash('message', $this->user_id ? 'User updated successfully.' : 'User created successfully.');

        $this->closeModal();
        $this->resetInputFields();
        $this->users = User::all();
    }

    public function closeModal(): void
    {
        $this->isOpen = false;
    }

    public function edit($id): void
    {
        $user = User::findOrFail($id);
        $this->user_id = $id;
        $this->name = $user->name;
        $this->email = $user->email;

        $this->openModal();
    }

    public function delete($id): void
    {
        User::find($id)->delete();
        session()->flash('message', 'User deleted successfully.');
        $this->users = User::all();
    }

    public function render(): Application|Factory|\Illuminate\Contracts\View\View|View
    {
        return view('livewire.user-management');
    }
}
