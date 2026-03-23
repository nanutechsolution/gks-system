<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Keuangan;
use Illuminate\Auth\Access\HandlesAuthorization;

class KeuanganPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Keuangan');
    }

    public function view(AuthUser $authUser, Keuangan $keuangan): bool
    {
        return $authUser->can('View:Keuangan');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Keuangan');
    }

    public function update(AuthUser $authUser, Keuangan $keuangan): bool
    {
        return $authUser->can('Update:Keuangan');
    }

    public function delete(AuthUser $authUser, Keuangan $keuangan): bool
    {
        return $authUser->can('Delete:Keuangan');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:Keuangan');
    }

    public function restore(AuthUser $authUser, Keuangan $keuangan): bool
    {
        return $authUser->can('Restore:Keuangan');
    }

    public function forceDelete(AuthUser $authUser, Keuangan $keuangan): bool
    {
        return $authUser->can('ForceDelete:Keuangan');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Keuangan');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Keuangan');
    }

    public function replicate(AuthUser $authUser, Keuangan $keuangan): bool
    {
        return $authUser->can('Replicate:Keuangan');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Keuangan');
    }

}