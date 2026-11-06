<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, HasRoles, Notifiable;

    /**
     * Peran yang boleh masuk ke panel panitia.
     */
    public const ADMIN_ROLES = [
        'super-admin',
        'ketua-pelaksana',
        'sekretariat',
        'keuangan',
        'program-kurasi',
        'kampus-sekolah',
        'industri-sponsor',
        'venue-teknis',
        'publikasi',
        'registrasi-layanan',
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
        ];
    }

    protected static function booted(): void
    {
        // Satu identitas orang per akun (BR-10), dibuat otomatis
        static::created(function (User $user) {
            $user->person()->firstOrCreate([], [
                'full_name' => $user->name,
                'email' => $user->email,
            ]);
        });
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->hasAnyRole(self::ADMIN_ROLES);
    }

    public function person(): HasOne
    {
        return $this->hasOne(Person::class);
    }
}