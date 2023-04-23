<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionRequest;
use App\Models\Permission;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Permission::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        return view('admin.permission.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.permission.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PermissionRequest $permissionRequest
     * @return RedirectResponse
     */
    public function store(PermissionRequest $permissionRequest): RedirectResponse
    {
        Permission::create($permissionRequest->all());
        return back()->withSuccess(trans('message.saved'));
    }

    /**
     * Display the specified resource.
     *
     * @param Permission $permission
     * @return View
     */
    public function show(Permission $permission): View
    {
        return view('admin.permission.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Permission $permission
     * @return View
     */
    public function edit(Permission $permission): View
    {
        return view('admin.permission.index', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PermissionRequest $permissionRequest
     * @param Permission $permission
     * @return RedirectResponse
     */
    public function update(PermissionRequest $permissionRequest, Permission $permission): RedirectResponse
    {
        $permission->update($permissionRequest->all());
        return to_route('permission.index')->withSuccess(trans('message.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Permission $permission
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Permission $permission): RedirectResponse
    {
        $permission->delete();
        return to_route('permission.index')->withSuccess(trans('message.deleted'));
    }
}
