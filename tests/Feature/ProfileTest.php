<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_see_profile_page()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user)
             ->get('/profile')
             ->assertSuccessful()
             ->assertSeeLivewire('profile');
    }

    /** @test */
    public function can_update_profile()
    {
        /** @var \App\User */
        $user = factory(User::class)->create();
        Livewire::actingAs($user)
                ->test('profile')
                ->set('username', 'foo')
                ->set('about', 'bar')
                ->call('save');

        $user->refresh();

        $this->assertEquals('foo', $user->username);
        $this->assertEquals('bar', $user->about);
    }

    /** @test */
    public function profile_info_is_prepopulated()
    {
        /** @var \App\User */
        $user = factory(User::class)->create([
            'username'  => 'foo',
            'about'     => 'bar'
        ]);
        Livewire::actingAs($user)
                ->test('profile')
                ->assertSet('username', 'foo')
                ->assertSet('about', 'bar');

    }

    /** @test */
    public function saved_message_is_shown()
    {
        /** @var \App\User */
        $user = factory(User::class)->create([
            'username'  => 'foo',
            'about'     => 'bar'
        ]);
        Livewire::actingAs($user)
                ->test('profile')
                ->assertDontSee('Profile saved!')
                ->call('save')
                ->assertSee('Profile saved!');

    }

    /** @test */
    public function username_must_be_less_than_24_characters()
    {
        /** @var \App\User */
        $user = factory(User::class)->create();
        Livewire::actingAs($user)
                ->test('profile')
                ->set('username', str_repeat('a', 25))
                ->set('about', 'bar')
                ->call('save')
                ->assertHasErrors(['username' => 'max']);
    }

    /** @test */
    public function about_must_be_less_than_140_characters()
    {
        /** @var \App\User */
        $user = factory(User::class)->create();
        Livewire::actingAs($user)
                ->test('profile')
                ->set('username', 'foo')
                ->set('about', str_repeat('a', 141))
                ->call('save')
                ->assertHasErrors(['about' => 'max']);
    }
}
