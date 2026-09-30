<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\User;

class EventPolicy
{
    /**
     * Determine whether the user can view any events.
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
     * Determine whether the user can view the event.
     */
    public function view(User $user, Event $event): bool
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
     * Determine whether the user can create events.
     * Koordinator Kegiatan, Admin, Pengurus, dan Super Admin bisa buat Event.
     * PDD hanya read-only untuk data Event.
     */
    public function create(User $user): bool
    {
        return $user->hasAnyRole([
            'super_admin',
            'admin',
            'pengurus',
            'koordinator_kegiatan',
        ]);
    }

    /**
     * Determine whether the user can update the event.
     */
    public function update(User $user, Event $event): bool
    {
        return $user->hasAnyRole([
            'super_admin',
            'admin',
            'pengurus',
            'koordinator_kegiatan',
        ]);
    }

    /**
     * Determine whether the user can delete the event.
     */
    public function delete(User $user, Event $event): bool
    {
        return $user->hasAnyRole([
            'super_admin',
            'admin',
            'pengurus',
            'koordinator_kegiatan',
        ]);
    }
}
