<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProfileMenu extends Component
{
    public $userName = '';
    public $avatarUrl = '';

    protected $listeners = ['profileUpdated' => 'updateUserInfo'];

    public function mount()
    {
        $this->updateUserInfo();
    }

    public function updateUserInfo()
    {
        $user = Auth::user();
        $this->userName = ucfirst($user->username);
        $this->avatarUrl = ucfirst($user->avatarUrl());
    }

    public function render()
    {
        return view('livewire.profile-menu');
    }
}
