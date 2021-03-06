<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Livewire\Livewire;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;

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
            ->set('user.username', 'foo')
            ->set('user.about', 'bar')
            ->call('save');

        $user->refresh();

        $this->assertEquals('foo', $user->username);
        $this->assertEquals('bar', $user->about);
    }

    /** @test */
    public function can_upload_avatar()
    {
        $file = UploadedFile::fake()->image('avatar.jpg');

        Storage::fake('avatars');

        /** @var \App\User */
        $user = factory(User::class)->create();

        Livewire::actingAs($user)
            ->test('profile')
            ->set('upload', $file)
            ->call('save');

        $user->refresh();

        $this->assertNotNull($user->avatar);
        Storage::disk('avatars')->assertExists($user->avatar);
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
            ->assertSet('user.username', 'foo')
            ->assertSet('user.about', 'bar');
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
            ->call('save')
            ->assertEmitted('notify-saved');
    }

    /** @test */
    public function username_must_be_less_than_24_characters()
    {
        /** @var \App\User */
        $user = factory(User::class)->create();
        Livewire::actingAs($user)
            ->test('profile')
            ->set('user.username', str_repeat('a', 25))
            ->set('user.about', 'bar')
            ->call('save')
            ->assertHasErrors(['user.username' => 'max']);
    }

    /** @test */
    public function about_must_be_less_than_140_characters()
    {
        /** @var \App\User */
        $user = factory(User::class)->create();
        Livewire::actingAs($user)
            ->test('profile')
            ->set('user.username', 'foo')
            ->set('user.about', str_repeat('a', 141))
            ->call('save')
            ->assertHasErrors(['user.about' => 'max']);
    }
}
