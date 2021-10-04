<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Profile extends Component
{
    public $username = '';

    public $about = '';

    public $birthday = null;

    public function mount()
    {
        $this->username = Auth::user()->username;
        $this->about = Auth::user()->about;
        $this->birthday = optional(Auth::user()->birthday)->format('m/d/Y');
    }

    public function save()
    {

        $profileData = $this->validate([
            'username'  => 'max:24',
            'about'     => 'max:140',
            'birthday'  => 'sometimes'
        ]);

        Auth::user()->update($profileData);

        $this->emitSelf('notify-saved');
    }

    public function render()
    {
        return view('livewire.profile');
    }
}
