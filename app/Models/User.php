<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\UserRoleEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property int id
 * @property int role
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
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
            'role' => UserRoleEnum::class
        ];
    }

    public function readers(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'subscriptions',
            'author_id',
            'reader_id'
        );
    }

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'subscriptions',
            'reader_id',
            'author_id'
        );
    }

    public function isAdmin(): bool
    {
        return $this->role->value === UserRoleEnum::ADMIN->value;
    }
}
