<?php

namespace App\Policies;

use App\Models\Configuration;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ConfigurationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('configuration')
            && !collect(['mail', 'setting'])->contains(request()->name)
            || $user->can('system');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Configuration $configuration
     * @return bool
     */
    public function view(User $user, Configuration $configuration): bool
    {
        return $user->hasPermission('configuration') || $user->can('system');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->hasPermission('configuration') || $user->can('system');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Configuration $configuration
     * @return bool
     */
    public function update(User $user, Configuration $configuration): bool
    {
        return $user->hasPermission('configuration') || $user->can('system');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Configuration $configuration
     * @return bool
     */
    public function delete(User $user, Configuration $configuration): bool
    {
        return $user->hasPermission('configuration') || $user->can('system');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Configuration $configuration
     * @return bool
     */
    public function restore(User $user, Configuration $configuration): bool
    {
        return $user->hasPermission('configuration') || $user->can('system');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param Configuration $configuration
     * @return bool
     */
    public function forceDelete(User $user, Configuration $configuration): bool
    {
        return $user->hasPermission('configuration') || $user->can('system');
    }
}
