<?php

namespace App\Policies;

use App\Models\User;
use App\Models\DokumentasiDigital;
use Illuminate\Auth\Access\HandlesAuthorization;

class DokumentasiDigitalPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_dokumentasi::digital');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, DokumentasiDigital $dokumentasiDigital): bool
    {
        return $user->can('view_dokumentasi::digital');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_dokumentasi::digital');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, DokumentasiDigital $dokumentasiDigital): bool
    {
        return $user->can('update_dokumentasi::digital');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, DokumentasiDigital $dokumentasiDigital): bool
    {
        return $user->can('delete_dokumentasi::digital');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_dokumentasi::digital');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, DokumentasiDigital $dokumentasiDigital): bool
    {
        return $user->can('{{ ForceDelete }}');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('{{ ForceDeleteAny }}');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, DokumentasiDigital $dokumentasiDigital): bool
    {
        return $user->can('{{ Restore }}');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('{{ RestoreAny }}');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, DokumentasiDigital $dokumentasiDigital): bool
    {
        return $user->can('{{ Replicate }}');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_dokumentasi::digital');
    }
}
