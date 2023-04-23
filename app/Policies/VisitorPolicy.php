<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Visitor;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class VisitorPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->hasPermission('visitor');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Visitor $visitor
     * @return Response|bool
     */
    public function view(User $user, Visitor $visitor)
    {
        return $user->hasPermission('visitor');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return Response|bool
     */
    public function create(User $user)
    {
        return $user->hasPermission('visitor');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Visitor $visitor
     * @return Response|bool
     */
    public function update(User $user, Visitor $visitor)
    {
        return $user->hasPermission('visitor');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Visitor $visitor
     * @return Response|bool
     */
    public function delete(User $user, Visitor $visitor)
    {
        return $user->hasPermission('visitor');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Visitor $visitor
     * @return Response|bool
     */
    public function restore(User $user, Visitor $visitor)
    {
        return $user->hasPermission('visitor');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param Visitor $visitor
     * @return Response|bool
     */
    public function forceDelete(User $user, Visitor $visitor)
    {
        return $user->hasPermission('visitor');
    }
}
