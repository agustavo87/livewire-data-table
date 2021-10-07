<?php

namespace App\Http\Livewire;

use App\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;

    public User $user;

    public $upload = null;

    protected $rules = [
        'user.username'  => 'max:24',
        'user.about'     => 'max:140',
        'user.birthday'  => 'sometimes|date_format:d/m/Y',
        'upload' =>  'nullable|sometimes|image|max:1000'
    ];

    public function mount()
    {
        $this->user = Auth::user();
    }

    public function updatedUpload()
    {
        $this->validateOnly('upload');
    }

    public function save()
    {
        $this->validate();

        if ($this->upload) {
            $filename = $this->upload->store('/', 'avatars');
            $this->user->avatar = $filename;
        }

        $this->user->save();

        $this->emit('profileUpdated');
        $this->emitSelf('notify-saved');
    }

    public function render()
    {
        return view('livewire.profile');
    }
}
