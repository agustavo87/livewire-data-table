<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Livewire\Livewire;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function login_page_contains_livewire_component()
    {
        $this->get('/login')->assertSeeLivewire('auth.login');
    }

    /** @test */
    public function redirected_if_logged()
    {
        auth()->login(
            factory(User::class)->create()
        );

        $this->get('/login')
              ->assertRedirect('/home');
    }



     /** @test */
    public function can_login()
    {
        factory(\App\User::class)->create([
            'email' => 'johndoe@example.com',
        ]);

        Livewire::test('auth.login')
            ->set('email', 'johndoe@example.com')
            ->set('password', 'password')
            ->call('login');

        $this->assertEquals('johndoe@example.com', Auth::user()->email);
    }
}
