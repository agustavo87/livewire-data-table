<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function registration_page_contains_livewire_component()
    {
        $this->get('/register')->assertSeeLivewire('auth.register');
    }

    /** @test */
    public function can_register()
    {
        Livewire::test('auth.register')
            ->set('name', 'Gustavito')
            ->set('email', 'agustavo@gmail.com')
            ->set('password', 'secret')
            ->set('passwordConfirmation', 'secret')
            ->call('register')
            ->assertRedirect('/');


        $this->assertTrue(User::whereEmail('agustavo@gmail.com')->exists());
        $this->assertEquals('agustavo@gmail.com', auth()->user()->email);
    }

    /** @test */
    public function email_is_required()
    {
        Livewire::test('auth.register')
            ->set('name', 'Gustavito')
            ->set('email', '')
            ->set('password', 'secret')
            ->set('passwordConfirmation', 'secret')
            ->call('register')
            ->assertHasErrors(['email' => 'required']);
    }

    /** @test */
    public function email_is_valid_email()
    {
        Livewire::test('auth.register')
            ->set('name', 'Gustavito')
            ->set('email', 'pepe')
            ->set('password', 'secret')
            ->set('passwordConfirmation', 'secret')
            ->call('register')
            ->assertHasErrors(['email' => 'email']);
    }

    /** @test */
    public function email_has_not_been_taken()
    {
        factory(User::class)->create([
            'email' => 'agustavo@gmail.com'
        ]);

        Livewire::test('auth.register')
            ->set('name', 'Gustavito')
            ->set('email', 'agustavo@gmail.com')
            ->set('password', 'secret')
            ->set('passwordConfirmation', 'secret')
            ->call('register')
            ->assertHasErrors(['email' => 'unique']);
    }

    /** @test */
    public function password_is_required()
    {
        Livewire::test('auth.register')
            ->set('name', 'Gustavito')
            ->set('email', 'agustavo@gmail.com')
            ->set('password', '')
            ->set('passwordConfirmation', '')
            ->call('register')
            ->assertHasErrors(['password' => 'required']);
    }

    /** @test */
    public function password_is_of_minimum_of_six_characters()
    {
        Livewire::test('auth.register')
            ->set('name', 'Gustavito')
            ->set('email', 'agustavo@gmail.com')
            ->set('password', 'sds')
            ->set('passwordConfirmation', '')
            ->call('register')
            ->assertHasErrors(['password' => 'min']);
    }

    /** @test */
    public function password_matches_password_confirmation()
    {
        Livewire::test('auth.register')
            ->set('name', 'Gustavito')
            ->set('email', 'agustavo@gmail.com')
            ->set('password', 'secret')
            ->set('passwordConfirmation', 'sexcret')
            ->call('register')
            ->assertHasErrors(['password' => 'same']);
    }
}
