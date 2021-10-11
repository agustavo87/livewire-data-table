<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Livewire\Component;
use Session;

class Login extends Component
{
    public $email;

    public $password;

    public $remember = true;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required',
        'remember'  => 'required|boolean'
    ];

    public function login()
    {
        $data = $this->validate();

        $attempt = Auth::attempt([
            'email' => $data['email'],
            'password' => $data['password']
        ], $data['remember']);

        Session::put('prueba', 'hola');

        return $attempt ?
            Response::redirectToIntended(route('dashboard'), HttpResponse::HTTP_PERMANENTLY_REDIRECT)
            : $this->addError('email', trans('auth.failed'));
    }

    public function render()
    {
        return view('livewire.auth.login')
            ->layout('layouts.auth');
    }
}
