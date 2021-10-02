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

    public function login()
    {
        $credentials = $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($credentials)) {
            $this->addError('email', trans('auth.failed'));
            return;
        }
        return Response::redirectToIntended(
            route('dashboard'),
            HttpResponse::HTTP_PERMANENTLY_REDIRECT
        );
    }

    public function render()
    {
        return view('livewire.auth.login')
            ->layout('layouts.auth');
    }
}
