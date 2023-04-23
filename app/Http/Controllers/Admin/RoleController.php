<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Models\Role;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Role::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        return view('admin.role.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.role.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RoleRequest $roleRequest
     * @return RedirectResponse
     */
    public function store(RoleRequest $roleRequest): RedirectResponse
    {
        $role = Role::create($roleRequest->all());
        $role->permissionList()->sync($roleRequest->permissionList);
        return back()->withSuccess(trans('message.saved'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Role $role
     * @return View
     */
    public function edit(Role $role): View
    {
        return view('admin.role.index', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param RoleRequest $roleRequest
     * @param Role $role
     * @return RedirectResponse
     */
    public function update(RoleRequest $roleRequest, Role $role): RedirectResponse
    {
        $role->update($roleRequest->all());
        $role->permissionList()->sync($roleRequest->permissionList);
        return to_route('role.index')->withSuccess(trans('message.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Role $role
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Role $role): RedirectResponse
    {
        $role->delete();
        return to_route('role.index')->withSuccess(trans('message.deleted'));
    }
}
