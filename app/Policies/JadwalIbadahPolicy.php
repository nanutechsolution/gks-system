<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\JadwalIbadah;
use Illuminate\Auth\Access\HandlesAuthorization;

class JadwalIbadahPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:JadwalIbadah');
    }

    public function view(AuthUser $authUser, JadwalIbadah $jadwalIbadah): bool
    {
        return $authUser->can('View:JadwalIbadah');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:JadwalIbadah');
    }

    public function update(AuthUser $authUser, JadwalIbadah $jadwalIbadah): bool
    {
        return $authUser->can('Update:JadwalIbadah');
    }

    public function delete(AuthUser $authUser, JadwalIbadah $jadwalIbadah): bool
    {
        return $authUser->can('Delete:JadwalIbadah');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:JadwalIbadah');
    }

    public function restore(AuthUser $authUser, JadwalIbadah $jadwalIbadah): bool
    {
        return $authUser->can('Restore:JadwalIbadah');
    }

    public function forceDelete(AuthUser $authUser, JadwalIbadah $jadwalIbadah): bool
    {
        return $authUser->can('ForceDelete:JadwalIbadah');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:JadwalIbadah');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:JadwalIbadah');
    }

    public function replicate(AuthUser $authUser, JadwalIbadah $jadwalIbadah): bool
    {
        return $authUser->can('Replicate:JadwalIbadah');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:JadwalIbadah');
    }

}