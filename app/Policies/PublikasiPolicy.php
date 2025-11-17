<?php

namespace App\Policies;

use App\Models\Publikasi;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PublikasiPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_publikasi');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Publikasi $publikasi): bool
    {
        return $user->can('view_publikasi');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_publikasi');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Publikasi $publikasi): bool
    {
        return $user->can('update_publikasi');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Publikasi $publikasi): bool
    {
        return $user->can('delete_publikasi');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_publikasi');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_publikasi');
    }
}
