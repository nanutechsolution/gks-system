<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Inventaris;
use Illuminate\Auth\Access\HandlesAuthorization;

class InventarisPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Inventaris');
    }

    public function view(AuthUser $authUser, Inventaris $inventaris): bool
    {
        return $authUser->can('View:Inventaris');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Inventaris');
    }

    public function update(AuthUser $authUser, Inventaris $inventaris): bool
    {
        return $authUser->can('Update:Inventaris');
    }

    public function delete(AuthUser $authUser, Inventaris $inventaris): bool
    {
        return $authUser->can('Delete:Inventaris');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:Inventaris');
    }

    public function restore(AuthUser $authUser, Inventaris $inventaris): bool
    {
        return $authUser->can('Restore:Inventaris');
    }

    public function forceDelete(AuthUser $authUser, Inventaris $inventaris): bool
    {
        return $authUser->can('ForceDelete:Inventaris');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Inventaris');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Inventaris');
    }

    public function replicate(AuthUser $authUser, Inventaris $inventaris): bool
    {
        return $authUser->can('Replicate:Inventaris');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Inventaris');
    }

}