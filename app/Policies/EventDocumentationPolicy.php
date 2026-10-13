<?php

namespace App\Policies;

use App\Models\EventDocumentation;
use App\Models\User;

class EventDocumentationPolicy
{
    /**
     * Determine whether the user can view any documentations.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole([
            'super_admin',
            'admin',
            'pengurus',
            'koordinator_kegiatan',
            'pdd',
        ]);
    }

    /**
     * Determine whether the user can view the documentation.
     */
    public function view(User $user, EventDocumentation $eventDocumentation): bool
    {
        return $user->hasAnyRole([
            'super_admin',
            'admin',
            'pengurus',
            'koordinator_kegiatan',
            'pdd',
        ]);
    }

    /**
     * Determine whether the user can create documentations.
     * PDD, Admin, Pengurus, dan Super Admin yang bertugas mengunggah dokumentasi.
     * Koordinator Kegiatan hanya read-only untuk dokumentasi.
     */
    public function create(User $user): bool
    {
        return $user->hasAnyRole([
            'super_admin',
            'admin',
            'pengurus',
            'pdd',
        ]);
    }

    /**
     * Determine whether the user can update the documentation.
     */
    public function update(User $user, EventDocumentation $eventDocumentation): bool
    {
        return $user->hasAnyRole([
            'super_admin',
            'admin',
            'pengurus',
            'pdd',
        ]);
    }

    /**
     * Determine whether the user can delete the documentation.
     */
    public function delete(User $user, EventDocumentation $eventDocumentation): bool
    {
        return $user->hasAnyRole([
            'super_admin',
            'admin',
            'pengurus',
            'pdd',
        ]);
    }
}
