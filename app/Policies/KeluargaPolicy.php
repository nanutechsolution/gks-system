<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Keluarga;
use Illuminate\Auth\Access\HandlesAuthorization;

class KeluargaPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Keluarga');
    }

    public function view(AuthUser $authUser, Keluarga $keluarga): bool
    {
        return $authUser->can('View:Keluarga');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Keluarga');
    }

    public function update(AuthUser $authUser, Keluarga $keluarga): bool
    {
        return $authUser->can('Update:Keluarga');
    }

    public function delete(AuthUser $authUser, Keluarga $keluarga): bool
    {
        return $authUser->can('Delete:Keluarga');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:Keluarga');
    }

    public function restore(AuthUser $authUser, Keluarga $keluarga): bool
    {
        return $authUser->can('Restore:Keluarga');
    }

    public function forceDelete(AuthUser $authUser, Keluarga $keluarga): bool
    {
        return $authUser->can('ForceDelete:Keluarga');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Keluarga');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Keluarga');
    }

    public function replicate(AuthUser $authUser, Keluarga $keluarga): bool
    {
        return $authUser->can('Replicate:Keluarga');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Keluarga');
    }

}