<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;

    public $username = '';

    public $about = '';

    public $birthday = null;

    public $newAvatar;

    public function mount()
    {
        $this->username = Auth::user()->username;
        $this->about = Auth::user()->about;
        $this->birthday = optional(Auth::user()->birthday)->format('m/d/Y');
    }

    public function updatedNewAvatar()
    {
        $this->validate(['newAvatar' => 'image|max:1000']);
    }

    public function save()
    {
        // dd($this->newAvatar);
        $profileData = $this->validate([
            'username'  => 'max:24',
            'about'     => 'max:140',
            'birthday'  => 'sometimes',
            'newAvatar' =>  'image|max:1000'
        ]);

        $filename = $this->newAvatar->store('/', 'avatars');

        // dd($filename);

        Auth::user()->update([
            'username'  => $this->username,
            'about'     => $this->about,
            'birthday'  => $this->birthday,
            'avatar'    => $filename
        ]);

        $this->emitSelf('notify-saved');
    }

    public function render()
    {
        return view('livewire.profile');
    }
}
