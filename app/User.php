<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use Notifiable;

    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'birthday'  => 'date:d/m/Y'
    ];

    public function avatarUrl()
    {
        return $this->avatar ?
            Storage::disk('avatars')->url($this->avatar)
            : "https://www.gravatar.com/avatar/" . md5(strtolower(trim($this->email))) . "?d=retro";
    }

    public function setBirthdayAttribute($value)
    {
        // dd('birthday:', $value);
        $this->attributes['birthday'] = date_create_from_format('d/m/Y', $value);
    }
}
