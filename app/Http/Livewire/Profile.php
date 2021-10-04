<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Profile extends Component
{
    public $username = '';

    public $about = '';

    public function mount()
    {
        $this->username = Auth::user()->username;
        $this->about = Auth::user()->about;
    }

    public function save()
    {

        $profileData = $this->validate([
            'username'  => 'max:24',
            'about'     => 'max:140'
        ]);

        Auth::user()->update($profileData);

        $this->dispatchBrowserEvent('notify', 'Profile saved!');
    }

    public function render()
    {
        return view('livewire.profile');
    }
}
