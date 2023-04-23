<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Order;
use App\Models\User;

class OrderPolicy
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
        return $user->hasPermission('order');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Order $order
     * @return Response|bool
     */
    public function view(User $user, Order $order)
    {
        return $user->hasPermission('order');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return Response|bool
     */
    public function create(User $user)
    {
        return $user->hasPermission('order');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Order $order
     * @return Response|bool
     */
    public function update(User $user, Order $order)
    {
        return $user->hasPermission('order');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Order $order
     * @return Response|bool
     */
    public function delete(User $user, Order $order)
    {
        return $user->hasPermission('order');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Order $order
     * @return Response|bool
     */
    public function restore(User $user, Order $order)
    {
        return $user->hasPermission('order');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param Order $order
     * @return Response|bool
     */
    public function forceDelete(User $user, Order $order)
    {
        return $user->hasPermission('order');
    }
}
