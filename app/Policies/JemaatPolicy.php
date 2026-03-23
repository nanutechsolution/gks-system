<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Jemaat;
use Illuminate\Auth\Access\HandlesAuthorization;

class JemaatPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Jemaat');
    }

    public function view(AuthUser $authUser, Jemaat $jemaat): bool
    {
        return $authUser->can('View:Jemaat');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Jemaat');
    }

    public function update(AuthUser $authUser, Jemaat $jemaat): bool
    {
        return $authUser->can('Update:Jemaat');
    }

    public function delete(AuthUser $authUser, Jemaat $jemaat): bool
    {
        return $authUser->can('Delete:Jemaat');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:Jemaat');
    }

    public function restore(AuthUser $authUser, Jemaat $jemaat): bool
    {
        return $authUser->can('Restore:Jemaat');
    }

    public function forceDelete(AuthUser $authUser, Jemaat $jemaat): bool
    {
        return $authUser->can('ForceDelete:Jemaat');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Jemaat');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Jemaat');
    }

    public function replicate(AuthUser $authUser, Jemaat $jemaat): bool
    {
        return $authUser->can('Replicate:Jemaat');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Jemaat');
    }

}