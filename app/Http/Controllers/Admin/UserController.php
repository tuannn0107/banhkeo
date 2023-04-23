<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $userList = User::all();
        return view('admin.user.index', compact('userList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $userList = User::all();
        return view('admin.user.index', compact('userList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUserRequest $userRequest
     * @return RedirectResponse
     */
    public function store(StoreUserRequest $userRequest): RedirectResponse
    {
        $user = User::create($userRequest->merge(['password' => Hash::make($userRequest->password)])->all());
        $user->markEmailAsVerified();
        $user->roleList()->sync($userRequest->roleList);
        return back()->withSuccess(trans('message.saved'));
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return View
     */
    public function show(User $user): View
    {
        return view('admin.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return View
     */
    public function edit(User $user): View
    {
        $userList = User::all();
        return view('admin.user.index', compact('user', 'userList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $userRequest
     * @param User $user
     * @return RedirectResponse
     */
    public function update(UpdateUserRequest $userRequest, User $user): RedirectResponse
    {
        if ($userRequest->password) {
            $userRequest['password'] = Hash::make($userRequest->password);
        }
        $userRequestFilter = $userRequest->collect()->filter(function ($value) {
            return null !== $value;
        })->toArray();
        $user->update($userRequestFilter);
        $user->roleList()->sync($userRequest->roleList);
        return to_route('user.index')->withSuccess(trans('message.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(User $user): RedirectResponse
    {
        $user->delete();
        return to_route('user.index')->withSuccess(trans('message.deleted'));
    }
}
