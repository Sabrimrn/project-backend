<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
        'username',
        'birthday',
        'profile_photo',
        'about_me',
        'favorite_game',
        'gaming_platform',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'birthday' => 'date',
        ];
    }

    // Relations
    public function news()
    {
        return $this->hasMany(News::class);
    }

    public function isAdmin(): bool
    {
        return $this->is_admin;
    }

    public function makeAdmin(): void
    {
        $this->is_admin = true;
        $this->save();
    }

    public function removeAdmin(): void
    {
        $this->is_admin = false;
        $this->save();
    }

    public function getDisplayNameAttribute()
    {
        return $this->username ?: $this->name;
    }

    public function getProfilePhotoUrlAttribute()
    {
        return $this->profile_photo 
            ? asset('storage/profile_photos/' . $this->profile_photo)
            : asset('images/default-avatar.png');
    }
}
