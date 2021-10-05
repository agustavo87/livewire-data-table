<?php

namespace App\Http\Livewire\Auth;

use App\User;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Livewire\Component;

class Register extends Component
{
    public $name = '';

    public $email = '';

    public $password = '';

    public $passwordConfirmation = '';

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6|same:passwordConfirmation'
    ];

    public function updatedEmail()
    {
        $this->validate(['email' => 'unique:users']);
    }

    public function register()
    {
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password)
        ]);

        Auth::login($user);

        return Response::redirectToIntended(
            route('dashboard'),
            HttpResponse::HTTP_PERMANENTLY_REDIRECT
        );
    }

    public function render()
    {
        return view('livewire.auth.register')
            ->layout('layouts.auth');
    }
}
