<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Livewire\Component;

class Login extends Component
{
    public $email;

    public $password;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];

    public function login()
    {
        $credentials = $this->validate();

        return Auth::attempt($credentials) ?
            Response::redirectToIntended(route('dashboard'), HttpResponse::HTTP_PERMANENTLY_REDIRECT)
            : $this->addError('email', trans('auth.failed'));
    }

    public function render()
    {
        return view('livewire.auth.login')
            ->layout('layouts.auth');
    }
}
