<?php

namespace App\Http\Livewire\Auth;

use App\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Register extends Component
{
    public $name = '';

    public $email = '';

    public $password = '';

    public $passwordConfirmation = '';

    public function register()
    {
        $data = $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|same:passwordConfirmation'
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password)
        ]);

        auth()->login($user);

        return redirect('/');
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
