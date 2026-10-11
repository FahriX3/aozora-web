<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

#[Fillable(['name', 'email', 'password', 'role'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * Determine if user can access the given Filament panel.
     */
    public function canAccessPanel(Panel $panel): bool
    {
        if ($this->role === 'admin' || $this->hasAnyRole(['super_admin', 'admin', 'pengurus'])) {
            return true;
        }

        return match ($panel->getId()) {
            'admin' => $this->role === 'admin' || $this->hasRole('admin'),
            'inventaris' => in_array($this->role, ['admin', 'pengurus']) || $this->hasAnyRole(['admin', 'koordinator_inventaris', 'pengurus']),
            'events', 'pdd' => in_array($this->role, ['admin', 'pengurus']) || $this->hasAnyRole(['admin', 'koordinator_kegiatan', 'pdd']),
            'anggota' => true,
            default => false,
        };
    }

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

    public function pengurus()
    {
        return $this->hasOne(Pengurus::class);
    }
}
