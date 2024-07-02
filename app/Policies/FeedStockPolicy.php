<?php

namespace App\Policies;

use App\Models\User;
use App\Models\FeedStock;
use Illuminate\Auth\Access\HandlesAuthorization;

class FeedStockPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_feed::stock');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, FeedStock $feedStock): bool
    {
        return $user->can('view_feed::stock');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_feed::stock');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, FeedStock $feedStock): bool
    {
        return $user->can('update_feed::stock');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, FeedStock $feedStock): bool
    {
        return $user->can('delete_feed::stock');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_feed::stock');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, FeedStock $feedStock): bool
    {
        return $user->can('force_delete_feed::stock');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_feed::stock');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, FeedStock $feedStock): bool
    {
        return $user->can('restore_feed::stock');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_feed::stock');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, FeedStock $feedStock): bool
    {
        return $user->can('replicate_feed::stock');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_feed::stock');
    }
}
